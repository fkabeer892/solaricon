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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("order_id");
                $table->foreign("order_id")->on("orders")->references("id");
            $table->unsignedBigInteger("user_id");
                $table->foreign("user_id")->on("users")->references("id");
            $table->string("product_name");
            $table->unsignedBigInteger("product_id");
                $table->foreign("product_id")->on("products")->references("id");
            $table->integer("quantity")->default("1");
            $table->decimal("price", 10, 2);
            $table->decimal("discount", 10, 2)->default(0);
            $table->decimal("inline_total", 10, 2)->storedAs('(quantity * price) - discount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table("order_items", function(Blueprint $table){
            $table->dropConstrainedForeignId("order_id");
            $table->dropConstrainedForeignId("user_id");
            $table->dropConstrainedForeignId("product_id");
        });
        Schema::dropIfExists('order_items');
    }
};
