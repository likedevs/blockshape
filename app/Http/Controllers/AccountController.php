<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Page;
use Input;
use Cookie;
use Illuminate\Http\Request;
use App\EmailConfirmation;
use Exception;
use App\UserHistory;
use App\MCabinetPages;
use App\User;
use App\MRation;
use App\MRationTerm;
use App\MMessages;
use App\MUserDiary;
use App\MUserFood;
use App\MUserTraining;
use App\MotivationList;
use App\MSeminars;
use App\MEvents;
use App\Services\Contracts\HtmlBuilder;
use App\Cart;
use App\MOrder;
use App\MUserSubscrs;
use View;
use File;
use Auth;
use Validator;
use Intervention\Image\Facades\Image;
use Session;


class AccountController extends MainController
{
    public function __construct(McabinetPages $cabinetPages, Request $request)
    {
        parent::__construct();
        if (is_null(Session::get('history_date'))) {
            Session::set('history_date', date("Y-m-d"));
        }

        View::share('termFrom', date('Y-m-d'));
        View::share('termTo', date('Y-m-d'));

        $rationTerm = MRationTerm::where('user_id', Auth::user()->id)->first();
        if (!is_null($rationTerm)) {
            View::share('termFrom', $rationTerm->term_from);
            View::share('termTo', $rationTerm->term_to);
        }

        $messagesCount = MMessages::where('user_id', Auth::user()->id)->where('active', 1)->count();
        $tabsMenu = $cabinetPages->get();

        $lastSeminar = MSeminars::orderBy('created_at', 'desc')->first();
        $lastEvent = MEvents::orderBy('created_at', 'desc')->first();

        View::share('lastSeminar', $lastSeminar);
        View::share('lastEvent', $lastEvent);
        View::share('tabsMenu', $tabsMenu);
        View::share('activeMenu', $this->getActiveTab($request));
        View::share('history', $this->getHistory());
        View::share('messagesCount', $messagesCount);
        // echo Session::get('history_date');
    }

    //  index account page
    public function index()
    {
        $date  = Session::get('history_date');
        $schedule =  MRation::where('date', $date)
                            ->where('user_id', Auth::user()->id)
                            ->first();

        $diary = MUserDiary::where('date', $date)
                        // ->where('user_id', Auth::user()->id)
                        ->first();

        $data['schedule'] = $schedule;
        $data['diary'] = $diary;

        return view('front.pages.account.account', $data);
    }

    // calendar account page
    public function getCalendarPage(Request $request)
    {
        $data['beginWeight'] = 0;
        $data['lastWeight'] = 0;

        $userHistory = UserHistory::where('user_id', Auth::user()->id)
                                ->orderBy('id', 'desc')
                                ->first();

        $yesterday = MUserDiary::where('user_id', Auth::user()->id)
                            ->where('date', '<', date('Y-m-d'))
                            ->where('weight_body', '!=', ' ')
                            ->first();

        if (!is_null($userHistory)) {
            $data['beginWeight'] = $userHistory->current_weight;
            $data['lastWeight'] = $userHistory->current_weight;
        }
        if (!is_null($yesterday)) {
            $data['lastWeight'] = $yesterday->weight_body;
        }

        $date = strtotime(date("Y-m-d"));
        $month = date("m");
        $year = date("Y");

        if ($request->get('month') && $request->get('year')) {
            if (checkdate($request->get('month'), 1  , $request->get('year'))) {
                $date = strtotime(date('1-'.$request->get('month').'-'.$request->get('year')));
                $month = $request->get('month');
                $year = $request->get('year');
            }
            if ($request->get('month') == date('m') && $request->get('year') == date('Y')) {
                $date = strtotime(date("Y-m-d"));
                $month = date("m");
                $year = date("Y");
            }
        }

        $data['date'] = $date;
        $data['month'] = $month;
        $data['year'] = $year;
        $data['diary'] = MUserDiary::where('user_id', Auth::user()->id)->where('date', Session::get('history_date'))->first();

        return view('front.pages.account.calendar', $data);
    }

    // graph account page
    public function getGraphPage()
    {
        $date = Session::get('history_date');
        $user = Auth::user();

        $diary = MUserDiary::where('date', $date)->where('user_id', $user->id)->first();
        $diaryDatas = MUserDiary::where('date', '<=', $date)->where('user_id', $user->id)->get();

        $data['days'] = json_encode($this->getDays($diaryDatas), JSON_FORCE_OBJECT);

        $data['values'] = $this->getValue($diaryDatas);
        $data['diary'] = $diary;
        return view('front.pages.account.graph', $data);
    }

    // consultation page
    public function getConsultationPage()
    {
        return  redirect('/page/consultation');
        // $data = [];
        // return view('front.pages.account.consultation', $data);
    }

