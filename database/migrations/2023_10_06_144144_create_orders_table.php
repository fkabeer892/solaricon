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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id");
                $table->foreign("user_id")->on('users')->references('id');
            $table->unsignedBigInteger("cart_id");
                $table->foreign("cart_id")->on("carts")->references("id");
            $table->string("order_number");
            $table->unsignedBigInteger("payment_address_id")->nullable();
                $table->foreign("payment_address_id")->on("contacts")->references("id");
            $table->unsignedBigInteger("shipping_address_id")->nullable();
                $table->foreign("shipping_address_id")->on("contacts")->references("id");
            $table->decimal("total", 10, 2);
            $table->decimal("discount", 10, 2)->default(0);
            $table->decimal("grand_total", 10, 2);
            $table->unsignedBigInteger("status_id");
            $table->foreign("status_id")->on("statuses")->references("id");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table("orders", function (Blueprint $table){
            $table->dropConstrainedForeignId("cart_id");
            $table->dropConstrainedForeignId("user_id");
            $table->dropConstrainedForeignId("payment_address_id");
            $table->dropConstrainedForeignId("shipping_address_id");

        });
        Schema::dropIfExists('orders');
    }
};
