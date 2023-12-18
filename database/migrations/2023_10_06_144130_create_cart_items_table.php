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
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("cart_id");
                $table->foreign("cart_id")->on("carts")->references("id");
            $table->unsignedBigInteger("product_id");
                $table->foreign("product_id")->on("products")->references("id");
            $table->string("product_name");
            $table->integer("quantity")->default(1);
            $table->decimal("price", 10, 2);
            $table->decimal("discount", 10, 2)->default(0);
            //$table->integer("inline_total");
            $table->decimal("inline_total", 10, 2)->storedAs('(quantity * price) - discount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table("cart_items", function (Blueprint $table){
            $table->dropConstrainedForeignId('cart_id');
            $table->dropConstrainedForeignId('product_id');
        });
        Schema::dropIfExists('cart_items');
    }
};
