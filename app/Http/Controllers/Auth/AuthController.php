<?php

namespace App\Http\Controllers\Auth;

use App\Authentication\Social\SocialAuthenticator;
use App\Events\UserWasRegisteredWithEmail;
use App\Events\UserWasRegisteredWithSocialAuthentication;
use App\Events\UserWasVerifiedWithEmail;
use App\Events\UserWasVerifiedWithSocialAuthentication;
use App\Exceptions\InvalidConfirmationCodeException;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use App\User;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use MezzoLabs\Mezzo\Core\Reflection\Reflections\EloquentModelReflection;
use MezzoLabs\Mezzo\Core\Reflection\Reflections\MezzoModelReflection;
use MezzoLabs\Mezzo\Core\Reflection\Reflections\ModelReflection;
use Validator;

class AuthController extends Controller
{

    protected $redirectPath = '/profile';

    protected $loginPath = '/auth/login';

    protected $oauthProviders = [
        'github' => [

        ]
    ];

    /**
     * @var EloquentModelReflection|MezzoModelReflection|ModelReflection
     */
    protected $userReflection;

    /**
     * @var SocialAuthenticator
     */
    private $socialAuthenticator;


    /**
     * @var UserRepository
     */
    private $users;

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
     * Create a new authentication controller instance.
     * @param SocialAuthenticator $socialAuthenticator
     * @param UserRepository $users
     */
    public function __construct(SocialAuthenticator $socialAuthenticator, UserRepository $users)
    {
        $this->middleware('guest', ['except' => 'getLogout']);
        $this->userReflection = mezzo()->model('User');

        $this->socialAuthenticator = $socialAuthenticator;
        $this->users = $users;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data, $rules = null)
    {
        if (!$rules) {
            $rules = $this->userReflection->rules();
        }

        $rules['password'] = 'required|' . $rules['password'];

        return Validator::make($data, $rules);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'gender' => $data['gender'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => (!empty($data['password'])) ? bcrypt($data['password']) : '',
            'confirmation_code' => $data['confirmation_code'],
            'confirmed' => false,
            'backend' => 0
        ]);
    }


    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function postRegister(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        $data = $request->all();
        $data['confirmation_code'] = str_random(30);

        $user = $this->create($data);

        event(new UserWasRegisteredWithEmail($user));

        \Session::flash('message', 'Please check your mail.');
        return redirect('/');
    }

    public function confirm($confirmation_code)
    {
        if (!$confirmation_code) {
            throw new InvalidConfirmationCodeException;
        }

        $user = User::whereConfirmationCode($confirmation_code)->first();

        if (!$user) {
            throw new InvalidConfirmationCodeException;
        }

        event(new UserWasVerifiedWithEmail($user));

        \Session::flash('message', 'You have successfully verified your account.');

        return redirect('auth/login');
    }

    public function oauthToProvider($provider)
    {
        return $this->socialAuthenticator->getProvider($provider)->redirect();
    }

    public function oauthCallback($provider)
    {
        $provider = $this->socialAuthenticator->getProvider($provider);

        $data = $provider->userData();

        $existing = $this->users->findByEmail($data['email']);

        if ($existing) {
            $data['password'] = '';
            $existing->fill($data)->save();
            \Session::flash('message', 'Account updated.');

            Auth::login($existing, true);

        } else {
            $user = $this->create($data);
            event(new UserWasRegisteredWithSocialAuthentication($user));

            $user->confirmed = true;
            $user->save();

            event(new UserWasVerifiedWithSocialAuthentication($user));



            \Session::flash('message', 'New account.');

            Auth::login($user, true);


        }

        return redirect('/');

    }
}
