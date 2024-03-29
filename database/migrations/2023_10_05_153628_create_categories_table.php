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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("parent_id")->nullable();
                $table->foreign("parent_id", "categories_parent_id_foreign")->on("categories")->references("id");
            $table->string("name");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table("categories", function (Blueprint $table){
            $table->dropConstrainedForeignId("parent_id");
        });
        Schema::dropIfExists('categories');
    }
};
