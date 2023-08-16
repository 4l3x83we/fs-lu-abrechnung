<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: 2023_08_16_015303_create_projects_table.php
 * User: ${USER}
 * Date: 16.${MONTH_NAME_FULL}.2023
 * Time: 01:53
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id')->nullable()->constrained();
            $table->string('project_name')->nullable();
            $table->string('project_image')->nullable();
            $table->string('project_map')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
