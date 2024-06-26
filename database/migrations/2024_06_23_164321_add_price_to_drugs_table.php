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
        Schema::table('drugs', function (Blueprint $table) {
            $table->decimal('price', 8, 2)->after('side_effects')->nullable()->comment('Harga obat');
            $table->string('currency', 3)->after('price')->default('IDR')->comment('Mata uang harga obat');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('drugs', function (Blueprint $table) {
            $table->dropColumn('price');
            $table->dropColumn('currency');
        });
    }
};
