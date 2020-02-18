<?php

namespace App\Http\Controllers;

class MainController extends Controller
{
    public function index()
    {
		return view('Home');
    }
	
	public function category($category_name)
    {	
		return view('Category');
    }
}
