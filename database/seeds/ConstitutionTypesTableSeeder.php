<?php

use Illuminate\Database\Seeder;

class ConstitutionTypesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('constitution_types')->delete();

        \DB::table('constitution_types')->insert([
            0 =>
                [
                    'id'       => 1,
                    'name'     => 'Ectomorf',
                    'note'     => '{"weight-loss":"<p>Dvs faceti parte din categoria tipului constitutional <strong>Ectomorf<\\/strong>, ceea ce ar insemna ca aveti un metabolism rapid si veti putea atinge scopul de a pierde kg &icirc;n plus foarte curand.<\\/p>","maintenance":"<p>Dvs faceti parte din categoria tipului constitutional <strong>Ectomorf<\\/strong>, ceea ce ar insemna ca aveti un metabolism activ si va este simplu sa va mentineti intr-o forma fizica buna.<\\/p>","weight-gain":"<p>Dvs faceti parte din categoria tipului constitutional <strong>Ectomorf<\\/strong>, ceea ce inseamna ca aveti o masa musculara redusa, grasime putina si un metabolism activ.<\\/p>"}',
                    'bone_min' => 11,
                    'bone_max' => 13,
                ],
            1 =>
                [
                    'id'       => 2,
                    'name'     => 'Ezomorf',
                    'note'     => '{"weight-loss":"<p>Dvs faceti parte din categoria tipului constitutional <strong>Ezomorf<\\/strong>, ceea ce inseamna ca aveti un metabolism eficient.Va puteti atinge scopul de a pierde kg &icirc;n plus in timp scurt.<\\/p>","maintenance":"<p>Dvs faceti parte din categoria tipului constitutional <strong>Ezomorf<\\/strong>, ceea ca inseamna ca aveti un metabolism activ si va este usor sa va controlati greutatea corporala si procentul de grasime.<\\/p>","weight-gain":"<p>Dvs faceti parte din categoria tipului constitutional <strong>Ezomorf<\\/strong>, ceea ce inseamna ca aveti un metabolism eficient si dezvoltati usor masa musculara.<\\/p>"}',
                    'bone_min' => 14,
                    'bone_max' => 16,
                ],
            2 =>
                [
                    'id'       => 3,
                    'name'     => 'Endomorf',
                    'note'     => '{"weight-loss":"<p>Dvs faceti parte din categoria tipului constitutional <strong>Endomorf<\\/strong>, ceea ce inseamna ca aveti un metabolism care favorizeaza adaugarea kg usor, dar Dvs aveti suficienta masa musculara care va va ajuta sa va antrenati eficient si prin urmare sa slabiti si sa va tonifiati corpul ajungind la rezultatul mult dorit.<\\/p>","maintenance":"<p>Dvs faceti parte din categoria tipului constitutional <strong>Endomorf<\\/strong>, ceia ce inseamna ca sunteti genul care adauga kg in plus usor, dar aveti suficienta masa musculara care va va ajuta sa va antrenati eficient si prin urmare sa va tonifiati corpul mentinand rezultatul.<\\/p>","weight-gain":""}',
                    'bone_min' => 17,
                    'bone_max' => 19,
                ],
        ]);
    }

}
