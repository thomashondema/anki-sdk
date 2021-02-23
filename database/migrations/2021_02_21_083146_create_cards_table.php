<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager as Capsule;

/**
 * Class CreateCardsTable
 * @see https://github.com/ankidroid/Anki-Android/wiki/Database-Structure
 */
class CreateCardsTable extends Migration
{
    const TABLENAME = 'cards';
    public function up()
    {
        Capsule::schema()->create(self::TABLENAME, function (Blueprint $table)
        {
            $table->integer('id')->primary()->comment('the epoch milliseconds of when the card was created');
            $table->integer('nid')->comment('notes.id');
            $table->integer('did')->comment('deck id (available in col table)');
            $table->integer('ord')->comment('ordinal : identifies which of the card templates or cloze deletions it corresponds to 
for card templates, valid values are from 0 to num templates - 1
for cloze deletions, valid values are from 0 to max cloze index - 1 (they\'re 0 indexed despite the first being called `c1`)');
            $table->integer('mod')->comment('modificaton time as epoch seconds');
            $table->integer('usn')->comment('pdate sequence number : used to figure out diffs when syncing. 
value of -1 indicates changes that need to be pushed to server. 
usn < server usn indicates changes that need to be pulled from server.');
            $table->integer('type')->comment('0=new, 1=learning, 2=review, 3=relearning');
            $table->integer('queue')->comment('-3=user buried(In scheduler 2),
-2=sched buried (In scheduler 2), 
-2=buried(In scheduler 1),
-1=suspended,
0=new, 1=learning, 2=review (as for type)
3=in learning, next rev in at least a day after the previous review
4=preview');
            $table->integer('due')->comment('Due is used differently for different card types: 
new: note id or random int
due: integer day, relative to the collection\'s creation time
learning: integer timestamp in second');
            $table->integer('ivl')->comment('interval (used in SRS algorithm). Negative = seconds, positive = days');
            $table->integer('factor')->comment('The ease factor of the card in permille (parts per thousand). If the ease factor is 2500, the card’s interval will be multiplied by 2.5 the next time you press Good.');
            $table->integer('reps')->comment('number of reviews');
            $table->integer('lapses')->comment('the number of times the card went from a "was answered correctly" 
to "was answered incorrectly" state');
            $table->integer('left')->comment('of the form a*1000+b, with:
b the number of reps left till graduation
a the number of reps left today');
            $table->integer('odue')->comment('original due: In filtered decks, it\'s the original due date that the card had before moving to filtered.
If the card lapsed in scheduler1, then it\'s the value before the lapse. (This is used when switching to scheduler 2. At this time, cards in learning becomes due again, with their previous due date)
In any other case it\'s 0.');
            $table->integer('odid')->comment('original did: only used when the card is currently in filtered deck');
            $table->integer('flags')->comment('an integer. This integer mod 8 represents a "flag", which can be see in browser and while reviewing a note. Red 1, Orange 2, Green 3, Blue 4, no flag: 0. This integer divided by 8 represents currently nothing');
            $table->text('data')->default("")->comment('currently unused');

            $table->index('nid', 'ix_cards_nid');
            $table->index(['did', 'queue', 'due'], 'ix_cards_sched');
            $table->index('usn', 'ix_cards_usn');
        });
        $tableName = self::TABLENAME;
//        $this->schema->getConnection()->statement(
//            "ALTER TABLE `$tableName` comment 'Cards are what you review.
//There can be multiple cards for each note, as determined by the Template.'");
    }

    public function down()
    {
        Capsule::schema()->drop(self::TABLENAME);
    }
}
