<?php

namespace Tests\Unit;

use App\Models\{
    Berita, User, Dashboard, Fasilitas, Informasi, Link, Modul, Profil
};
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ModelsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function berita_can_be_liked_by_user()
    {
        $user = User::factory()->create();
        $berita = Berita::factory()->create();

        $berita->likes()->attach($user->id);

        $this->assertTrue($berita->isLikedBy($user));
    }

    /** @test */
    public function dashboard_fillable_works()
    {
        $dashboard = Dashboard::factory()->create();
        $this->assertDatabaseHas('dashboards', ['id' => $dashboard->id]);
    }

    /** @test */
    public function fasilitas_fillable_works()
    {
        $fasilitas = Fasilitas::factory()->create();
        $this->assertDatabaseHas('fasilitas', ['id' => $fasilitas->id]);
    }

    /** @test */
    public function informasi_fillable_works()
    {
        $informasi = Informasi::factory()->create();
        $this->assertDatabaseHas('informasis', ['id' => $informasi->id]);
    }

    /** @test */
    public function link_fillable_works()
    {
        $link = Link::factory()->create();
        $this->assertDatabaseHas('links', ['id' => $link->id]);
    }

    /** @test */
    public function modul_fillable_works()
    {
        $modul = Modul::factory()->create();
        $this->assertDatabaseHas('moduls', ['id' => $modul->id]);
    }

    /** @test */
    public function profil_fillable_works()
    {
        $profil = Profil::factory()->create();
        $this->assertDatabaseHas('profils', ['id' => $profil->id]);
    }
}
