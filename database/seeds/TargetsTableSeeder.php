<?php

use Illuminate\Database\Seeder;

class TargetsTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
		\DB::table('targets')->delete();
        
		\DB::table('targets')->insert(array (
			0 => 
			array (
				'id' => 1,
				'name' => 'Slabire',
				'slug' => 'weight-loss',
			'imc' => '<p>Indicile masei corporale (IMC) ste un indicator oficial, recunoscut stiintific, de analiză a gradului de obezitate prin estimarea cantității de grăsime corporală. Pentru a va bucura de o viata sanatoasa este esential sa va mentineti o greutate corporala normala, deoarece, cu cat greutatea Dvs. &nbsp;creste, cu atat creste riscul imbolnavirii de hipertensiune arteriala, boli de inima, diabet, aparitia unui accident vascular cerebral, diferite forme de cancer, etc. Astfel, scaderea sperantei de viata este direct proportional cu cresterea valorii IMC</p>',
				'metabolism' => '<p>Corpul Dvs. consuma in stare de repaos <span style="text-decoration: underline;">:current_metabolism calorii,</span> ce reprezinta RMB. In perioada catabolica procesul de slabire este mai intens, deoarece predomina hormonul estrogen. Antrenamentele sunt mai eficiente pentru a slabi. Aveti grija de alimentatia recomandata de nutritionistii UNICA, nu lipsiti de la antrenamente si va apropiati lunar de instructorul Dvs. pentru masurari.</p>
<p>In perioada anabolica procesul de slabire este mai lent, predomina procesul de sinteza datorita hormonului progesteron. Continuati sa va alimentati corect si sa frecventati antrenamentele pentru a obtine o reliefare mai eficienta a corpului. Doar dupa ce veti obtine rezultatul recomandat, adaugati 200-300 calorii pe durata perioadei anabolice. (nu mariti cantitate de mancare la o priza alimentara ci adaugati inca o gustare sau doua pe zi).</p>
<p><em><strong>PROGRAMUL DE TRANSFORMARE A SILUETEI</strong></em></p>
<p><span style="text-decoration: underline;"><strong>I ETAPA:&nbsp;</strong><em>SLABIRE</em></span></p>
<p style="padding-left: 30px;">Cu durata de :estimated_time luni</p>
<p style="padding-left: 30px;">I faza: Catabolica - Catabolica sintetica: 1-2 luni</p>
<p style="padding-left: 30px;">II faza: Catabolica - Anabolica cu efect minim: :estimated_time_anablic luni</p>
<p style="padding-left: 30px;">In I faza &ldquo;Catabolica - Catabolica sintetica&rdquo; procesul de slabire este continuu.</p>
<p style="padding-left: 30px;">In a II faza &ldquo;Catabolica - Anabolica cu efect minim&rdquo; procesul de slabire este mai intens in perioada catabolica iar in perioada anabolica organismul se adapteaza la kg pierdute.</p>
<p><span style="text-decoration: underline;"><strong>II ETAPA:&nbsp;</strong><em>REMODELAREA CORPORALA SI TONIFIEREA CU MUSCHI</em></span></p>
<p style="padding-left: 30px;">Cu durata de :estimated_time luni</p>
<p style="padding-left: 30px;">III faza: Catabolica&nbsp;-&nbsp;Anabolica de adaptare :&nbsp;:estimated_time luni</p>
<p style="padding-left: 30px;">In a III faza &ldquo;Catabolica&nbsp;-&nbsp;Anabolica de adaptare&rdquo; silueta se modeleaza prin efort fizic dozat pentru anumite grupe de muschi conform tipului constitutional si respectand regimul alimentar recomandat de catre nutritionistii UNICA conform scopului.</p>
<p style="padding-left: 30px;">In perioada catabolica exercitiile fizice contribuie mai mult la tonifierea masei muscular pe cand in perioada anabolica are loc cresterea volumului fibrelor muscular ca rezultat se remodeleaza corpul.</p>
<p><span style="text-decoration: underline;"><strong>III ETAPA:&nbsp;</strong><em>MENTINERE</em></span></p>
<p style="padding-left: 30px;">IV faza: Catabolica&nbsp;-&nbsp;Anabolica fiziologica cu durata pe tot parcursul vietii.</p>
<p style="padding-left: 30px;">Parametrii siluetei se mentin in limitele dorit ca rezultat al respectarii urmatoarelor recomandare:</p>
<ol>
<li>Efort fizic dozat minim de 3 ori pe saptamana</li>
<li>Mentinerea comportamentului alimentar format in etapele anerioare</li>
<li>Monitorizarea regulata a parametrilor siluetei (o data pe luna)</li>
<li>Monitorizarea regulata a starii generale de sanatate ( o data in jumatate de an)</li>
<li>Socializarea in grup cu persoanele care au acelasi mod de viata sanatos.</li>
</ol>
<p>&nbsp;</p>',
			'pulse' => '<p>Va recomandam pe durata antrenamentului sa acumulati pulsul aerob (de la 120-180), doar cu ajutorul acestui puls se intensifica metabolismul si atingeti scopul propus cat mai curand.</p>',
				'resume' => '<p>Draga :name. Dvs. aveți la moment <strong><span style="text-decoration: underline;">:current_weight kg</span></strong> și doriți să slăbiși p&icirc;nă la <strong><span style="text-decoration: underline;">:target_weight kg</span></strong>.<br /> Rezultatul dorit poate fi obținut timp de <strong><span style="text-decoration: underline;">:estimated_time luni</span></strong><br /> Conform formulelor medicale greutatea recomandată pentru Dvs. este: <strong><span style="text-decoration: underline;">:max_weight kg</span></strong>.<br /> Resultatul recomandat poate fi obținut timp de <strong><span style="text-decoration: underline;">:estimated_time_max luni</span></strong></p>',
			),
			1 => 
			array (
				'id' => 2,
				'name' => 'Tonifiere',
				'slug' => 'maintenance',
			'imc' => '<p>Indicile masei corporale (IMC) ste un indicator oficial, recunoscut stiintific, de analiză si estimarea a cantității de grăsime corporală. Pentru a va bucura de o viata sanatoasa este esential sa va mentineti o greutate corporala normala, deoarece, cu cat greutatea Dvs. creste, cu atat creste riscul imbolnavirii de hipertensiune arteriala, boli de inima, diabet, aparitia unui accident vascular cerebral, diferite forme de cancer, etc. Astfel, scaderea sperantei de viata este direct proportional cu cresterea valorii IMC.</p>',
				'metabolism' => '<p>Corpul Dvs consuma in stare de repaos <span style="text-decoration: underline;">X calorii</span>, ce reprezinta RMB. In perioada catabolica procesul de slabire este mai intens, deorece predomina hormonul estrogen. In aceasta perioada puteti pierde 1-2 kg,ca effect a procesului catabolic dar pe care le veti recupera in perioada anabolica datorita predominarii hormonului progesteron. Aveti grija de alimentatia recomandata de nutritionistii UNICA si frecventati cu regularitate antrenamentele. Apropiati-va de instructorul Dvs. lunar pentru masurari.</p>
<p><strong>PROGRAMUL DE TRANSFORMARE A SILUETEI</strong></p>
<p><span style="text-decoration: underline;"><strong>I ETAPA</strong>:&nbsp;<em>REMODELAREA CORPORLA</em></span></p>
<p>Cu durata de 1 luna</p>
<p>I faza: Catabolica - Anabolica cu efect minim - 1 LUNA</p>
<p>In a I faza &ldquo;Catabolica&nbsp;-&nbsp;Anabolica cu efect minim&rdquo; procesul de slabire este mai intens in perioada catabolica iar in perioada anabolica organismul se adapteaza si adauga kg pierdute prin cresterea volumului fibrelor musculare.</p>
<p><strong>II ETAPA:&nbsp;</strong><em>TONIFIEREA CU MUSCHI</em></p>
<p>II faza: Catabolica&nbsp;-&nbsp;Anabolica de adaptare &ndash; 6 luni (la toti programa da acest rezultat)&nbsp;</p>
<p>In a II faza &ldquo;Catabolica&nbsp;-&nbsp;Anabolica de adaptare&rdquo; silueta se modeleaza prin efort fizic dozat orientat spre anumite grupe de muschi conform tipului constitutional si respectand regimul alimentar recomandat de catre nutritionistii UNICA conform scopului.</p>
<p>In perioada catabolica exercitiile fizice contribuie mai mult la tonifierea masei musculare pe cand in perioada anabolica are loc cresterea volumului fibrelor muscular si ca rezultat se remodeleaza corpul.</p>
<p><span style="text-decoration: underline;"><strong>III ETAPA:&nbsp;</strong><em>MENTINERE </em></span></p>
<p>Cu durata nelimitata</p>
<p>III faza: Catabolica&nbsp;-&nbsp;Anabolica fiziologica&nbsp;</p>
<p>Parametrii siluetei se mentin in limitele dorit ca rezultat al respectarii urmatoarelor recomandare:</p>
<ol>
<li>Efort fizic dozat minim de 3 ori pe saptamana</li>
<li>Mentinerea comportamentului alimentar format in etapele anerioare</li>
<li>Monitorizarea regulata a parametrilor siluetei (o data pe luna)</li>
<li>Monitorizarea regulata a starii generale de sanatate ( o data in jumatate de an)</li>
<li>Socializarea in grup cu persoanele care au acelasi mod de viata sanatos.</li>
</ol>
<p>&nbsp;</p>',
			'pulse' => '<p>Va recomandam pe durata antrenamentului sa acumulati pulsul aerob (de la 120-180), doar cu ajutorul acestui puls se intensifica metabolismul si atingeti scopul propus cat mai curand.</p>',
				'resume' => '<p>Draga :name. Dvs. aveți la moment <strong><span style="text-decoration: underline;">:current_weight kg</span></strong> și doriți să aveți <strong><span style="text-decoration: underline;">:target_weight kg</span></strong>.<br /> Conform formulelor medicale Dvs. trebuie să aveți: <strong><span style="text-decoration: underline;">:max_weight kg</span></strong>.</p>',
			),
			2 => 
			array (
				'id' => 3,
				'name' => 'Adaos masa musculară',
				'slug' => 'weight-gain',
			'imc' => '<p>Indicile masei corporale (IMC) ste un indicator oficial, recunoscut stiintific, de analiză si estimarea a cantității de grăsime corporală. Pentru a va bucura de o viata sanatoasa este esential sa va mentineti o greutate corporala normala, deoarece, cu cat greutatea Dvs. creste, cu atat creste riscul imbolnavirii de hipertensiune arteriala, boli de inima, diabet, aparitia unui accident vascular cerebral, diferite forme de cancer, etc. Astfel, scaderea sperantei de viata este direct proportional cu cresterea valorii IMC.</p>',
			'metabolism' => '<p>Corpul Dvs consuma in stare de repaos <span style="text-decoration: underline;">:current_metabolism calorii, </span> ce reprezinta RMB. In perioada catabolica procesul de slabire este mai intens, deoarece predomina hormonul estrogen. Va recomandam sa adaugati inca 500-800 calorii in aceasta perioada (gustari cu continut proteic inalt). Aveti grija de alimentatia recomandata de nutritionistii UNICA si nu lipsiti de la antrenamente si va apropiati lunar de instructorul dvs pentru masurari.</p>
<p>In perioada anabolica predomina procesul de sinteza datorita hormonului progesteron. Profitati maxim de period anabolica pentru a creste masa musculara. Continuati sa va alimentati conform recomndarilor nutritionistilor Unica si frecventati antrenamentele pentru a obtine scopul dorit.</p>
<p><strong>PROGRAMUL DE TRANSFORMARE A SILUETEI</strong></p>
<p><span style="text-decoration: underline;"><strong>I ETAPA:&nbsp;</strong><em>REMODELAREA CORPORLA</em></span></p>
<p>I faza: Anabolica&nbsp;-&nbsp;Anabolica sintetica: 1,5 kg pe luna</p>
<p>In I faza &ldquo;Anabolica&nbsp;-&nbsp;Anabolica sintetica&rdquo; procesul anabolic trebuie sa fie mentinut continuu.&nbsp;</p>
<p><span style="text-decoration: underline;"><strong>II ETAPA:&nbsp;</strong><em>TONIFIEREA CU MUSCHI</em></span></p>
<p>II faza: Catabolica&nbsp;-&nbsp;Anabolica de adaptare. (in functie de durata perioadei de modelare, durata este egala cu cea de modelare).</p>
<p>In a II faza &ldquo;Catabolica&nbsp;-&nbsp;Anabolica de adaptare&rdquo; silueta se modeleaza prin efort fizic dozat pentru anumite grupe de muschi conform tipului constitutional si respectand regimul alimentar recomandat de catre nutritionistii UNICA conform scopului.</p>
<p>In perioada catabolica exercitiile fizice contribuie mai mult la tonifierea masei musculare pe cand in perioada anabolica are loc cresterea volumului fibrelor musculare ca rezultat se remodeleaza si se tonifica corpul.&nbsp;</p>
<p><span style="text-decoration: underline;"><strong>III ETAPA:&nbsp;</strong><em>MENTINERE </em></span></p>
<p>Cu durata nelimitata</p>
<p>III faza: Catabolica&nbsp;-&nbsp;Anabolica fiziologica</p>
<p>Parametrii siluetei se mentin in limitele dorit ca rezultat al respectarii urmatoarelor recomandare:</p>
<ol>
<li>Efort fizic dozat minim de 3 ori pe saptamana</li>
<li>Mentinerea comportamentului alimentar format in etapele anerioare</li>
<li>Monitorizarea regulata a parametrilor siluetei (o data pe luna)</li>
<li>Monitorizarea regulata a starii generale de sanatate ( o data in jumatate de an)</li>
<li>Socializarea in grup cu persoanele care au acelasi mod de viata sanatos.</li>
</ol>
<p>&nbsp;</p>',
			'pulse' => '<p>In timpul antrenamentului va recomandam sa acumulati puls aerob (intre 120 si 180) si anaerob (intre 180 si 200) pentru a controla procesele metabolice in scopul atingerii rezultatului dorit.</p>',
				'resume' => '<p>Draga :name. Dvs. aveți la moment <strong><span style="text-decoration: underline;">:current_weight kg</span></strong> și doriți să ajungeți p&icirc;nă la <strong><span style="text-decoration: underline;">:target_weight kg</span></strong>.<br /> Conform formulelor medicale Dvs. trebuie să aveți: <strong><span style="text-decoration: underline;">:max_weight kg</span></strong>.<br /> Masa musculară se adaugă &icirc;n mediu 1.5 kg pe luna.</p>',
			),
		));
	}

}
