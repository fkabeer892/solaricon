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
        Schema::create('product_attributes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("product_id");
                $table->foreign("product_id")->on("products")->references("id");
            $table->unsignedBigInteger("attribute_id");
                $table->foreign("attribute_id")->on("attributes")->references("id");
            $table->string("value");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table("product_attributes", function (Blueprint $table){
            $table->dropConstrainedForeignId('product_id');
            $table->dropConstrainedForeignId('attribute_id');
        });
        Schema::dropIfExists('product_attributes');
    }
};
