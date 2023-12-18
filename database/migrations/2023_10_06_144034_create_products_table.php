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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("category_id");
                $table->foreign("category_id")->on("categories")->references("id");
            $table->unsignedBigInteger("brand_id");
                $table->foreign("brand_id")->on("brands")->references("id");
            $table->unsignedBigInteger("product_type_id");
                $table->foreign("product_type_id")->on("product_types")->references("id");
            $table->string("name");
            $table->text("description")->nullable();
            $table->decimal("purchase", 10, 2)->nullable();
            $table->decimal("sale", 10, 2)->nullable();
            $table->integer("stock")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table("products", function (Blueprint $table){
            $table->dropConstrainedForeignId('category_id');
            $table->dropConstrainedForeignId('brand_id');
        });
        Schema::dropIfExists('products');
    }
};
