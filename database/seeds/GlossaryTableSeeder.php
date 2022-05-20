<?php

use Illuminate\Database\Seeder;

class GlossaryTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('glossary')->delete();

        \DB::table('glossary')->insert([
            0 =>
                [
                    'id'         => 5,
                    'title'      => 'Tip constituțional',
                    'slug'       => 'definition.constitution',
                    'body'       => '<p>Totalitatea trasaturilor fizice externe, ce tin de o anumita dispunere a scheletului, muschilor si tesutului adipos. Tipul constitutional depinde de fondul genetic, influenta hormonala (tipul ginoid sau androgen) si conditiile de viata in perioada de crestere</p>',
                    'widget'     => 0,
                    'created_at' => '2015-08-14 10:41:53',
                    'updated_at' => '2015-08-14 13:56:43',
                ],
            1 =>
                [
                    'id'         => 19,
                    'title'      => 'Metabolismul',
                    'slug'       => 'definition.metabolism',
                    'body'       => '<p>METABOLISMUL este totalitate a reacţiilor biochimice care se produc &icirc;n organism la nivelul tesuturilor si consta din 2 procese:</p>
<ul>
<li>ANABOLISM (asimilitatie, sinteza, formare), adica acele reactii care transforma moleculele mai mici in molecule mai mari;</li>
<li>CATABOLISM (dezasimilatie, descompunere, dezintegrare) acele reactii care convertesc moleculele mari in molecule mai mici.</li>
</ul>
<p>Aceste procese (catabolism si anabolism) predomina in organismul femeii in dependenta de fonul hormonal (estrogen si progesteron) care persista pe parcursul ciclului ovarial menstrual.</p>
<p>Zilnic corpul Dvs. arde in stare de repaos, atunci cand dormiti, mancati, respirati, etc un numar de calorii ce reprezinta rata metabolica bazala (RMB).</p>',
                    'widget'     => 0,
                    'created_at' => '2015-08-14 11:42:39',
                    'updated_at' => '2015-08-14 13:58:30',
                ],
            2 =>
                [
                    'id'         => 23,
                    'title'      => 'Metabolismul (Menopauza)',
                    'slug'       => 'definition.metabolism.menopause',
                    'body'       => '<p><strong>PROGRAMUL DE TRANSFORMARE A SILUETEI</strong></p>
<p><span style="text-decoration: underline;"><strong>I ETAPA:&nbsp;</strong><em>SLABIRE</em></span></p>
<p>cu durata de :estimated_time&nbsp;luni</p>
<p><span style="text-decoration: underline;"><strong>II ETAPA:&nbsp;</strong><em>REMODELAREA CORPORALA SI TONIFIEREA CU MUSCHI</em></span></p>
<p>cu durata de :estimated_time&nbsp;luni</p>
<p><span style="text-decoration: underline;"><strong>III ETAPA:&nbsp;</strong><em>MENTINERE</em></span>&nbsp;</p>
<p>Parametrii siluetei se mentin in limitele dorit ca rezultat al respectarii urmatoarelor recomandare:</p>
<ol>
<li>Efort fizic dozat minim de 3 ori pe saptamana</li>
<li>Mentinerea comportamentului alimentar format in etapele anerioare</li>
<li>Monitorizarea regulata a parametrilor siluetei (o data pe luna)</li>
<li>Monitorizarea regulata a starii generale de sanatate ( o data in jumatate de an)</li>
<li>Socializarea in grup cu persoanele care au acelasi mod de viata sanatos.</li>
</ol>
<p>&nbsp;</p>',
                    'widget'     => 0,
                    'created_at' => '2015-08-14 12:04:02',
                    'updated_at' => '2015-08-14 14:06:43',
                ],
            3 =>
                [
                    'id'         => 25,
                    'title'      => 'Pulse',
                    'slug'       => 'definition.pulse',
                    'body'       => '<p>Procesul de inspr si expir pe durata antrenamentului este foarte important deoarece ca rezultat are obtinerea pulsului recomandat.</p>',
                    'widget'     => 0,
                    'created_at' => '2015-08-17 09:22:18',
                    'updated_at' => '2015-08-17 09:22:18',
                ],
            4 =>
                [
                    'id'         => 29,
                    'title'      => 'Detoxifiere',
                    'slug'       => 'definition.detoxification',
                    'body'       => '<p>Detoxifiereal este o perioadă pentru organism c&acirc;nd punem metabolismul &icirc;n repaus, c&acirc;nd &icirc;i dăm posibilitatea să elimine toxinele. Atunci c&acirc;nd faci detoxifierea o zi pe săptăm&acirc;nă este bine să consume un tip de aliment.</p>
<p><strong>ALIMENTELE RECOMANDATE PENTRU DETOXIFIERE:</strong></p>
<ol>
<li><strong>Cerealele</strong> care conţin gluten -&nbsp;orzul, ovăzul, secara şi gr&acirc;ul.(500-600 gr pe zi)</li>
<li><strong>Legumele&nbsp;-&nbsp;</strong>toate sunt grozave, &icirc;nsă următoarele fac minuni: ardei gras, sfeclă, broccoli, varză roşie, morcovi, conopidă, castraveţi, dovleac, spanac, roşii. De evitat &icirc;n r&acirc;ndul legumelor sunt cartofii. (1 kg 500 g)</li>
<li><strong>Fructele&nbsp;-&nbsp;</strong>cam toate fructele favorizează detoxifierea, dar printre cele mai benefice se numără: citricele, kiwi, merele, merele coapte. Evită fructele uscate şi bananele (1 kg 500 g)</li>
<li><strong>Produsele lactate -&nbsp;</strong>branza (500 g), chefir, (1 litru)</li>
<li><strong>Apa</strong> (pana la trei litri)</li>
</ol>
<p>&nbsp;</p>',
                    'widget'     => 0,
                    'created_at' => '2015-08-17 09:41:47',
                    'updated_at' => '2015-08-17 12:32:23',
                ],
        ]);
    }

}
