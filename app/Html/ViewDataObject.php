<?php


namespace App\Html;


use Auth;

class ViewDataObject
{
    /**
     * @var string
     */
    public $title = "no title";

    /**
     * @var \App\User|null
     */
    public $user = null;

    public function __construct()
    {
        $this->user = Auth::user();
    }

    public function hasUser()
    {
        return $this->user != null;
    }
}