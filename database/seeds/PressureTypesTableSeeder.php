<?php

use Illuminate\Database\Seeder;

class PressureTypesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('pressure_types')->delete();

        \DB::table('pressure_types')->insert([
            0 =>
                [
                    'id'   => 1,
                    'name' => 'Normotonie - Normotonie',
                    'note' => '<p>De la <strong>NORMOTONIE</strong> &icirc;n repaos la <strong>NOROMOTONIE</strong> la efort.</p>
<p>Felicitări! Aveţi un sistem cardiovascular sănătos şi adaptat pentru efort fizic!</p>
<p>Tot ce trebuie să faceţi este să menţineţi această stare prin practicarea cu regularitate a antrenamentelor dupa metoda unica şi alimentaţie sănătoasă recomandata de nutritionistii Unica! Efectuaţi exerciţiile de extindere şi relaxare p&icirc;nă la capăt, respiraţi corect &icirc;n timpul antrenamentului pentru evita suprasolicitarea cordului! Un mod sănătos de viaţă vă garantează o siluetă perfectă, o sănătate de fier şi o bătr&icirc;neţe fără boli!</p>',
                ],
            1 =>
                [
                    'id'   => 2,
                    'name' => 'Hipotonie - Normotonie',
                    'note' => 'De la HIPOTONIE în repaus la NORMOTONIE la efort. Atenţie ! Hipotonia în repaos nu este o stare mereu fiziologică, aceasta poate semnala o anemie cronică, surmenaj cronic, sau dereglări în funcţia glandei tiroide şi a suprarenalelor.Vă recomandăm să consulaţi un medic cardiolog si endocrenolog! Dar organismul Dvs reacţionează pozitiv la efortul fizic,practicînd sport regulat, pe lîngă aspectul fizic, veţi căpăta doza de energie necesară pentru a vă simţi bine şi sigură pe propriile forţe! Deasemenea efortul fizic dozat  poate să favorizeze oxigenarea ţesuturilor, îmbunătăţind lucrul cordului, poate preveni apariţia multor patologii legate de hipotensiunea cronică şi să le amelioreze pe cele existente. Vă este recomandat antrenament în prima jumătate a zilei (preferabil în orele dimineţii) pentru a crea un tonus bun pentru tot parcursul zilei! Efectuaţi exerciţiile de extindere şi relaxare pînă la capăt, respiraţi corect în timpul antrenamentului pentru  evita suprasolicitarea cordului! Un mod sănătos de viaţă vă garantează o siluetă perfectă, o sănătate de fier şi o bătrîneţe fără boli!',
                ],
            2 =>
                [
                    'id'   => 3,
                    'name' => 'Hipotonie - Hipertonie',
                    'note' => 'De la HIPOTONIE în repaus la HIPERTONIE la efort. Atentie! Organismul Dvs reacţionează hiperergic la efortul fizic mediu, compensator marinduse tensiunea arteriala, vă recomandăm să consultaţi un medic cardiolog pentru a elucida cauzele hipotoniei de repaos, care adesea este un motiv ascuns şi cauzele hipertoniei la efort mediu presupun că atît sistemul cardiovascular cît şi aparatul vestibular sunt sensibile la efort fizic. Pentru a evita  unele situaţii imprevizibile, vă rugăm mult să prezentaţi un certificat de la medic, conform căruia se confirmă că puteţi face sport. Aveţi nevoie de o perioadă de adapare (2-3 săptămîini) în care să creşteţi treptat încărcătura antrenamentului şi să adaptaţi sistemul cardiovascular la efort fizic. Evitaţi consumul de produse energizante înainte de antrenament (cafea, ceai, ciocolată), nu vă alimentaţi 2 ore înainte de antrenament. Efectuaţi exerciţiile de extindere şi relaxare pînă la capăt, respiraţi corect în timpul antrenamentului pentru  evita suprasolicitarea cordului și pentru a oxigena adecvat tesuturile! Anunţaţi instructorul dumneavoastră despre toate schimbările pe care le simţiţi în timpul şi după antrenament! Un mod sănătos de viaţă vă garantează o siluetă perfectă, o sănătate de fier  şi o bătrîneţe fără boli!',
                ],
            3 =>
                [
                    'id'   => 4,
                    'name' => 'Hipertonie - Atentie',
                    'note' => 'De la HIPERTONIE(120-130 mmHg) în stare de repaos. Atentie , urgenţă! Aţi făcut corect că aţi ales să faceţi sport! Nu uitaţi să consultaţi regulat medicul cardiolog şi să urmaţi cu stricteţe tratamentul indicat.  Veniţi la antrenament doar dacă valorite TA sunt în limitele normale pentru Dvs. Nu faceţi efort fizic dacă în ziua respectivă nu aţi primit tratamentul antihipertensiv.Apelaţi la ajutorul instructorului dumneavoastră pentru a vă doza corect încărcătura fizică, respiraţi corect în timpul antrenamentului, pentru a oxigena adecvat tesuturie si pentru a micsora lucrul cordului, respectaţi regimul alimentar prescris. Sportul practicat cu regularitate scaderea masei corporale  vă va ajuta să menţineţi valorile tensiunii arteriale în limitele normei şi să preveniţi efectele ireversibile ale acesteia. Efectuaţi exerciţiile de extindere şi relaxare pînă la capăt, respiraţi corect în timpul antrenamentului pentru  evita suprasolicitarea cordului și pentru a oxigena adecvat tesuturile! Anunţaţi instructorul dumneavoastră despre toate schimbările pe care le simţiţi în timpul şi după antrenament! Un mod sănătos de viaţă vă garantează o siluetă perfectă, o sănătate de fier  şi o bătrîneţe fără boli!',
                ],
        ]);
    }

}
