<?php

namespace Acme\Controllers;

use Acme\DB\User;

class HomeController
{
    public function index()
    {
        $user = User::findById(1);
        return view('home', compact('user'));
    }
}
