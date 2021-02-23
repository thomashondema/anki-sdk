<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager as Capsule;


class CreateRevlogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Capsule::schema()->create('revlog', function (Blueprint $table) {
            $table->integer('id')->comment('epoch-milliseconds timestamp of when you did the review');
            $table->integer('cid')->comment('cards.id');
            $table->integer('usn')->comment('update sequence number: for finding diffs when syncing. 
See the description in the cards table for more info');
            $table->integer('ease')->comment('which button you pushed to score your recall. 
review:  1(wrong), 2(hard), 3(ok), 4(easy)
learn/relearn:   1(wrong), 2(ok), 3(easy)');
            $table->integer('ivl')->comment('interval (i.e. as in the card table)');
            $table->integer('lastIvl')->comment('last interval (i.e. the last value of ivl. Note that this value is not necessarily equal to the actual interval between this review and the preceding review)');
            $table->integer('factor')->comment('factor');
            $table->integer('time')->comment('how many milliseconds your review took, up to 60000 (60s)');
            $table->integer('type')->comment('0=learn, 1=review, 2=relearn, 3=cram');

            $table->index('cid');
            $table->index('usn');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Capsule::schema()->dropIfExists('revlog');
    }
}
