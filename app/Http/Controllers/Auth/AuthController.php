<?php

namespace App\Http\Controllers\Auth;

use App\Code;
use App\Auser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\CodeController;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return mixed
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            //'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);


    }

    /**
     *
     */

    public function index() {
        return view('welcome');
    }

    public function getLogin() {
        return view('auth/login');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return Auser::create([
            //'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function postRegister(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException($request, $validator);
        }
        $user = $this->create($request->all());
        //создаем код и записываем код
        $code = CodeController::generateCode(8);
        Code::create([
            'user_id' => $user->id,
            'code' => $code,
        ]);
        //Генерируем ссылку и отправляем письмо на указанный адрес
        $url = url('/').'/auth/activate?id='.$user->id.'&code='.$code;
        Mail::send('emails.registration', array('url' => $url), function($message) use ($request)
        {
            $message->to($request->email)->subject('Registration');
        });

        return 'Регистрация прошла успешно, на Ваш email отправлено письмо со ссылкой для активации аккаунта';
    }

    public function activate(Request $request)
    {
        $result = Code::where('user_id', $request->id)
            ->where('code', $request->code)
            ->first();
        if ($result) {
            $result->delete();
            Auser::find($request->id)
                ->update([
                    'activated' => 1
                ]);
            return redirect("auth/login")->with(["message" => "ok"]);
        }
        return abort(404);
    }

    public function postLogin(Request $request)
    {
        $request->password = bcrypt($request->password);
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'activated' => 1])) {
            return 'Redirect to user cabinet';
        }
        print_r($request->password);
        return;
        echo 'fuck up<br>';
        return redirect('auth/login')->with(["message" => "bad luck"]);
    }
}