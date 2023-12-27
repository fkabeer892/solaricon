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
        Schema::table("users", function (Blueprint $table){
            $table->unsignedBigInteger("contact_id")->nullable();
                $table->foreign("contact_id")->on("contacts")->references("id");
            $table->unsignedBigInteger("role_id");
                $table->foreign("role_id")->on("roles")->references("id");
            $table->unsignedBigInteger("status_id");
                $table->foreign("status_id")->on("statuses")->references("id");
            $table->unsignedBigInteger("branch_id")->nullable();
                $table->foreign("branch_id")->on("branches")->references("id");

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table("users", function (Blueprint $table){
            $table->dropConstrainedForeignId("branch_id");
            $table->dropConstrainedForeignId("contact_id");
            $table->dropConstrainedForeignId("role_id");
            $table->dropConstrainedForeignId("status_id");
        });
    }
};
