<?php

use Illuminate\Database\Seeder;

class ImcsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('imcs')->delete();

        \DB::table('imcs')->insert([
            0 =>
                [
                    'id'        => 1,
                    'name'      => 'Underweight',
                    'value_min' => '0.0',
                    'value_max' => '18.4',
                    'note'      => 'Atentie! Sunteți subponderală - aveti cantitatea de grasimea corporala foarte scazuta ceea ce nu corespunde normelor fiziologice. IMC care se inscrie in limitele normei este intre 18,5 si 24,9. Va recomandam un aport caloric crescut pe baza de proteina animaliera si efort  fizic dozat după metoda Unica pentru acumulare de masa corporală. Respectati cu strictete regimul alimentar individual recomandat de către nutriționiștii Unica cu scopul de a crește valorile IMC pina la cele normale',
                ],
            1 =>
                [
                    'id'        => 2,
                    'name'      => 'Normal',
                    'value_min' => '18.5',
                    'value_max' => '24.9',
                    'note'      => 'Aveti cantitatea de grasime corporală suficientă pentru asigurarea unei sanatati optime .Indicele masei corporale se înscrie în limitele valorilor normale, intre 18,5 si 24,9. Va recomandam sa efectuati efort fizic dozat  si regulat după metoda Unica pentru a va modela silueta. Respectati regimul alimentar individual recomandat de către nutriționiștii Unica, cu scopul de a menține valorile IMC în limitele normale și pentru a vă bucura de o stare bună de sănătate toată viața!',
                ],
            2 =>
                [
                    'id'        => 3,
                    'name'      => 'Overweight',
                    'value_min' => '25.0',
                    'value_max' => '29.9',
                    'note'      => 'Atentie! Risc pentru sănătate. Aveti un indice al masei corporale marit, ceia ce corespunde gradului de supraponderalitate. IMC care se inscrie in limitele normei este intre 18,5 si 24,9. Obligatoriu trebuie sa schimbati obiceiurile alimentare pentru a ajunge la o greutate optima si a preveni toate consecintele negative ale excesului de kg asupra organismului! Va recomandam sa scadeti din greutate prin efort fizic dozat după metoda Unica  si alimentatie echilibrata recomandata in regimul alimentar individual de către nutriționiștii Unica. Împreună avem scopul de a aduce valorile IMC în limitele normale și a preveni toate consecintele negative ale excesului de kg asupra organismului!',
                ],
            3 =>
                [
                    'id'        => 4,
                    'name'      => 'Heavily Overweight',
                    'value_min' => '30.0',
                    'value_max' => '34.9',
                    'note'      => 'Atentie! Risc pentru sănătate. Aveti un indice al masei corporale marit, ceia ce corespunde gradului I de obezitate. IMC care se inscrie in limitele normei este intre 18,5 si 24,9.  Obligatoriu trebuie sa schimbati obiceiurile alimentare pentru a ajunge la o greutate optima si a preveni toate consecintele negative ale excesului de kg asupra organismului! Va recomandam sa scadeti din greutate prin efort fizic dozat după metoda Unica  si alimentatie echilibrata recomandata in regimul alimentar individual de către nutriționiștii Unica. Împreună avem scopul de a aduce valorile IMC în limitele normale și a preveni toate consecintele negative ale excesului de kg asupra organismului! ',
                ],
            4 =>
                [
                    'id'        => 5,
                    'name'      => 'Heavily Overweight 2',
                    'value_min' => '35.0',
                    'value_max' => '39.9',
                    'note'      => 'Atentie! Risc pentru sănătate. Aveti un indice al masei corporale marit, ceia ce corespunde gradului II  de obezitate. IMC care se inscrie in limitele normei este intre 18,5 si 24,9.  Obligatoriu trebuie sa schimbati obiceiurile alimentare pentru a ajunge la o greutate optima si a preveni toate consecintele negative ale excesului de kg asupra organismului! Va recomandam sa scadeti din greutate prin efort fizic dozat după metoda Unica  si alimentatie echilibrata recomandata in regimul alimentar individual de către nutriționiștii Unica. Împreună avem scopul de a aduce valorile IMC în limitele normale și a preveni toate consecintele negative ale excesului de kg asupra organismului!',
                ],
            5 =>
                [
                    'id'        => 6,
                    'name'      => 'Heavily Overweight 3',
                    'value_min' => '40.0',
                    'value_max' => '99.9',
                    'note'      => 'Atentie! Obezitate morbidă  - risc pentru sănătate .  Acesta e un semn de avertisment că greutatea și cantitatea de grăsime corporală  Vă afectează în mod radical sănătatea.  Sunteti supusa riscului aparitiei mai multor boli precum hipertensiunea, diabet, etc. IMC care se inscrie in limitele valorilor normale este intre 18,5 si 24,9. Obligatoriu trebuie sa schimbati obiceiurile alimentare pentru a ajunge la o greutate optima si a preveni toate consecintele negative ale excesului de kg asupra organismului! Vă recomandăm să scădeți în greutate prin practicarea efortului fizic dozat după metoda Unica și respectarea regimului alimentar individual recomandat de către nutriționiștii Unica. Împreună avem scopul de a aduce valorile IMC în limitele normei și a preveni toate consecintele negative ale excesului de kg asupra organismului.',
                ],
        ]);
    }

}