    //  messages account page
    public function getMessagesPage()
    {
        $data['messages'] = MMessages::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();

        MMessages::where("user_id", Auth::user()->id)
                    ->where('active', 1)
                    ->update([
                        'active' => 0,
                    ]);

        return view('front.pages.account.messages', $data);
    }

    //  motivation lists account pages
    public function motivationListPage()
    {
        $data['items'] = MotivationList::where('user_id', Auth::user()->id)->get();
        $data['diary'] = MUserDiary::where('user_id', Auth::user()->id)->where('date', Session::get('history_date'))->first();

        return view('front.pages.account.motivational', $data);
    }

    //  current shoping account pages
    public function getCurrentShopingPage()
    {
        $paidOrders = MOrder::where('user_id', Auth::user()->id)->where('status', 'paid')->get();
        $orderArray = [];
        if (!empty($paidOrders)) {
            foreach ($paidOrders as $key => $order) {
                $orderArray[] = $order->id;
            }
        }

        $data['cart'] = Cart::where('user_id', Auth::user()->id)->whereIn('order_id', $orderArray)->get();
        return view('front.pages.account.current-shoping', $data);
    }

    public function motivationAdd()
    {
        $items = Input::get('item');
        if (!empty($items)) {
            foreach ($items as $key => $item) {
                if (!empty($item)) {
                    MotivationList::create([
                        'user_id' => Auth::user()->id,
                        'text' => $item,
                    ]);
                }
            }
        }

        if (!empty(Input::get('comment'))) {
            MUserDiary::where('date', Session::get('history_date'))->update([
                'comment' => Input::get('comment'),
            ]);
        }

        return redirect()->back();
    }

    public function addFreeWeek()
    {
        $checkUser = User::where('id', Auth::user()->id)->where('online', 1)->first();
        if (!is_null($checkUser)) {
            Session::flash('message', 'The one week free offer has already been activated');
            return redirect('page/subscriptions');
        }
        $userId = Auth::user()->id;
        $term  = 1;
        $userHasSubsc = MUserSubscrs::where('user_id', $userId)->first();
        $checkUser = User::where('id', Auth::user()->id)->where('online', 1)->first();

        if (is_null($checkUser)) {
            if (is_null($userHasSubsc)) {
                MUserSubscrs::create([
                                'user_id' => $userId,
                                'begin' => date('Y-m-d'),
                                'end' => date('Y/m/d', strtotime("+".$term." weeks", strtotime(date('Y-m-d'))))
                            ]);
            }else{
                if (strtotime(date('Y/m/d')) < strtotime($userHasSubsc->end)) {
                    MUserSubscrs::where('user_id', $userId)
                                ->update([
                                    'end' => date('Y/m/d', strtotime("+".$term." weeks", strtotime($userHasSubsc->end)))
                                ]);
                }else{
                    MUserSubscrs::where('user_id', $userId)
                                ->update([
                                    'end' => date('Y/m/d', strtotime("+".$term." weeks", strtotime(date('Y-m-d'))))
                                ]);
                }
            }

            User::where('id', Auth::user()->id)->update([
                'online' => 1,
            ]);
        }else{
            dd('modal: free week was selected');
        }

        return redirect()->back();
    }

    public function getDays($diaryDatas)
    {
        $array = [];
        if (!empty($diaryDatas)) {
            foreach ($diaryDatas as $key => $value) {
                $array[$key] = $value->date;
            }
        }
        return $array;
    }

    public function getValue($diaryDatas)
    {
        $array = [];
        $userHistory = UserHistory::where('user_id', Auth::user()->id)->orderBy('id', 'asc')->first();
        $diaryFirstDay = MUserDiary::where('user_id', Auth::user()->id)->first();

        $array['weight']['val'][0] = $userHistory->current_weight;
        $array['weight']['date'][0] = $diaryFirstDay->date;

        $array['buttocks']['val'][0] = $userHistory->buttocks;
        $array['buttocks']['date'][0] = $diaryFirstDay->date;

        $array['waist']['val'][0] = $userHistory->talia1;
        $array['waist']['date'][0] = $diaryFirstDay->date;

        $array['arm']['val'][0] = $userHistory->bone_radius;
        $array['arm']['date'][0] = $diaryFirstDay->date;

        $array['thigh']['val'][0] = $userHistory->thigh1;
        $array['thigh']['date'][0] = $diaryFirstDay->date;

        $array['abdomen']['val'][0] = $userHistory->talia3;
        $array['abdomen']['date'][0] = $diaryFirstDay->date;

         if (!empty($diaryDatas)) {
            foreach ($diaryDatas as $key => $value) {
                if (!empty($value->weight_body )) {
                    $array['weight']['val'][$key] = $value->weight_body;
                    $array['weight']['date'][$key] = $value->date;
                }
                if (($value->buttocks != null) || ($value->buttocks != '')) {
                    $array['buttocks']['val'][$key] = $value->buttocks;
                    $array['buttocks']['date'][$key] = $value->date;
                }
                if (($value->waist != null) || ($value->waist != '')) {
                    $array['waist']['val'][$key] = $value->waist;
                    $array['waist']['date'][$key] = $value->date;
                }
                if (($value->arm != null) || ($value->arm != '')) {
                    $array['arm']['val'][$key] = $value->arm;
                    $array['arm']['date'][$key] = $value->date;
                }
                if (($value->thigh != null) || ($value->thigh != '')) {
                    $array['thigh']['val'][$key] = $value->thigh;
                    $array['thigh']['date'][$key] = $value->date;
                }
                if (($value->abdomen != null) || ($value->abdomen != '')) {
                    $array['abdomen']['val'][$key] = $value->abdomen;
                    $array['abdomen']['date'][$key] = $value->date;
                }
            }
        }
        return $array;
    }

