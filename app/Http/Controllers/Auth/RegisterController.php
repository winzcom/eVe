<?php

namespace App\Http\Controllers\Auth;

use App\User;

use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;

use Illuminate\Support\Facades\Mail;
use App\Mail\SendVerificationMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Requests\FormRegistration;;
use App\Service\Service;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';
     

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        return view('auth.register')
        ->with(['formInputs'=>User::getRegisterInputs(),
        'categories'=>Service::getCategories(),
        'states'=>Service::getStates()
        ]);
    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, Service::formRules(new FormRegistration));
    }

    protected function register(Request $request){

        $this->validator($request->all())->validate();

        DB::Transaction(function() use ($request){
                event(new Registered($user = $this->create($request->all())));
                $this->sendVerificationMail($user);
        },5);

        return redirect('login')->with('message','A verification email has been sent');
        
    }

    /*protected function redirectTo(){
        return redirect('/login')->with('status','An Email has been sent to You');
    }*/

    private function sendVerificationMail($user){

        Mail::to($user->email)
            ->send(new SendVerificationMail($user));
    }

    private function generateToken(){
        return str_random(40);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $user = Service::createNewUser($data);
        $user->confirm_token = $this->generateToken();
        $user->save();
        $this->sendVerificationMail($user);
        return $user;
    }

    public function verifyToken($confirm_token){

        $user = User::where('confirm_token','=',$confirm_token)->first();

        if(!$user) throw new \Exception;

        $user->confirm_token = null;
        $user->confirmed = 1;
        $user->save();
        return redirect('login')->with('message','Please Login');
        //$this->guard()->login($user);
    }
}
