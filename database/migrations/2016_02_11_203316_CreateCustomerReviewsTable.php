<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_reviews', function(Blueprint $table) {
            $table->increments('id');

            $table->integer( 'customer_id' )->unsigned();
            $table->integer( 'amazon_product_id' )->unsigned();

            $table->string( 'link' );
            $table->text( 'notes' );

            $table->timestamps();

            $table->foreign( 'customer_id' )
                    ->references( 'id' )
                    ->on( 'customers' )
                    ->onDelete( 'cascade' );

            $table->foreign( 'amazon_product_id' )
                    ->references( 'id' )
                    ->on( 'amazon_products' )
                    ->onDelete( 'cascade' );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('customer_reviews');
    }
}
