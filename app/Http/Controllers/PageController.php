<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends AppController
{

    public function index()
    {
        return view('welcome');
    }

    public function samplePage1()
    {
        return 'sample page 1';
    }

    public function samplePage2()
    {
        return 'sample page 2';
    }

}
