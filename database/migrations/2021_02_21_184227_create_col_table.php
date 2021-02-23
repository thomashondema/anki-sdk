<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Support\Facades\DB;


class CreateColTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Capsule::schema()->create('col', function (Blueprint $table) {
            $connection = Capsule::connection();

            $table->integer('id')->primary()->comment('arbitrary number since there is only one row');
            $table->integer('crt')->default($connection->raw(('CURRENT_TIMESTAMP')))->comment('timestamp of the creation date. It\'s correct up to the day. For V1 scheduler, the hour corresponds to starting a new day. By default, new day is 4.');
            $table->integer('mod')->default($connection->raw(('CURRENT_TIMESTAMP')))->comment('last modified in milliseconds');
            $table->integer('scm')->default($connection->raw(('CURRENT_TIMESTAMP')))->comment('schema mod time: time when "schema" was modified. 
If server scm is different from the client scm a full-sync is required');
            $table->integer('ver')->default(1)->comment('version');
            $table->integer('dty')->default(0)->comment('dirty: unused, set to 0');
            $table->integer('usn')->default(0)->comment('update sequence number: used for finding diffs when syncing. 
See usn in cards table for more details.');
            $table->integer('ls')->default($connection->raw(('CURRENT_TIMESTAMP')))->comment('"last sync time"');
            $table->text('conf')->comment('json object containing configuration options that are synced');
            $table->text('models')->comment('json array of json objects containing the models (aka Note types)');
            $table->text('decks')->comment('json array of json objects containing the deck');
            $table->text('dconf')->comment('json array of json objects containing the deck options');
            $table->text('tags')->default("{}")->comment('a cache of tags used in the collection (This list is displayed in the browser. Potentially at other place)');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Capsule::schema()->dropIfExists('col');
    }
}
