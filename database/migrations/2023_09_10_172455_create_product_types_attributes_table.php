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
        Schema::create('product_types_attributes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("product_type_id");
                $table->foreign("product_type_id")->on("product_types")->references("id");
            $table->unsignedBigInteger("attribute_id");
                $table->foreign("attribute_id")->on("attributes")->references("id");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table("product_types_attributes", function (Blueprint $table){
            $table->dropForeign(["product_type_id", "attribute_id"]);
        });
        Schema::dropIfExists('product_types_attributes');
    }
};
