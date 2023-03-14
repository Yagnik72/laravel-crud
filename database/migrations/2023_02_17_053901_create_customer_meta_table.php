<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerMetaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_meta', function (Blueprint $table) {
            $table->id('customer_meta_id');
            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->references('customer_id')->on('customers');
            $table->string('meta_key');
            $table->string('meta_value');
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
        Schema::create('customer_meta', function (Blueprint $table) {
            $table->dropForeign('customer_meta_customer_id_foreign');
            $table->dropIndex('customer_meta_customer_id_index');
        });


        Schema::dropIfExists('customers_meta');
    }
}
