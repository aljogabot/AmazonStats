<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserIdOnAmazonProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('amazon_products', function (Blueprint $table) {
            $table->integer( 'user_id' )->unsigned()->nullable();

            $table->foreign('user_id')
                  ->references('id')->on('users')
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
        Schema::table('amazon_products', function (Blueprint $table) {
            $table->dropForeign( 'amazon_products_user_id_foreign' );
            $table->dropColumn( 'user_id' );
        });
    }
}
