<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: 2023_08_19_195244_create_maps_table.php
 * User: ${USER}
 * Date: 19.${MONTH_NAME_FULL}.2023
 * Time: 19:52
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('maps', function (Blueprint $table) {
            $table->id();
            $table->string('md_author')->nullable();
            $table->string('md_version')->nullable();
            $table->string('md_title_de')->nullable();
            $table->string('md_title_en')->nullable();
            $table->json('md_desc')->nullable();
            $table->json('md_fillTypes')->nullable();
            $table->json('md_fruitTypes')->nullable();
            $table->json('md_farmlands')->nullable();
            $table->json('md_sprayTypes')->nullable();
            $table->json('md_fields')->nullable();
            $table->boolean('md_sprayTypes_available')->nullable();
            $table->bigInteger('team_id')->nullable();
            $table->bigInteger('user_id')->nullable();
            $table->boolean('md_public_private')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('maps');
    }
};
