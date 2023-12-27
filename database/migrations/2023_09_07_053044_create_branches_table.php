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
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->unsignedBigInteger("contact_id");
                $table->foreign("contact_id")->on("contacts")->references("id");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table("branches", function (Blueprint $table){
            $table->dropConstrainedForeignId("contact_id");
        });
        Schema::dropIfExists('branches');
    }
};
