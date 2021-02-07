<?php

namespace App\Http\Page;

use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function index()
    {
        return view('welcome');
    }
}
