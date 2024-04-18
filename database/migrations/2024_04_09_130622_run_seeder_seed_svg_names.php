<?php

use Database\Seeders\SeedSvgNames;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        (new SeedSvgNames())->run();
    }
};
