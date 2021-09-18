<?php

namespace App\Controllers;
//session_start();
class Hello extends BaseController
{
	//fetches code from file
	public function index()
	{   
		return view('hello');
	}	
}
