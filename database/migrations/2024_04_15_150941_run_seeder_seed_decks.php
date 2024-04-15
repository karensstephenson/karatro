<?php

use Database\Seeders\SeedDecks;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        (new SeedDecks())->run();
    }
};