    public function postGraph()
    {
        $date = Session::get('history_date');
        $user = Auth::user();
        $diary = MUserDiary::where('date', $date)->where('user_id', $user->id)->first();
        if (is_null($diary)) {
            return redirect()->back();
        }
        MUserDiary::where('id', $diary->id)
                    ->update([
                        'weight_body' => Input::get('weight'),
                        'buttocks' => Input::get('buttocks'),
                        'waist' => Input::get('waist'),
                        'arm' => Input::get('arm'),
                        'thigh' => Input::get('thigh'),
                        'abdomen' => Input::get('abdomen'),
                    ]);

        return redirect()->back();
    }

    public function getHistory()
    {
        $history = null;
        $userHistory = UserHistory::where('user_id', Auth::user()->id)
                                    ->orderBy('id', 'asc')
                                    ->first();

        if (!is_null($userHistory)) { $history = $userHistory; }

        return $history;
    }

    public function pages($slug)
    {
        if (!is_null($slug)) {
            $page = McabinetPages::where('slug', $slug)->first();
            if (!is_null($page)) {
                if (view()->exists('front.pages.account.'.$page->slug)) {
                    return view('front.pages.account.'.$page->slug);
                }
            }
        }
        return dd('404');
    }


    public function editAccount(Request $request, User $user)
    {
        if ($request->file) {
            // dd($request->file);
            // $user->imageUrl('180x180');
            // $this->updateImage($request);
        }

        $data =  [
            'name' => 'required|',
            'sname' => 'required|',
            'phone' => 'numeric',
        ];

        $toUpdate = [
            'name' => Input::get('name')." ".Input::get('sname'),
            'first_name' => Input::get('name'),
            'second_name' => Input::get('sname'),
            'email' => Input::get('email'),
            'phone' => Input::get('phone'),
        ];

        if (Input::get('email') != Auth::user()->email) {
            $data['email'] = 'required|email|unique:users';
        }

        if (!empty(Input::get('password')) || !empty(Input::get('passwordAgain'))) {
            $data['password'] = 'required|min:4';
            $data['passwordAgain'] = 'required|same:password';
            $toUpdate['password'] = bcrypt(Input::get('password'));
        }

        $item = Validator::make(Input::all(), $data);

        if ($item->fails()){
            return redirect()->back()->with('errors', $item->messages())->withInput();
        }

        User::where('id', Auth::user()->id)->update($toUpdate);

        return redirect()->back();

    }

