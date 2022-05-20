<?php

use Illuminate\Database\Seeder;

class DiseasesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('diseases')->delete();

        \DB::table('diseases')->insert([
            0  =>
                [
                    'id'         => 1,
                    'name'       => 'Sistemul respirator',
                    'note'       => 'Va recomandam  sa consulati medicul pneumolog pentru a monitoriza starea sistemului respirator si a urma toate masurile de profilaxie si tratament  necesare! Aparatul respirator constituie principalul sistem care asiga existenta omului!',
                    'disease_id' => null,
                ],
            1  =>
                [
                    'id'         => 2,
                    'name'       => 'Sistemul cardio-vascular',
                    'note'       => 'Va recomandam consultatia medicului cardiolog pentru a monitoriza starea sistemului cardiovascular si a urma toate masurile de profilaxie si tratament  necesare. Sistemul cardiovascular asigura transportulu tuturor substantelor in organism , buna functionare a acestuia sta la baza unei vieti indelungate si fericite!',
                    'disease_id' => null,
                ],
            2  =>
                [
                    'id'         => 3,
                    'name'       => 'Sistemul digestiv',
                    'note'       => '<p>Va recomandam sa consultati medicul gastrolog, gastroenterolog sau hepatolog pentru a monitoriza starea sistemului digestiv si a urma toate masurile de profilaxie si tratament necesare. Sistemul digestiv are o multitudine de functii, principala fiind aprovizionarea organismului cu substante nutritive!</p>',
                    'disease_id' => null,
                ],
            3  =>
                [
                    'id'         => 4,
                    'name'       => 'Hepatită B,C,D',
                    'note'       => null,
                    'disease_id' => 3,
                ],
            4  =>
                [
                    'id'         => 5,
                    'name'       => 'Gastrită',
                    'note'       => null,
                    'disease_id' => 3,
                ],
            5  =>
                [
                    'id'         => 6,
                    'name'       => 'Pancreatită',
                    'note'       => null,
                    'disease_id' => 3,
                ],
            6  =>
                [
                    'id'         => 7,
                    'name'       => 'Aparatul excretor',
                    'note'       => '<p>Va recomandam sa consultati medicul urolog&nbsp;&nbsp; pentru a monitoriza starea sistemului nefro-urinar si a urma toate masurile de profilaxie si tratament necesare. Sistemul nefrourinar detine una din principalele functii de excretie, buna functionare a acestuia asigura o detoxifiere eficienta a organismului.</p>',
                    'disease_id' => null,
                ],
            7  =>
                [
                    'id'         => 8,
                    'name'       => 'Sistemul ostio-articular',
                    'note'       => '<p>Va recomandam sa consultati medicul reumatolog pentru a monitoriza starea sistemului ostearticular si a urma toate masurile de profilaxie si tratament necesare. Patologiile sistemului articular sunt cronice indelungate si scad considerabil calitatea vietii, deaceea este prefereabil de a le preveni.</p>',
                    'disease_id' => null,
                ],
            8  =>
                [
                    'id'         => 9,
                    'name'       => 'Scolioză',
                    'note'       => null,
                    'disease_id' => 8,
                ],
            9  =>
                [
                    'id'         => 10,
                    'name'       => 'Hernie de disc',
                    'note'       => null,
                    'disease_id' => 8,
                ],
            10 =>
                [
                    'id'         => 11,
                    'name'       => 'Fracturi',
                    'note'       => null,
                    'disease_id' => 8,
                ],
            11 =>
                [
                    'id'         => 12,
                    'name'       => 'Artrită',
                    'note'       => null,
                    'disease_id' => 8,
                ],
            12 =>
                [
                    'id'         => 13,
                    'name'       => 'Maladii ginecologice',
                    'note'       => '<p>Va recomandam sa consultati medicul ginecolog pentru a monitoriza starea sistemului reproductiv si a urma toate masurile de profilaxie si tratament necesare. Sanatatea sistemului urogenital este foarte importanta pentru femei, indiferent de virsta. Acesta nu numai ca este responsabil pentru reproducere dar si pentru fonul hormonal care influenteaza in permanenta sanatatea fizica si mintala a femeii.</p>',
                    'disease_id' => null,
                ],
            13 =>
                [
                    'id'         => 14,
                    'name'       => 'Patologii endocrinologice',
                    'note'       => '<p>Va recomandam sa consultati medicul endocrinolog pentru a monitoriza starea sistemului endocrin si a urma toate masurile de profilaxie si tratament necesare. O functionare buna si armoniasa a tuturor glandelor garanteaza o stare de bine fizic si psihic indiferent de virsta.</p>',
                    'disease_id' => null,
                ],
            14 =>
                [
                    'id'         => 15,
                    'name'       => 'Diabet zaharat',
                    'note'       => null,
                    'disease_id' => 14,
                ],
            15 =>
                [
                    'id'         => 16,
                    'name'       => 'Patologii ale sistemului nervos',
                    'note'       => '<p>Vă recomandăm să consultaţi regulat medicul neurolog pentru a monitoriza starea sistemului nervos si a urma toate masurile de profilaxie si tratament necesare, precum si pentru a primi indicatii terapeutice specifice legate de practicarea efortului fizic dozat. Va rugam sa prezentati un certificat de la medic, conform caruia, antrenamentele unica va sunt permise!</p>',
                    'disease_id' => null,
                ],
            16 =>
                [
                    'id'         => 17,
                    'name'       => 'Epilepsie',
                    'note'       => null,
                    'disease_id' => 16,
                ],
            17 =>
                [
                    'id'         => 18,
                    'name'       => 'Traumatisme majore',
                    'note'       => '<p>Vă recomandăm să consultaţi regulat medicul traumatolog pentru a monitoriza starea sistemului locomotor si a urma toate masurile de profilaxie si tratament necesare, precum si pentru a primi indicatii terapeutice specifice legate de practicarea efortului fizic dozat. Va rugam sa prezentati un certificat de la medic, conform caruia, antrenamentele unica va sunt permise!</p>',
                    'disease_id' => null,
                ],
            18 =>
                [
                    'id'         => 19,
                    'name'       => 'Constipații',
                    'note'       => '<p>Actiuni care previn si combat constipatia:</p>
<ol>
<li>Beti un pahar cu apa de temperatura camerei imediat ce va treziti din somn, acesta va stimula lucrul tractului digestiv prin excitarea mecanica a peretilor gastrici ceea ce va da semnal de start si pentru peristaltismul intestinal. Deasemenea apa va dilua sucurile digestive produse pe timp de noapte si va incepe procesul de hidrata chiar de dimineata! Puteti adauga in acest pahar de apa sucul a jumatate sau o lamaie intreaga, cu conditia ca nu suferiti de gastrita cronica!</li>
<li>Optati pentru terci de ovaz la micul dejun, nu uitati ca laptele nu are nici un beneficiu pentru sanatatea dumneavoastra daca ati trecut de virsta copilariei, deaceea nu este necesare sa pregatiti terciul cu lapte, apa este cea mai buna optiune. Adaugati in el seminte de in, de floarea soarelui, se susan, nuci sau fructe uscate!Terciul de ovaz contine o cantitate mare de fibre insolubile care actioneaza ca o matura trecind prin intestin si curatindul de toate toxinele depuse pe peretii acestuia, iar excitarea mecanica duce la cresterea numarului si intensitatii miscarilor peristaltice. Semintele de in si cele de susan protejeaza intestinul prin faprul ca stimuleaza formarea mucusului intestinal acesta este un mediu favorabil pentru bacteriile benefice din tractul digestiv. Fructele uscate contin multe vitamine, fibre si vor da un gust placut terciului motivinduva sa-l consumati zilnic!</li>
<li>Includeti in alimentatie supele de legume, acestea vor fi un plus la aportul hidric zilnic si vor constitui o sursa hipocalorica de fibre! Amintitiva de aroma irezistibila a borsului (supei) de varza sau de svecla, ce poate fi mai potrivit pentru un prinz delicios si sanatos! O data puse in farfurie , puteti adauga in ele citeva seminte de in, susan sau chia, acestea deasemenea au doar numai beneficii asupra mucoasei gastrice. Supa trebuie sa fie consumata singura, fara carne, smintina sau piine alba! Puteti adauga ardei iute pentru mai multa aroma si gust, cu conditia ca nu suferiti de gastrita sau pancreatita! Fara nici o ezitare puteti opta pentru supa in fiecare zi, aceasta va aduce doar beneficii tractului digestiv si va ajuta scaderii ponderale!</li>
<li>Daca constipatia nu cedeaza usor adaugati la terciul de ovaz de la micul dejun, 200g de prune uscate acestea ar trebui sa stimuleze si mai mult peristaltismul intestinal. Pe linga faptul ca sunt foarte gustoase acestea contin o cantitate mare de glucide utile pentru bacteriile saprofite (bune) intestinale!</li>
<li>Consumati zilnic nu mai putin de 2 l de apa, aceasta va hidrata atit tractul digestiv cit si pielea si mucoasele! Puteti adauga ghimbir proaspat in apa, acesta are esfect tonizant, intensifica metabolismul si ofera energie pe tot parcursul zilei, creste peristaltismul intestinal si intensifica detoxifierea si excretia grasimilor depuse pe pereti acestuia!</li>
<li>Adaugati in alimentati produsele lactoacide ca biochefirul si bioiaurturile, puteti adauga in fulgi de tarite sau hrisca. Acestea contin o cantiate mare de bifidobacterii necesare unei functionari bune a intestinului si se explica prin faptul ca bifidobacteriile concureaza cu bacteriile parazite pentru si reduc numarul ultimelor, reducind astfel si posibilitatea ultor imbolnaviri si stimulind imunitatea organismului!</li>
<li>Consumati cit mai multe fructe si legume prospete acestea contin multe fibre care stimuleaza peristaltismul si evacuarea zilnica a intestinului. Nu neglijati efectele probiotice ale produselor ca : ceapa si usturoiul proaspat, acestea stimuleaza imunitatea si servesc ca sursa importanta pentru cresterea si multiplicarea bacteriilor saprofite in intestin!</li>
<li>Daca constipatia este rezistenta la toate metodele naturiste incercati supozitoriile cu glicerina sau catina, ca metoda unica! Dar nu intirziati a consulta un medic endocrinolog pentru ca constipatia persistenta poate fi unul din primele simptome ale hipofunctiei glandei tiroide. Consultati si un medic gastroenterolog pentru ca cauza constipatiei persistente mai poate fi si o particularitate mecanica patologica a intestinului de exeplu megacolon congenital, atonie intestinala, sau sindromul Colonului iritabil.</li>
</ol>',
                    'disease_id' => null,
                ],
        ]);
    }

}
