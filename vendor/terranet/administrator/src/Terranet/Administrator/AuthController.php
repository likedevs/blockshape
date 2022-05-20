<?php namespace Terranet\Administrator;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;
use Redirect;
use Hash;

class AuthController extends Controller {

    use DispatchesCommands, ValidatesRequests;

    /**
     * @var Guard
     */
    protected $user;
    /**
     * @var Event
     */
    private $event;
    /**
     * @var Application
     */
    private $application;

    public function __construct(Application $application, Guard $user, Dispatcher $event)
    {
        $this->application = $application;

        $this->config = $this->application['scaffold.config'];

        $this->user = $user;

        $this->event = $event;
    }

    public function postLogin(LoginRequest $request)
    {
        // basic login policy
        $identity   = $this->config->get('auth_identity', 'username');
        $credential = $this->config->get('auth_credential', 'password');
        $conditions = $this->config->get('auth_conditions', []);

        $credentials = $request->only([$identity, $credential]);

        // extend auth policy by allowing custom login conditions
        if ($conditions)
        {
            $credentials = array_merge($credentials, $conditions);
        }

//        echo "<pre>";
//        print_r($credentials);
//        exit();

        $remember = (int) $request->get('remember_me', 0);

        if ($this->user->attempt($credentials, $remember, true))
        {
//            $this->event->fire('admin.login', [$this->user]);

            return Redirect::to($this->config->get('home_page'))->with('messages', ['Welcome.']);
        }

        return Redirect::back()->withErrors(['Login attempt failed']);
    }

    public function getLogin()
    {
        $identity   = $this->config->get('auth_identity', 'username');
        $credential = $this->config->get('auth_credential', 'password');

        return view('administrator::login')
            ->with('identity', $identity)
            ->with('credential', $credential);
    }

    public function logout()
    {
        $this->event->fire('admin.logout', [$this->user]);

        $this->user->logout();

        return Redirect::to('admin/login');
    }
}
