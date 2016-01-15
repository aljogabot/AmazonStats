<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdditionalColumnsOnTransactions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->text( 'ship_address_1' )->nullable();
            $table->text( 'ship_address_2' )->nullable();
            $table->text( 'ship_address_3' )->nullable();
            $table->string( 'ship_city' )->nullable();
            $table->string( 'ship_state' )->nullable();
            $table->string( 'ship_postal_code' )->nullable();
            $table->string( 'ship_postal_country' )->nullable();
            $table->string( 'carrier' )->nullable();
            $table->string( 'tracking_number' )->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn( 'ship_address_1' );
            $table->dropColumn( 'ship_address_2' );
            $table->dropColumn( 'ship_address_3' );
            $table->dropColumn( 'ship_city' );
            $table->dropColumn( 'ship_state' );
            $table->dropColumn( 'ship_postal_code' );
            $table->dropColumn( 'ship_postal_country' );
            $table->dropColumn( 'carrier' );
            $table->dropColumn( 'tracking_number' );
        });
    }
}
