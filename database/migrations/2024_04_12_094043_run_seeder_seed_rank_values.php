<?php

use Database\Seeders\SeedRankValues;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        (new SeedRankValues())->run();
    }
};
