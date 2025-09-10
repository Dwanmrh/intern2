<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('beritas', function (Blueprint $table) {
            $table->string('file_berita')->nullable()->after('foto');
            $table->integer('likes')->default(0)->after('file_berita');
        });
    }

    public function down(): void
    {
        Schema::table('beritas', function (Blueprint $table) {
            $table->dropColumn(['file_berita', 'likes']);
        });
    }
};
