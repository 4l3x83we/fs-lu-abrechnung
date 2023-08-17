<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: 2023_08_16_015747_add_current_team_id_to_users_table.php
 * User: ${USER}
 * Date: 16.${MONTH_NAME_FULL}.2023
 * Time: 01:57
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('current_team_id')->nullable()->references('id')->on('teams')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropConstrainedForeignId('current_team_id');
        });
    }
};
