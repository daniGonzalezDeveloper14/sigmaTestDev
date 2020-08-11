<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\testRequest;
use DB;

class viewController extends Controller
{
    //visualizacion vista viewForm
    public function showForm(){
    	return view('viewForm');
    }

    public function store(testRequest $request){

    	$state = $request->get('selectState');
    	$city = $request->get('selectCity');
    	$name = $request->get('formName');
    	$email = $request->get('formEmail');

    	$insertData = DB::table('contacts')->insert(
            ['name' => $name, 'email' => $email, 'state' => $state, 'city' => $city]
        );

        $data = $insertData;

    	return view('viewForm')->with('data', $data);
    }
}
