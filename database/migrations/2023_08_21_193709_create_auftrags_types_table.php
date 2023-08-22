<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: 2023_08_21_193709_create_auftrags_types_table.php
 * User: ${USER}
 * Date: 21.${MONTH_NAME_FULL}.2023
 * Time: 19:37
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('auftrags_types', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('team_id')->nullable();
            $table->bigInteger('project_id')->nullable();
            $table->string('name')->nullable();
            $table->string('kosten')->nullable();
            $table->string('type')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('auftrags_types');
    }
};
