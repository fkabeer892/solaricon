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
        Schema::create('contact_detail', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("contact_id");
                $table->foreign("contact_id")->on("contacts")->references("id");
            $table->string("contact_key");
            $table->string("contact_value");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table("contact_detail", function (Blueprint $table){
            $table->dropConstrainedForeignId("contact_id");
        });
        Schema::dropIfExists('contact_detail');
    }
};
