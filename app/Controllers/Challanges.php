<?php

namespace App\Controllers;
session_start();
class Challanges extends BaseController
{
	
	public function index()
	{   
		return view('challanges');
	}	

}
