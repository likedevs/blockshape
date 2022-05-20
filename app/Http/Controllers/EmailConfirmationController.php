<?php

namespace App\Http\Controllers;

use App\EmailConfirmation;
use App\Events\UserRequestedEmailConfirmation;
use App\Http\Requests;
use App\Repositories\UsersRepository;
use App\Traits\Auth\Tokenizer;
use App\Transformers\UserTransformer;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Restable;
use Mail;
use App\User;
use Illuminate\Support\Facades\Auth;


class EmailConfirmationController extends Controller
{
    use Tokenizer;

    /**
     * @var UsersRepository
     */
    private $usersRepository;

    /**
     * EmailConfirmationController constructor.
     * @param UsersRepository $usersRepository
     */
    public function __construct(UsersRepository $usersRepository)
    {
        $this->usersRepository = $usersRepository;
    }

    public function token(Request $request)
    {
        $email = $request->get('email');

        try {
//            EmailConfirmation::create([
//                'email' => $email,
//                'token' => $token = str_random(5)
//            ]);

        } catch (Exception $e) {
//            EmailConfirmation::whereEmail($email)->update([
//                'token' => $token = str_random(5),
//                'confirmed_at' => null
//            ]);
        }

//        $to = '<'.$email.'>';
//        $subject = 'Unica Sport';
//        $message = $token;
//        $header = "From: <regimalimentar@unicasport.md>\r\n";
//        $header.= "MIME-Version: 1.0\r\n";
//        $header.= "Content-Type: text/html; charset=ISO-8859-1\r\n";
//        $header.= "X-Priority: 1\r\n";

//        $status = mail($to, $subject, $message, $header, '-fregimalimentar@unicasport.md');

        // event(new UserRequestedEmailConfirmation($email, $token));

        return Restable::success('ok');
    }

    public function confirm(Request $request)
    {
        $email = Auth::user()->email;
        $token = EmailConfirmation::where('email', $email)->first()->token;

        // $email = $request->get('email');
        // $email = @$_COOKIE['ok'];
        // $token = $request->get('token');
        // $user = null;
        // $getUser = User::where('email', $email)->first();
        // if (!is_null($getUser)) {
        //     $user =  $getUser;
        //     setcookie('user_id', $getUser->id, time()+3600, '/');
        // }
        // setcookie('ok', $request->get('email'), -100);



        if (! $record = $this->findRecord($email, $token)) {
            return Restable::missing('token not found');
        }

        $this->setConfirmed($record);

        $token = null;
        if ($user = $this->usersRepository->findAny($email, 'email')) {
            if ($user->isDeleted()) {
                return Restable::bad([
                    'message' => trans('user.register.locked')
                ]);
            }

            $token = $this->createToken($user, 3600 * 12);
            $user  = (new UserTransformer)->transform($user);
        }

        return Restable::success([
            'confirmed' => 1,
            'user'      => $user,
            'token'     => $token
        ]);
    }

    /**
     * @param $email
     * @param $token
     * @return mixed
     */
    protected function findRecord($email, $token)
    {
        return EmailConfirmation::where([
            'email' => $email,
            'token' => $token
        ])->first();
    }

    /**
     * @param $record
     */
    protected function setConfirmed($record)
    {
        $record->fill([
            'token' => null,
            'confirmed_at' => Carbon::now()
        ])->save();
    }
}
