<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: 2023_08_18_093658_create_notes_table.php
 * User: ${USER}
 * Date: 18.${MONTH_NAME_FULL}.2023
 * Time: 09:36
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('team_id')->nullable();
            $table->bigInteger('project_id')->nullable();
            $table->bigInteger('user_id')->nullable();
            $table->text('notes')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};
