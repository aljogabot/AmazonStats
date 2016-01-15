<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdditionalColumnsOnTransactionItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transaction_items', function (Blueprint $table) {
            $table->decimal( 'item_promotion_discount', 10, 2 )->default( 0.0 );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transaction_items', function (Blueprint $table) {
            $table->dropColumn( 'item_promotion_discount' );
        });
    }
}
