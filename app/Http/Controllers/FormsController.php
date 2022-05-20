<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Page;
use App\MPages;
use App\MSubscription;
use App\MSeminars;
use App\MEvents;
use App\MVideoStories;
use App\MPhotoStories;
use App\MVideo;
use App\MProjects;
use App\UserHistory;
use App\User;
use App\MRation;
use App\MRationRebuild;
use Input;
use Auth;
use Session;
use App\Services\Contracts\HtmlBuilder;


class FormsController extends Controller
{
    public function changeTraning(HtmlBuilder $HtmlBuilder)
    {
        if (!empty(Input::get('time'))) {
            $userHistory = UserHistory::where('user_id', Auth::user()->id)->first();

            if (is_null($userHistory)) { dd('fuck of man'); }

            $user = User::where('id', $userHistory->user_id)->first();
            $HtmlBuilder->build($user, $userHistory, Input::get('time'));
        }
        return '{"msg":"true"}';
    }

    public function rebuildRation(HtmlBuilder $HtmlBuilder)
    {
        $rationRebuild = MRationRebuild::where('user_id', Auth::user()->id)->where('date', date('Y-m-d'))->get();
        $ration = MRation::where('user_id', Auth::user()->id)->where('date', date('Y-m-d'))->first();

        if (count($rationRebuild) >= 5) {
            $this->getRebuldRation($ration);
            return redirect()->back();
        }

        if (!is_null($ration)) {
            MRationRebuild::create([
                'user_id' => Auth::user()->id,
                'date' => $ration->date,
                'food_1' => $ration->food_1,
                'food_2' => $ration->food_2,
                'food_3' => $ration->food_3,
                'food_4' => $ration->food_4,
                'food_5' => $ration->food_5,
                'actual' => 1,
            ]);
        }

        $userRation = MRation::where('user_id', Auth::user()->id)->where('date', date('Y-m-d'))->first();
        if ($userRation->type == 'discharging') {
            return redirect()->back();
        }

        $training = $userRation->training;
        $date = $userRation->date;

        $userHistory = UserHistory::where('user_id', Auth::user()->id)->first();

        if (is_null($userHistory)) { return redirect()->back(); }

        $user = User::where('id', $userHistory->user_id)->first();
        $HtmlBuilder->build($user, $userHistory, null, null, 1);

        return redirect()->back();
    }

    public function getRebuldRation($ration)
    {
        $rationRebuild =  MRationRebuild::where('user_id', Auth::user()->id)
                                        ->where('date', date('Y-m-d'))
                                        ->where('food_1', "!=", $ration->food_1)
                                        ->orderByRaw("RAND()")
                                        ->first();

        MRation::where('user_id', Auth::user()->id)
                ->where('date', date('Y-m-d'))
                ->update([
                    'food_1' => $rationRebuild->food_1,
                    'food_2' => $rationRebuild->food_2,
                    'food_3' => $rationRebuild->food_3,
                    'food_4' => $rationRebuild->food_4,
                    'food_5' => $rationRebuild->food_5,
                ]);
    }

    public function changeHistory($date)
    {
        if (strtotime($date)) {
            Session::set('history_date', $date);
            echo Session::get('history_date');
        }
        return redirect()->back();
    }

    public function changeHistoryPost()
    {
        $date = Input::get('date');
        if (Session::get('history_date') == $date) {
            return '{"msg":"false"}';
        }

        Session::set('history_date', $date);
        return '{"msg":"true"}';
    }

}
