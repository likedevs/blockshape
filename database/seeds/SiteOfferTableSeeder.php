<?php

use Illuminate\Database\Seeder;

class SiteOfferTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // set default site
        \App\Offer::whereNull('site_id')->update([
            'site_id' => 1,
        ]);

        // clone online offers
        \App\Offer::whereGroup('online')->get()->each(function ($offer) {
            $offer->site_id = 2;

            \App\Offer::create($offer->toArray());
        });
    }
}
