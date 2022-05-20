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
use App\User;
use App\Order;
use App\MOrder;
use App\MUserSubscrs;
use App\Cart;
use App\Services\Contracts\HtmlBuilder;
use Illuminate\Support\Facades\Auth;
use View;
use Session;

class MainController extends Controller
{
    public function __construct($value='')
    {
        View::share('termFrom', date('Y-m-d'));
        View::share('termTo', date('Y-m-d'));
        $this->checkCart();
    }

    public function checkCart()
    {
        if (Auth::user()) {
            $history = UserHistory::where('user_id', Auth::user()->id)->first();
            if (!is_null($history)) {
                $order = Order::where('status', 'paid')
                            ->where('user_history_id', $history->id)
                            ->where('valid', 1)
                            ->orderBy('id', 'desc')
                            ->first();

                if (!is_null($order)) {
                    MOrder::where('user_id', Auth::user()->id)
                        ->where('status', 'pending')
                        ->where('id', $order->comand_id)
                        ->update([
                            'status' => 'paid',
                        ]);
                }
            }
        }
    }

    public function testPayment()
    {
        $historyUserId = UserHistory::where('user_id', Auth::user()->id)->first();
        $orderCart = MOrder::where('user_id', Auth::user()->id)->where('status', 'pending')->first();

        if (is_null($historyUserId) || is_null($orderCart)) { return dd('404'); }
        $cartProds  = Cart::where('user_id', Auth::user()->id)
                        ->where('order_id', $orderCart->id)
                        ->where('type', 'subscrs')
                        ->get();
        $infoCartProds  = Cart::where('user_id', Auth::user()->id)
                        ->where('order_id', $orderCart->id)
                        ->where('type','!=', 'subscrs')
                        ->get();

        if (!empty($cartProds)) {
            foreach ($cartProds as $key => $prod) {
                $this->setSubscrsTerms($prod->subscriptions);
            }
        }

        if (!empty($infoCartProds)) {
            $this->sendEmail($infoCartProds);
        }

        $orderPay = Order::where('user_history_id', $historyUserId->id)
                        ->where('comand_id', $orderCart->id)
                        ->where('valid', 1)
                        ->update([
                            'status' => 'paid',
                        ]);

        Session::flash('message', 'thank you for shopping!');
        return redirect('account/');
        // echo "thank you your payment was successful...";
        // echo "<a href='/account'>Go home</a>";
    }

    public function sendEmail($carts)
    {
//        foreach ($carts as $key => $cart) {
//            if ($cart->type == 'seminars') {
//                $email = $cart->seminars->email;
//                $message = Auth::user()->name." a cumparat seminarul ".$cart->seminars->title;
//            }else{
//                $email = $cart->events->email;
//                $message = Auth::user()->name." a cumparat evenimentul ".$cart->events->title;
//            }
//
//            $to = '<'.$email.'>';
//            $subject = 'Unica Sport';
//            $message = $message;
////            $header = "From: <regimalimentar@unicasport.md>\r\n";
////            $header.= "MIME-Version: 1.0\r\n";
////            $header.= "Content-Type: text/html; charset=ISO-8859-1\r\n";
////            $header.= "X-Priority: 1\r\n";
////            $status = mail($to, $subject, $message, $header, '-fregimalimentar@unicasport.md');
//        }
    }

    public function setSubscrsTerms($subscr)
    {
        $checkUser = User::where('id', Auth::user()->id)->where('online', 1)->first();
        $userId = Auth::user()->id;
        $term  = $subscr->term;
        $userHasSubsc = MUserSubscrs::where('user_id', $userId)->first();
        if (is_null($userHasSubsc)) {
            MUserSubscrs::create([
                            'user_id' => $userId,
                            'begin' => date('Y-m-d'),
                            'end' => date('Y/m/d', strtotime("+".$term." months", strtotime(date('Y-m-d'))))
                        ]);
        }else{
            if (strtotime(date('Y/m/d')) < strtotime($userHasSubsc->end)) {
                MUserSubscrs::where('user_id', $userId)
                            ->update([
                                'end' => date('Y/m/d', strtotime("+".$term." months", strtotime($userHasSubsc->end)))
                            ]);
            }else{
                MUserSubscrs::where('user_id', $userId)
                            ->update([
                                'end' => date('Y/m/d', strtotime("+".$term." months", strtotime(date('Y-m-d'))))
                            ]);
            }
        }

        $userHasSubsc = MUserSubscrs::where('user_id', $userId)->first();

        if (is_null($checkUser)) {
            MUserSubscrs::where('user_id', $userId)
                        ->update([
                            'end' => date('Y/m/d', strtotime("+".$term." weeks", strtotime($userHasSubsc->end)))
                        ]);

            $checkUser = User::where('id', Auth::user()->id)->where('online', 1)->update([
                'online' => 1,
            ]);
        }
    }

