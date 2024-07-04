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
        Schema::table('users', function (Blueprint $table) {
            
            $table->boolean('is_two_factor_enabled')->default(false)->after('is_admin');
            $table->string('two_factor_secret_key')->nullable()->after('is_two_factor_enabled');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('is_two_factor_enabled');
            $table->dropColumn('two_factor_secret_key');
        });
    }
};
