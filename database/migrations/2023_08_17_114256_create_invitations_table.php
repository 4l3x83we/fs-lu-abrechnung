<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: 2023_08_17_114256_create_invitations_table.php
 * User: ${USER}
 * Date: 17.${MONTH_NAME_FULL}.2023
 * Time: 11:42
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('invitations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id')->nullable()->constrained()->cascadeOnDelete();
            $table->bigInteger('project_id')->nullable();
            $table->string('email')->nullable();
            $table->string('token')->nullable();
            $table->timestamp('accepted_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invitations');
    }
};
