<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: 2023_08_20_132345_create_pictures_table.php
 * User: ${USER}
 * Date: 20.${MONTH_NAME_FULL}.2023
 * Time: 13:23
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pictures', function (Blueprint $table) {
            $table->id();
            $table->string('icon')->nullable();
            $table->string('preview')->nullable();
            $table->string('map_id')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pictures');
    }
};
