<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("CREATE TRIGGER fakulteti_trigger
            AFTER INSERT ON answers
            FOR EACH ROW BEGIN
                IF NEW.question_id = 7 AND NEW.text > '' THEN
                    IF (SELECT COUNT(*) FROM colleges WHERE name = NEW.text) > 0 THEN
                        UPDATE colleges SET counter = counter + 1 WHERE name = NEW.text;
                        ELSE INSERT INTO colleges (name, counter) VALUES (NEW.text, 1);
                    END IF;
                END IF;
            END;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared("DROP TRIGGER fakulteti_trigger");
    }
}
