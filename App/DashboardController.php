<?php

namespace App;
use Ez\Database as DB;
use Ez\Request;
use Ez\View;

class DashboardController extends Controller
{
    
	public function __construct()
	{
	    
	}

	public function getIndex()
	{
	    View::render('App.view.dashboard.index');
	}

}

