<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer( 'transaction_id' )->unsigned();

            $table->integer( 'amazon_product_id' )->unsigned();

            $table->string( 'order_id' );
            $table->integer( 'quantity' );
            $table->decimal( 'payout', 10, 2 );

            $table->timestamps();

            $table->foreign('transaction_id')
                  ->references('id')->on('transactions')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('transaction_items');
    }
}