    public function setDiary()
    {
        $date = Session::get('history_date');
        $diary = MUserDiary::where('date', $date)->first();

        if (is_null($diary)) { return redirect()->back(); }

        if (Input::get('menstruation_start') == 0) {
                $data = [
                        'wake' => Input::get('wake'),
                        'water_qty' => Input::get('water'),
                        'weight_body' => Input::get('weight'),
                        'dejection_qty' => Input::get('dejection_qty'),
                        'dejection_solidity' => Input::get('dejection_solidity'),
                        'puls' => Input::get('puls'),
                        'diff_last' => Input::get('diff_last'),
                        'diff_begin' => Input::get('diff_begin'),
                        'comment' => Input::get('comment')
                    ];
        }else{
            $data = [
                    'menstruation_start' => Input::get('menstruation_start'),
                    'wake' => Input::get('wake'),
                    'water_qty' => Input::get('water'),
                    'weight_body' => Input::get('weight'),
                    'dejection_qty' => Input::get('dejection_qty'),
                    'dejection_solidity' => Input::get('dejection_solidity'),
                    'puls' => Input::get('puls'),
                    'diff_last' => Input::get('diff_last'),
                    'diff_begin' => Input::get('diff_begin'),
                    'comment' => Input::get('comment'),
                    'empty' => 0,
                ];
            if ($diary->menstruation_start !== Input::get('menstruation_start')) {
                $diaryDays = MUserDiary::where('date', '>=', date('Y-m'))->get();

                if (!empty($diaryDays)) {
                    foreach ($diaryDays as $key => $diaryDay) {
                        $this->rebuildDiary($diaryDay->date, Input::get('menstruation_start'));
                    }
                }
            }
        }

        MUserDiary::where('date', $date)->update($data);
        $diary = MUserDiary::where('date', $date)->first();

        $foodHour = array_slice(Input::get('food_hour'), 0, count(Input::get('food_hour'))-1);
        $food = array_slice(Input::get('food'), 0, count(Input::get('food'))-1);
        $foodQty = array_slice(Input::get('food_qty'), 0, count(Input::get('food_qty'))-1);
        $training_hour = array_slice(Input::get('training_hour'), 0, count(Input::get('training_hour'))-1);
        $training_duration = array_slice(Input::get('training_duration'), 0, count(Input::get('training_duration'))-1);
        $itemId = Input::get('item');
        $trenId = Input::get('tren');


        if (!empty(array_filter($food))) {
            foreach (array_filter($food) as $key => $value) {

                $userFood = MUserFood::where('id', $itemId[$key])->first();
                if (is_null($userFood)) {
                    MUserFood::create([
                        'user_diary_id' => $diary->id,
                        'food' => $food[$key],
                        'time' => $foodHour[$key],
                        'qty' => $foodQty[$key],
                    ]);
                }else{
                    MUserFood::where('id', $itemId[$key])
                            ->update([
                                'food' => $food[$key],
                                'time' => $foodHour[$key],
                                'qty' => $foodQty[$key],
                            ]);
                }
            }
        }

        if (!empty(array_filter($training_duration))) {
            foreach (array_filter($training_duration) as $key => $value) {
                $userTraining = MUserTraining::where('id', $trenId[$key])->first();
                if (is_null($userTraining)) {
                    MUserTraining::create([
                        'user_diary_id' => $diary->id,
                        'time' => $training_hour[$key],
                        'duration' => $training_duration[$key],
                    ]);
                }else{
                    MUserTraining::where('id', $trenId[$key])
                                ->update([
                                    'time' => $training_hour[$key],
                                    'duration' => $training_duration[$key],
                                ]);
                }
            }
        }

        return redirect()->back();
    }

    private function rebuildDiary($date, $day)
    {
        $nowMouth = date('m', strtotime($date));
        $nowYear = date('Y', strtotime($date));

        $userHistory = UserHistory::where('user_id', Auth::user()->id)->first();

        if (is_null($userHistory)) { return false; }

        $menstrualCicle = $userHistory->menstrual_cycle;

        $menstrualDuration = 28;
        if ($menstrualCicle['duration'] > 0) {
            $menstrualDuration = $menstrualCicle['duration'];
        }

        if (array_key_exists('start_date', $menstrualCicle)) {
            $startDate = $day;
            $duration = round($menstrualDuration / 2);
            $midlleDate =  strtotime("+".$duration." days", strtotime($nowYear.'-'.$nowMouth.'-'.$startDate));
            $finishDate =  strtotime("+".$menstrualDuration." days", strtotime($nowYear.'-'.$nowMouth.'-'.$startDate));
            $start_date = strtotime(date('Y').'-'.date('m').'-'.$startDate);
        }else{
            $startDate = 0;
            $duration = 0;
            $midlleDate =  0;
            $finishDate =  0;
        }

        if (( strtotime($date) >=  strtotime($nowYear.'-'.$nowMouth.'-'.$startDate)) && (  strtotime($date) <   $midlleDate)) {
            MUserDiary::where('date', $date)->update([
                'user_id' => Auth::user()->id,
                'date' => $date,
                'menstruation_start' => $startDate,
                'period' => 'catabolic',
                'empty' => 1,
            ]);
        }elseif((date('d', strtotime($date)) >= date('d', $midlleDate)) && ( strtotime($date) < $finishDate)){
            MUserDiary::where('date', $date)->update([
                'user_id' => Auth::user()->id,
                'date' => $date,
                'menstruation_start' => $startDate,
                'period' => 'anabolic',
                'empty' => 1,
            ]);
        }else{
            MUserDiary::where('date', $date)->update([
                'user_id' => Auth::user()->id,
                'date' => $date,
                'menstruation_start' => $startDate,
                'period' => 'none',
                'empty' => 1,
            ]);
        }
    }

    private function getActiveTab($request)
    {
        $slug = $request->segment(2);
        $activeClass = "green";

        if (!is_null($slug)) {
            $page = McabinetPages::where('slug', $slug)->first();
            if (!is_null($page)) {
                $activeClass = $page->class;
            }
        }
        return $activeClass;
    }
}
