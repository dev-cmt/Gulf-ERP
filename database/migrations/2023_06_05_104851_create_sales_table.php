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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->date('inv_date')->nullable();
            $table->string('inv_no')->nullable();
            $table->integer('vat')->nullable();
            $table->integer('tax')->nullable();
            $table->text('remarks')->nullable();
            $table->tinyInteger('status')->default(false);
            $table->tinyInteger('is_parsial')->default(false);

            $table->unsignedBigInteger('mast_item_category_id');
            $table->foreign('mast_item_category_id')->references('id')->on('mast_item_categories')->onDelete('cascade');
            $table->unsignedBigInteger('mast_customer_id');
            $table->foreign('mast_customer_id')->references('id')->on('mast_customers')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('sales');
    }
};
