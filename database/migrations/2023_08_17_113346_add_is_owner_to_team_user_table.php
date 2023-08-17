<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: 2023_08_17_113346_add_is_owner_to_team_user_table.php
 * User: ${USER}
 * Date: 17.${MONTH_NAME_FULL}.2023
 * Time: 11:33
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('team_user', function (Blueprint $table) {
            $table->boolean('is_owner')->default(false);
        });
    }

    public function down(): void
    {
        Schema::table('team_user', function (Blueprint $table) {
            $table->dropColumn('is_owner');
        });
    }
};
