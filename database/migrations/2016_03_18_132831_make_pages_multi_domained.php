<?php

use App\Page;
use App\Site;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class MakePagesMultiDomained extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->unsignedInteger('site_id')
                ->after('id')
                ->nullable();
        });

        $pages = Page::all();

        $pages->each(function($page) {
            $page->update([
                'site_id' => 1,
            ]);
        });

        // mirroring "ro" pages
        foreach($pages as $page) {
            Page::create(array_merge(
                $page->toArray(),
                ['site_id' => 2]
            ));
        }

        Schema::table('pages', function (Blueprint $table) {
            $table->unsignedInteger('site_id')->change();

            $table
                ->foreign('site_id', 'pages_site_id_foreign')
                ->references('id')
                ->on('sites')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Page::where('site_id', '>', 1)->delete();

        Schema::table('pages', function (Blueprint $table) {
            $table->dropForeign('pages_site_id_foreign');

            $table->dropColumn('site_id');
        });
    }
}
