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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("expense_type_id");
                $table->foreign("expense_type_id")->on("expense_types")->references("id");
            $table->unsignedBigInteger("branch_id")->nullable();
                $table->foreign("branch_id")->on("branches")->references("id");
            $table->string("name");
            $table->decimal("amount", 10, 2);
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
        Schema::table("expenses", function (Blueprint $table){
            $table->dropConstrainedForeignId("expense_type_id");
            $table->dropConstrainedForeignId("branch_id");
            $table->dropConstrainedForeignId("status_id");
        });
        Schema::dropIfExists('expenses');
    }
};
