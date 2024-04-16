<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        {
            Schema::table('games', function (Blueprint $table) {
                $table->integer('cash')->default(4)->after('round')->change();
                $table->integer('total_points')->default(0)->after('round')->change();
                $table->unsignedBigInteger('deck_id')->default(1)->after('uuid')->change();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
