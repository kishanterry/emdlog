<?php

namespace App\Http\Controllers;

class PagesController extends Controller
{

    /**
     * PagesController constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function homePage()
    {
        return view('pages.home');
    }
}
