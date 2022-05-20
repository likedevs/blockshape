<?php

use App\Site;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddContactsToSitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::transaction(function () {
            Schema::table('sites', function (Blueprint $table) {
                $table->string('email')->nullable();
                $table->string('phone')->nullable();
            });

            Site::where('id', 1)->update([
                'email' => 'natalia.velicoglo@unicasport.md',
                'phone' => '+373 (69) 000 682'
            ]);

            Site::where('id', 2)->update([
                'email' => 'alimentatie@unicasport.ro',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sites', function (Blueprint $table) {
            $table->dropColumn('email');
            $table->dropColumn('phone');
        });
    }
}
