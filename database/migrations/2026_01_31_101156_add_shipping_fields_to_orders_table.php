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
        Schema::table('orders', function (Blueprint $table) {
            $table->integer('shipping_cost')->after('subtotal')->default(0);
            $table->string('shipping_method')->after('shipping_cost')->nullable();
            $table->string('shipping_status')->after('shipping_method')->default('pending')->comment('pending, packed, shipped, in_transit, delivered');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['shipping_cost', 'shipping_method', 'shipping_status']);
        });
    }
};
