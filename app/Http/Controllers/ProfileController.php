<?php


namespace App\Http\Controllers;


use Auth;

class ProfileController extends Controller
{
    /**
     * @var \App\User|null
     */
    protected $user;

    public function __construct()
    {
        $this->user = Auth::user();

        view()->share('user', $this->user);
    }

    public function profile()
    {
        return view('magazine.profile');
    }

    public function getAddress()
    {
        return view('magazine.profile.address');
    }

    public function postAddress()
    {

    }
}