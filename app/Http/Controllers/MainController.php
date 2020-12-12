<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller as Controller;

class MainController extends Controller
{
    public function __construct(){

    }

    public function index(){
    	$data = array();
    	$data['company_url'] = asset('img/src.png');
    	$data['categories'] = include(resource_path('appData/categories.php'));
    	$data['objects'] = include(resource_path('appData/objects.php'));
    	$data['categoryKeys'] = array();


    	foreach ($data['categories'] as $key => $cat) {
    		array_push($data['categoryKeys'], $key);
    	}


    	return view('index', $data);
    }

}
