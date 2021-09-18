<?php

namespace App\Controllers;
//session_start();
class Doubts extends BaseController
{
	//fetches code from file
	public function index()
	{   
		return view('doubts');
	}	
}
