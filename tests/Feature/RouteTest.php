<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Berita;
use App\Models\Dashboard;
use App\Models\Fasilitas;
use App\Models\Informasi;
use App\Models\Modul;
use App\Models\Profil;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RouteTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_can_access_public_routes()
    {
        $this->get('/dashboard')->assertStatus(200);
        $this->get('/profil')->assertStatus(200);
        $this->get('/berita')->assertStatus(200);
        $this->get('/informasi')->assertStatus(200);
        $this->get('/fasilitas')->assertStatus(200);
    }

    /** @test */
    public function guest_cannot_access_admin_routes()
    {
        $this->get('/dashboard/create')->assertRedirect('/login');
        $this->get('/profil/create')->assertRedirect('/login');
        $this->get('/berita/create')->assertRedirect('/login');
        $this->get('/informasi/create')->assertRedirect('/login');
        $this->get('/fasilitas/create')->assertRedirect('/login');
        $this->get('/modul/create')->assertRedirect('/login');
    }

    /** @test */
    public function admin_can_access_admin_routes()
    {
        $admin = User::factory()->create(['role' => 'admin, super_admin']);
        $this->actingAs($admin);

        $this->get('/dashboard/create')->assertStatus(200);
        $this->get('/profil/create')->assertStatus(200);
        $this->get('/berita/create')->assertStatus(200);
        $this->get('/informasi/create')->assertStatus(200);
        $this->get('/fasilitas/create')->assertStatus(200);
        $this->get('/modul/create')->assertStatus(200);
    }

    /** @test */
    public function modul_can_be_accessed_by_logged_in_user()
    {
        $user = User::factory()->create(['role' => 'siswa']);
        $this->actingAs($user);

        $this->get('/modul')->assertStatus(200);
        $this->get('/modul/sip')->assertStatus(200);
        $this->get('/modul/pag')->assertStatus(200);
    }

    /** @test */
    public function berita_detail_page_works()
    {
        $berita = Berita::factory()->create();
        $this->get("/berita/{$berita->id}")->assertStatus(200);
    }

    /** @test */
    public function berita_like_requires_authentication()
    {
        $berita = Berita::factory()->create();

        $this->post("/like/{$berita->id}")
            ->assertRedirect('/login'); // ✅ bukan 500 lagi
    }

    /** @test */
    public function logged_in_user_can_like_berita()
    {
        $user = User::factory()->create();
        $berita = Berita::factory()->create();

        $this->actingAs($user)
            ->post("/like/{$berita->id}")
            ->assertStatus(200) // ✅ karena return JSON
            ->assertJsonStructure(['status', 'total_likes']);
    }

}
