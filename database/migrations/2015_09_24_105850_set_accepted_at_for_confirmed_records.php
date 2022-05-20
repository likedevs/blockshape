<?php

use App\UserHistory;
use Illuminate\Database\Migrations\Migration;

class SetAcceptedAtForConfirmedRecords extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        UserHistory::where("status", '=', UserHistory::STATUS_CONFIRMED)
            ->update([
                'accepted_at' => DB::raw("DATE_ADD(created_at, INTERVAL 1 DAY)")
            ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
