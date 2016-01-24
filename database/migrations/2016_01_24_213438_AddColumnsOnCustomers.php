<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsOnCustomers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->string( 'buyer_id' )
                    ->nullable();

            $table->enum( 'emailed', [ 'yes', 'no' ] )->default( 'no' );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn( 'buyer_id' );
            $table->dropColumn( 'emailed' );
        });
    }
}
