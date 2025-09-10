<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * @property int $id
 * @property string $judul
 * @property string $isi_berita
 * @property string $tanggal
 * @property string|null $foto
 * @property string|null $file_berita
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $likes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $views
 * @property-read int|null $likes_count
 * @method static \Database\Factories\BeritaFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Berita newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Berita newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Berita query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Berita whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Berita whereFileBerita($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Berita whereFoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Berita whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Berita whereIsiBerita($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Berita whereJudul($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Berita whereLikes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Berita whereTanggal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Berita whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Berita whereViews($value)
 */
	class Berita extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $judul
 * @property string $tanggal
 * @property string|null $file
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\DashboardFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Dashboard newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Dashboard newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Dashboard query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Dashboard whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Dashboard whereFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Dashboard whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Dashboard whereJudul($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Dashboard whereTanggal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Dashboard whereUpdatedAt($value)
 */
	class Dashboard extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $judul
 * @property string $deskripsi
 * @property string $tanggal
 * @property string|null $foto
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\FasilitasFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Fasilitas newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Fasilitas newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Fasilitas query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Fasilitas whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Fasilitas whereDeskripsi($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Fasilitas whereFoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Fasilitas whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Fasilitas whereJudul($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Fasilitas whereTanggal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Fasilitas whereUpdatedAt($value)
 */
	class Fasilitas extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $judul
 * @property string $deskripsi
 * @property string $tanggal
 * @property string|null $foto
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $file_informasi
 * @method static \Database\Factories\InformasiFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Informasi newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Informasi newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Informasi query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Informasi whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Informasi whereDeskripsi($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Informasi whereFileInformasi($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Informasi whereFoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Informasi whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Informasi whereJudul($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Informasi whereTanggal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Informasi whereUpdatedAt($value)
 */
	class Informasi extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $nama
 * @property string $url
 * @property string|null $logo
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\LinkFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Link newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Link newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Link query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Link whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Link whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Link whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Link whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Link whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Link whereUrl($value)
 */
	class Link extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $judul
 * @property string|null $deskripsi
 * @property string|null $prodiklat
 * @property string|null $mapel
 * @property string|null $tahun
 * @property string|null $file
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\ModulFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Modul newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Modul newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Modul query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Modul whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Modul whereDeskripsi($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Modul whereFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Modul whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Modul whereJudul($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Modul whereMapel($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Modul whereProdiklat($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Modul whereTahun($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Modul whereUpdatedAt($value)
 */
	class Modul extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $nama
 * @property string $jabatan
 * @property string|null $foto
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\ProfilFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profil newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profil newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profil query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profil whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profil whereFoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profil whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profil whereJabatan($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profil whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profil whereUpdatedAt($value)
 */
	class Profil extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $role
 * @property string|null $otp_code
 * @property \Illuminate\Support\Carbon|null $otp_expires_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Berita> $likedBerita
 * @property-read int|null $liked_berita_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereOtpCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereOtpExpiresAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

