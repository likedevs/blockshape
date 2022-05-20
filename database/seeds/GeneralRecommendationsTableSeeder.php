<?php

use Illuminate\Database\Seeder;

class GeneralRecommendationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('general_recommendations')->delete();

        \DB::table('general_recommendations')->insert([
            0 =>
                [
                    'id'   => 1,
                    'body' => '<p><strong>Importanța apei</strong></p>
<p>Ai grija sa hidratezi sufficient organismul.Apa este singurul, cel mai important catalizator in scaderea si mentinerea greutatii. Apa activeaza metabolismul, impiedica depunerea de grasime, ajuta la reprimarea poftei de mancare si a senzatiei de foame.Apa ajuta si la mentinerea tonusului muscular, oferindu-le muschilor proprieatea naturala de a se contracta, prevenind deshidratarea. De asemenea, ajuta la evitarea atarnarii pielii, care urmeaza de obicei dupa o scadere brusca in greutate.Este recomandat de consumat 30-40 ml de apa la 1 kg de masa corporala.</p>',
                    'rank' => 1,
                ],
            1 =>
                [
                    'id'   => 2,
                    'body' => '<p><strong>Importanța regimului alimentar stabil</strong></p>
<p>Se recomanda ca pe parcursul zilei sa luati 3 mese principale si 2 gustari, cantitatea acestora nu trebuie sa depaseasta 400g la o priză alimentară.Respectarea numarului meselor si gustarilor este importanta pentru mentinerea unei greutati corporale ideale, pierdea in greutate, evitarea infometarii precum si pentru prevenirea patologiilor sistemului digestiv asa ca : gastrita, pancreatita, colecistita.Deasemenea consumal mai frecvent a unor cantitati mai mici de mincare stimuleaza metabolismul si il face mai eficient!</p>',
                    'rank' => 2,
                ],
            2 =>
                [
                    'id'   => 3,
                    'body' => '<p><strong>Importanța somnului</strong></p>
<p>Respectati regimul orelor de somn necesar de 8 ore pe noapte, aceasta va proteja sistemul nervos central de o degenerare precoce, va compensa stresul zilnic, va reduce iritabilitatea si oboseala in decursul zilei, va scadea pofta de mincare, va contribui la relaxarea si tonifierea corecta a muschilor! Reiesind din toate acestea 8 ore de somn nocturn va garanteaza un corp odihnit si gata pentru a lucra eficient atit fizic cit si intelectual!</p>',
                    'rank' => 3,
                ],
            3 =>
                [
                    'id'   => 4,
                    'body' => '<p><strong>Importanța oxigenului!</strong></p>
<p>Va recomandam ca de fiecare data cind iesiti in aer liber, sa profitati la maxim de aceasta ocazie pentru a savura linistea naturii, a face exercitii respiratorii, si chiar sport in aer liber! Aceasta nu doar ca va fi un mare beneficiu pentru sistemul cardiovascular si respirator dar deasemenea va va oferi o doza buna de liniste, oxigen, putere si sanatate de care cu totii avem atit de mare nevoie pentru nedetasa de stres si rutina!</p>',
                    'rank' => 4,
                ],
            4 =>
                [
                    'id'   => 5,
                    'body' => '<p><strong>Investigații recomandate</strong></p>
<p>Va recomandam sa efectuați următoarele unvestigații o data in jumatate de an:</p>
<ol>
<li>Analiza sangelui</li>
<li>Analiza urinei</li>
<li>Ultrasonografia organelor interne</li>
<li>Consultatia regularite a medicului conform patologiilor cronice</li>
</ol>',
                    'rank' => 5,
                ],
        ]);
    }

}
