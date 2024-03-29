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
        Schema::create('user_roles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id");
                $table->foreign("user_id"/*, "user_roles_user_id_foreign"*/)->on("users")->references("id");
            $table->unsignedBigInteger("role_id");
                $table->foreign("role_id")->on("roles")->references("id");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table("user_roles", function (Blueprint $table){
            $table->dropConstrainedForeignId('user_id');
            $table->dropConstrainedForeignId('role_id');
        });
        Schema::dropIfExists('user_roles');
    }
};
