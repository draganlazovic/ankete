<?php

use App\QuestionType;
use Illuminate\Database\Seeder;

class QuestionTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (QuestionType::count() == 0) {
            $maloTekstualnoPolje = new QuestionType;
            $maloTekstualnoPolje->name = 'Malo tekstualno polje';
            $maloTekstualnoPolje->takes_arguments = false;
            $maloTekstualnoPolje->save();

            $velikoTekstualnoPolje = new QuestionType;
            $velikoTekstualnoPolje->name = 'Veliko tekstualno polje';
            $velikoTekstualnoPolje->takes_arguments = false;
            $velikoTekstualnoPolje->save();

            $opcijaDaNe = new QuestionType;
            $opcijaDaNe->name = 'Opcija da-ne';
            $opcijaDaNe->takes_arguments = false;
            $opcijaDaNe->save();

            $opcijaSlaganjaSaTvrdnjom = new QuestionType;
            $opcijaSlaganjaSaTvrdnjom->name = 'Opcija slaganja sa tvrdnjom';
            $opcijaSlaganjaSaTvrdnjom->takes_arguments = false;
            $opcijaSlaganjaSaTvrdnjom->save();

            $opcijaDavanjaOceneOd1Do10 = new QuestionType;
            $opcijaDavanjaOceneOd1Do10->name = 'Opcija davanja ocene od 1 do 10';
            $opcijaDavanjaOceneOd1Do10->takes_arguments = false;
            $opcijaDavanjaOceneOd1Do10->save();

            $opcijaIzboraIzListePonudjenihOdgovora = new QuestionType;
            $opcijaIzboraIzListePonudjenihOdgovora->name = 'Opcija izbora iz liste ponuđenih odgovora';
            $opcijaIzboraIzListePonudjenihOdgovora->takes_arguments = true;
            $opcijaIzboraIzListePonudjenihOdgovora->save();
        }
    }
}
