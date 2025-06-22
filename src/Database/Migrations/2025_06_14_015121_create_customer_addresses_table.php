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
        Schema::create('customer_addresses', function (Blueprint $table) {
            $table->id();
            $table->string('prefix',5)->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('suffix',5)->nullable();
            $table->string('company')->nullable();
            $table->string('street_address_1');
            $table->string('street_address_2')->nullable();
            $table->string('city');
            $table->string('state')->nullable(); // e.g., state or province
            $table->string('postcode');
            $table->string('country_id', 2); // ISO 3166-1 alpha-2
            $table->string('telephone');
            $table->enum('type', ['billing', 'shipping'])->default('billing');
            $table->boolean('is_default')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_addresses');
    }
};
