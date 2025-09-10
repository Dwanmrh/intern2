<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('beritas', function (Blueprint $table) {
            if (Schema::hasColumn('beritas', 'file_berita')) {
                $table->dropColumn('file_berita');
            }
            if (Schema::hasColumn('beritas', 'likes')) {
                $table->dropColumn('likes');
            }
        });
    }

    public function down(): void
    {
        Schema::table('beritas', function (Blueprint $table) {
            $table->string('file_berita')->nullable();
            $table->integer('likes')->default(0);
        });
    }
};
