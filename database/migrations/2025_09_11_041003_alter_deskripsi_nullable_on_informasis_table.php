<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('informasis', function (Blueprint $table) {
            $table->text('deskripsi')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('informasis', function (Blueprint $table) {
            $table->text('deskripsi')->nullable(false)->change();
        });
    }
};
