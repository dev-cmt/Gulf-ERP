<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();
            $table->date('issue_date')->nullable();
            $table->string('issue_no')->nullable();
            $table->tinyInteger('with_warranty')->default(false);
            $table->text('note')->nullable();
            $table->text('remarks')->nullable();
            $table->unsignedBigInteger('mast_complaint_type_id');
            $table->foreign('mast_complaint_type_id')->references('id')->on('mast_complaint_types')->onDelete('cascade');
            $table->unsignedBigInteger('delivery_id');
            $table->foreign('delivery_id')->references('id')->on('deliveries')->onDelete('cascade');
            $table->unsignedBigInteger('mast_customer_id');
            $table->foreign('mast_customer_id')->references('id')->on('mast_customers')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->tinyInteger('status')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('complaints');
    }
};
