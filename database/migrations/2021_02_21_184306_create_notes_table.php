<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager as Capsule;

class CreateNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Capsule::schema()->create('notes', function (Blueprint $table) {
            $table->integer('id')->comment('epoch miliseconds of when the note was created');
            $table->text('guid')->comment('globally unique id, almost certainly used for syncing');
            $table->integer('mid')->comment('model id');
            $table->integer('mod')->comment('modification timestamp, epoch seconds');
            $table->integer('usn')->comment('update sequence number: for finding diffs when syncing.
See the description in the cards table for more info');
            $table->text('tags')->comment('space-separated string of tags. 
includes space at the beginning and end, for LIKE "% tag %" queries');
            $table->text('flds')->comment('the values of the fields in this note. separated by 0x1f (31) character.');
            $table->integer('sfld')->comment('sort field: used for quick sorting and duplicate check. The sort field is an integer so that when users are sorting on a field that contains only numbers, they are sorted in numeric instead of lexical order. Text is stored in this integer field.');
            $table->integer('csum')->comment('field checksum used for duplicate check.
integer representation of first 8 digits of sha1 hash of the first field');
            $table->integer('flags')->comment('unused');
            $table->text('data')->comment('unused');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Capsule::schema()->dropIfExists('notes');
    }
}
