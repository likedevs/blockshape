<?php

use Illuminate\Database\Seeder;

class QuizHintsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('quiz_hints')->delete();

        \DB::table('quiz_hints')->insert([
            0  =>
                [
                    'id'   => 1,
                    'code' => '1',
                    'hint' => 'A se atrage atenţia la prezenţa în raţia alimentară a produselor ce conţin proteine de origine animalieră (animală): carne slabă, peşte, ouă, produse lactate degresate. Insuficienţa de proteine duce la scăderea capacităţii de muncă, a rezistenţei organismului la infecţii, cît şi la incapacitatea de a îndeplini sarcinile programului de antrenamente. Proteinele, constituind materialul plastic de bază din care sunt formate toate ţesuturile organismului, sunt foarte importante pentru formarea şi tonifierea muşchilor scheletici. Dacă nu se respectă norma de întrebuinţare a proteinelor în timpul antrenamentelor în zilele catabolice, se poate ajunge la scăderea nivelului de hemoglobină, la apariţia durerilor de cap şi la disfuncţii ale ciclului menstrual. Astfel aportul adecvat de proteine din alimentaţie asigură o stare bună a sănătăţii şi o modelare (esetică ) a corpului, prin creşterea masei musculare în locurile necesare.',
                ],
            1  =>
                [
                    'id'   => 2,
                    'code' => '2',
                    'hint' => 'Intrebuinţarea unei cantităţi mari de proteine de origine animală este însoţită de acumularea în organism a grăsimilor, colesterolului, reziduurilor azotate (produse ce rezultă în urma metabolizării proteinelor),toate acestea ducând la scăderea eficienţei antrenamentelor. Retenţia produşilor azotaţi în organism are consecinţe grave asupra articulaţiilor, deoarece acestea se depun sub formă de cristale în cavitatea articulară şi duce la patologii reumatologice ca (artrita, guta). Excreţia produşilor azotaţi are loc pe cale renală, aceştia fiind în cantităţi mari prezintă un risc crescut pentru funcţia excretorie a rinichilor-acesta este cel mai mare pericol pe care îl aduce cu sine un regim alimentar bogat în proteine. Este necesar de a învăţa calculul corect al proteinelor, glucidelor şi grăsimilor pentru a asigura organismul cu o cantitate optimă, evitînd excesul.',
                ],
            2  =>
                [
                    'id'   => 3,
                    'code' => '3',
                    'hint' => 'In cazul unui aport prea scazut de calciu, organismul apeleaza la rezervele de calciu din oase-principalul depozit de Ca din organism, aceasta avînd ca consecinţă osteoporoza sau osteopenia. El este necesar pentru normalizarea proceselor de oxidare la nivelul sistemului nervos şi de contracţie a muşchilor, activeaza unii fermenţi şi hormoni, participă în procesul de coagulare a sîngelui, are acţiune antiinflamatorie şi desensibilizantă. Deficitul de calciu poat duce la traume şi fracturi la nivel de aparat locomotor, deteriorarea dinţilor ş.a. Cantitatea necesară de calciu constituie lg/zi. Surplusul de grăsimi în raţia alimentară dereglează absorbţia calciului. Sursele de baza de calciu sunt brânza de vaci degresată, laptele, caşcavalul degresat, ceapa verde, pătrunjelul, mărarul; de fosfor - peşte slab, ouă integrale, fasole.',
                ],
            3  =>
                [
                    'id'   => 4,
                    'code' => '4',
                    'hint' => 'S-a depistat deficit în organism de vitaminele P şi C (acid ascorbic). Aceste vitamine asigură procesele de formare a energiei în organism, întăresc vasele sanguine, cresc imunitatea şi rezistenţa organismului la bacterii şi viruţi. Deasemenea ele posedă afect antioxidant şi antiinflamator puternic, înlătură radicalii liberi care sunt responsabili pentru schimbările canceroase şi procesele inflamatorii din roganism. Insuficienţa acestor vitamine are ca consecinţe: viroze frecvente, scădeea capacităţii de muncă, hemoragii capilare la nivelul pielii în urma unor atingeri sau compresiuni nesemnificative, astfel se explică apariţia rapidă şi frecventă a vînătăilor. Necesarul de vitamina P - 35-50 mg/zi, vitamina C - 60-100 mg/zi. Se găsesc îndeosebi în măceş uscat şi proaspăt, cirice, struguri, stafide,  usturoi, ardei dulci verzi şi roşii, coacăză, zmeură, în pătrunjel, mărar, varză, fragi.În urma prelucrării taermice (fierbere, îngheţare) aceste vitamine îşi pierd proprietăţile, deaccea este preferabil consumul produselor, enumerate mai sus, în stare crudă.',
                ],
            4  =>
                [
                    'id'   => 5,
                    'code' => '5',
                    'hint' => 'S-a depistat deficit de substanţe hidrosolubile biologic active şi de săruri: potasiu, vitamina A , , vitamina K, acid folic (vit B9). Vitamina K este un nutrient esenţial care ajută la prevenirea hemoragiilor, afecţiunilor pielii, scade riscul de atac de cord, reduce riscul de menstruaţii abundente şi dureroase, împiedică formareacalculilor renali, previne osteoporoză, artrită şi alte afecţiuni ale oaselor. Cele mai bogate surse naturale de vitamina K sunt: legumele cu frunze verzi, cum este spanacul, broccoli, salata, varza, pătrunjelul, năutul, varza de Bruxelles, germenii de grâu, uleiul de rapiţă şi cel de măsline. Potasiul (sau Kaliu) este , împreună cu Ca, principalul reglator al ritmului cardiac, şi al eficienţei contracţie muşchiului inimii. Insifiecienţa de potasiu are ca consecinţă cea mai gravă –dereglările de ritm cardiac. Cantităţi sporite de potasiu pot fi găsite în special în alimentele neprelucrate, cum sunt fructele şi  legumele (banane, cartofi, prune, roşii, stafide, spanac, migdale, seminţe de floarea soarelui), carnea proaspătă, lactate, care nu au suferit niciun fel de pregătire termică. Vitamina A este responasbilă de buna funcţionare a aparatului vizual, a tuturor tegumentelor şi mucoaselor şi de sănătatea glandei mamare. Insuficienţa de vit. A duce la scăderea vederii, înrăutăţirea stării pielii şi a mucoaselor: (bucale şi vaginale, nu ştiu dacă trebuie de specificat) . Vitamina A segăseşte în ficat, ouă, peşte gras, laptele integral, fructele şi legumele verzi şi galbene, portocalele, morcovii, mango. Acidul folic (sau vit B9) este esenţial în procesele de regenerare şi are proprietăţi antiinflamatorii puternice în cadrul inflamaţiilor cronice. Mai este un puternic antioxidant, astfel previne apariţia cancerului. Cele mai bune surse naturale de acid folic sunt: legumele cu frunze verzi, fasole, mazăre, linte, gălbenuş de ou, cereale, seminţe,  citrice, banane.',
                ],
            5  =>
                [
                    'id'   => 6,
                    'code' => '6',
                    'hint' => 'Există posibilitatea unei insuficienţe de fier în organism. Se recomandă efectuarea analizei generale de sînge pentru a verifica nivelul de hemoglobină . A se atrage atenţia asupra conţinutului în raţia alimentară a produselor din carne slabă (cu conţinut scăzut de grăsime), peşte în combinaţie culegume proaspete. Surse naturale de fier sunt: ouă, carnea slabă, peşte, fructele uscate, cerealele şi legumele verzi. Deficitul de fier se răsfrânge asupra aspectului pielii, unghiilor, părului, scade capacitatea fizică şi intelectuală, creşte riscul apariţiei diferitor patologii infecţioase în urma scăderii rezistenţei organismului la viruşi şi bacterii. Necesarul de fier- 15-18 mg/zi. Alimentele cu conţinut crescut de amidon (pîinea albă, cartoful, cerealele rafinate) şi grăsimi nu doar au un conţinut sărac de fier dar mai blochează absorbţia acestuia la nivel de intestin subţire.',
                ],
            6  =>
                [
                    'id'   => 7,
                    'code' => '7',
                    'hint' => 'Acizii graşi esenţiali şi fosfolipidele sunt principalii componenţii ai membanelor celulare. Astfel cea mai mare necesitate de aceste substanţe o au celulele ficatului, creierului, retinei, pielii şi ceulele sexuale feminine-ovulul. Absenţa sau insuficienţa de grăsimi biologice preţioase (acizi graşi esenţiali, fosfolipide) se răsfrânge negativ asupra stării pielii, a ochilor, a capacităţii ficatului de a neutraliza toxinele şi asupra sănătăţii sistemului urogenital.Deasemenea insuficienţa grăsimilor biologie bune scade eficienţa antrenamentului prin faptul ca acestea sunt responsabile de mobilizarea grăsimilor rele (colesterol, trigliceride) din ţesuturi şi transportul lor,prin sînge, spre ficat, prevenind depunerea lor pe peretele vaselor. Se recomandă de a întrebuinţa uleiuri vegetale neprelucrate termic, miez de nucă, arahide, seminţe de floarea soarelui, somon, avocado.',
                ],
            7  =>
                [
                    'id'   => 8,
                    'code' => '8',
                    'hint' => 'A se elimina din raţie toate grăsimile vizibile. Carnea trebuie doar fiarta, dupa fierbere bulionul se arunca.A exclude total de la întrebuinţarea mezelurilordeoarece acestea , pe lîngă faptul că au un conţinut sărac de proteine şi unul crescut de grăsimi, mai conţin şi o cantitate crescută de aditivi alimentari sintetici, conservanţi şi coloranţi care au un efect nociv şi cancerogen crescut asupra tractului digestiv (pancreas, floră intestinală) şi excretor (rinichi). Prezenţa acestora deseori poate să nu fie indicată pe ambalajul produsului, din considerente comerciale. Produsele de patiserie, torturile, biscuitii si restul dulciurilor (exceptie ciocolata cu cacao 75%) sunt o sursa bogata in glucide nefolositoare, care nefiind utilizate imediat se stocheaza sub forma de tesut adipos. Acestea mai contin si o cantitate mare de conservanti si coloranti sintetici pentru a avea aspect si miros atragator si termen de valabilitate mare. Untul este o sursa buna de energie doara daca sunteti in virsta copilariei, noi presupunem ca ati trecut de ea si nu mai aveti nevoi de un aport atit de mare de  calorii pentru a explora lumea inconjuratoare. Maioneza ca si untul are o valoare energetica mult crescuta, dar pe linga asta este toxica pentru ficatul dvs prin continutul crescut de grasimi saturate, conservanti si aromatizatori sintetici. Atentie mare la produsele ce contin maioneza sau produsele de patiserie cu crema, acestea constituie un mediu favorabil pentru dezvoltarea salmonelei, care este un agent cauzal al toxico-infectiilor alimentare, cu consecinte uneori fatale.',
                ],
            8  =>
                [
                    'id'   => 9,
                    'code' => '9',
                    'hint' => 'Este indicată creşterea numărului meselor şi scăderea în cantitate a porţiilor alimentare.Se recomandă de urmat strict recomandările alimentare în conformitate cu orele de antrenamentdar numarul lor nu trebuie sa fie mai mic de 5 pe zi, 3 –de baza si 2 gustari, cantitatea consumata la o priza laimentara nu trebuie sa depaseasca 400g. Numărul regulat şi frecvent de mese, cu porţii mai mici previne apariţia patologiilor tractului digestiv ca  gastrita, colecistită, pancreatită precum şi a constipaţiei. Nu în ultimul rînd aceasta contribuie la o pierdere ponderală gradată şi sănătoasă fără consecinţe negative asupra sănătăţii.',
                ],
            9  =>
                [
                    'id'   => 10,
                    'code' => '10',
                    'hint' => 'Alcoolul, ceaiul şi cafeaua tare, băuturile carbogazoase, dulci şi acidulate indiferent de perioada zilei în care se consumă , scad capacitatea de absorbţie a vitaminelor şi microelementelor în intestinul subţire. Prin aportul caloric rapid aceste băuturi sunt periculoase atît prin depunerea rapidă a ţesutului adipos cît şi prin faptul că pentru asimilarea lor este necesară secreţia unei cantitîţi mari de insulină în timp scurt, fapt care creşte riscul apariţiei diabetului zaharat. Cafeua si alcoolul, consumate zilnic deshidrateaza organismul.',
                ],
            10 =>
                [
                    'id'   => 11,
                    'code' => '11',
                    'hint' => 'Apa, atat de pretioasa pentru sanatate, este adesea inlocuita cu cafea, bauturi acidulate, alcool. Prin folosirea acestor bauturi, organismul are nevoie de tot mai multa apa, pentru a putea dilua şi elimina substantele nocive, ce intra in compozitia lor. Cofeina si alcoolul deshidrateaza organismul. Apa este singurul, cel mai important catalizator in scaderea si mentinerea greutatii. Apa activeaza metabolismul, impiedica depunerea de grasime, ajuta la reprimarea poftei de mancare si a senzatiei de foame. Aportul adecvat de apa previne deshidratarea si asigura o buna functionare a tuturor sistemelor incliv cel muscular, fiind esentiala in metabolismul muscular. De asemenea,in cazul unei pierderi considerabile in kg, consumul suficient de apa va preveni aspectul inestetic al pielii. Consumul suficient de apă  pe parcursul vietii previne si incetineste   îmbătrînirea fiziologica  pielii, prin faptul ca datorita ei colagenul din piele supravietuieste mai mult timp.',
                ],
            11 =>
                [
                    'id'   => 12,
                    'code' => '12',
                    'hint' => 'A fost depistat un eventual deficit în organism de vitamine B2 (riboflavină) şi Bl (tiamină), tulburări în activitatea sistemului nervos şi ale proceselor de asigurare cu energie a organismului. Necesarul de vitamina Bl este de 1,4-2,4 mg/zi, vitamina B2 -1,5-3,0 mg/zi. Se recomandă produse cu un conţinut înalt de aceste vitamine: tărâţe de grâu, crupe de hrişcă, fasole, mazăre în  ouă , brânză degresată de vaci, măceş uscat şi proaspăt.',
                ],
            12 =>
                [
                    'id'   => 13,
                    'code' => '13',
                    'hint' => 'Sa depistat asigurarea slabă a organismului cu vitamina B6 (piridoxină), care participă la schimbul de aminoacizi (proteine), glucide şi grăsimi. Vitamina B6 este necesară pentru activitatea normală a sistemului nervos, ficatului. Necesarul de vitamina B6 este de 2,0-2,2 mg/zi. Surse de bază în alimentaţia: crereale intergale , mazăre, fasole, hrişcă, cartofi copti cu coaja.',
                ],
            13 =>
                [
                    'id'   => 14,
                    'code' => '14',
                    'hint' => 'Magneziul posedă actiune antispastica, vasodilatatoare, măreşte peristaltismul intestinal, eliminarea bilei şi a colesterolului prin intestin. Dereglarea proceselor de absorbţie la nivelul intestinului, folosirea diureticelor, dieta saraca in cereale, legume si in special bobose poate provoca hipomagneziemia cu apariţia crampelor musculare, osteoporozei, hipertensiunii arterialei,dereglarilor de ritm cardiac, iritabilitatii, dereglari de somn, senzatie de oboseala cronica. Sunt bogate în magneziu cerealele integrale, , leguminoasele, boboasele, fructele uscate, ouale, nucile, sfecla, salata verde, morcovul, cacao.',
                ],
            14 =>
                [
                    'id'   => 15,
                    'code' => '15',
                    'hint' => 'Vitamina E e denumită şi tocoferol  se găseşte în cantităţi mari în, ouă, produse lactate, nuci, seminţe, cereale integrale şi uleiuri vegetale. Rolul acestei vitamine e de a scădea riscul bolilor cardiace, de a ameliora durerile menstruale, inhibă radicalii liberi implicaţi în degradarea celulară, menţine structura şi funcţionalitatea normală a sistemului reproductiv şi asigură troficitatea sistemului muscular. Vitamina E actioneaza sinergic cu vitamina A si sta la baza sanatatii si tineretii pielii si a mucoaselor',
                ],
        ]);
    }

}