    public function index()
    {
        $data = [];
        return view('main.index', $data);
    }

    public function postLogin(Request $request)
    {
        setcookie('ok', $request->get('email'), time()+3600);
        $email = $request->get('email');

        try {
            EmailConfirmation::create([
                'email' => $email,
                'token' => $token = str_random(5)
            ]);

        } catch (Exception $e) {
            EmailConfirmation::whereEmail($email)->update([
                'token' => $token = str_random(5),
                'confirmed_at' => null
            ]);
        }
//
//        $to = '<'.$email.'>';
//        $subject = 'Unica Sport';
//        $message = $token;
//        $header = "From: <regimalimentar@unicasport.md>\r\n";
//        $header.= "MIME-Version: 1.0\r\n";
//        $header.= "Content-Type: text/html; charset=ISO-8859-1\r\n";
//        $header.= "X-Priority: 1\r\n";
//
//        $status = mail($to, $subject, $message, $header, '-fregimalimentar@unicasport.md');

        // return redirect()->route('customer.signup');
        return redirect()->route('order-offer', ['offer' => 5]);
    }

    public function showPdf()
    {
        $history = UserHistory::where('user_id', Auth::user()->id)->first();

        if (!is_null($history)) {
            echo $history->document;
        }
    }

    public function getrecord()
    {
        if (is_null(@$_COOKIE['user_id'])) {
            return redirect()->route('home');
        }

        $userId = @$_COOKIE['user_id'];

        $history = UserHistory::where('user_id', $userId)->first();

        dd(@$_COOKIE['user_id']);
    }

    public function foo(HtmlBuilder $HtmlBuilder)
    {
        $user = User::where('id', 4863)->first();
        $userHistory = UserHistory::where('id', 4555)->first();

        echo $HtmlBuilder->build($user, $userHistory);
    }

    public function getPdf(HtmlBuilder $HtmlBuilder, $historyId)
    {
        $historyId = (int)$historyId;

        $userHistory = UserHistory::where('user_id', Auth::user()->id)->first();

        if (is_null($userHistory)) {
            dd('error');
        }

        $user = User::where('id', $userHistory->user_id)->first();

        User::where('email', Auth::user()->email)->update([
            'paid' => 1
        ]);

        $document =  $HtmlBuilder->build($user, $userHistory);
        if (empty($userHistory->document)) {
             UserHistory::where('user_id', Auth::user()->id)
                        ->update([
                            'document' => $document,
                        ]);
        }

        return redirect()->route('account');
    }

    public function pdf(HtmlBuilder $HtmlBuilder, $historyId)
    {
        $history = UserHistory::where('user_id', Auth::user()->id)->first();

        if (!is_null($history)) {
            echo $history->document;
        }
        // $historyId = (int)$historyId;
        //
        // $userHistory = UserHistory::where('id', $historyId)->first();
        //
        // if (is_null($userHistory)) {
        //     dd('error');
        // }
        //
        // $user = User::where('id', $userHistory->user_id)->first();
        //
        // User::where('email', Auth::user()->email)->update([
        //     'paid' => 1
        // ]);
        //
        // $HtmlBuilder->build($user, $userHistory);
        // // return redirect()->route('account');
    }

    public function userRedirect()
    {
        // if (Auth::user()->paid == 0) {
        //     // dd('vf');
        //     return redirect()->route('order-offer', ['offer' => 5]);
        // }
        return redirect()->route('account');

        // dd(Auth::user()->paid);
    }
}
