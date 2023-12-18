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
        Schema::create('cms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("cms_type_id");
                $table->foreign("cms_type_id")->on("cms_types")->references("id");
            $table->unsignedBigInteger("user_id");
                $table->foreign("user_id")->on("users")->references("id");
            $table->string("name");
            $table->text("content");
            $table->string("email")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table("cms", function (Blueprint $table){
            $table->dropConstrainedForeignId('cms_type_id');
            $table->dropConstrainedForeignId("user_id");
        });
        Schema::dropIfExists('cms');
    }
};
