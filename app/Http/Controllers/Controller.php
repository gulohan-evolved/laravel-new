<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

use App\gulModel;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getUser()
    {
    	return response()->json(gulModel::get());
    }

    public function addUser(Request $req)
	{
		$user = new gulModel();

		$user->name=$req->name;
		$user->last_name=$req->last_name;
		$user->password=$req->password;

		$user->save();

		if($user)
			return "Получилось";
	}

	public function updateUser(Request $req)
	{
		$user=gulModel::where("id", $req->id)->first();

		$user->name=$req->name;
		$user->last_name=$req->last_name;
		$user->password=$req->password;

		$user->save();

		return response()->json($user);
	}

	public function deleteUser(Request $req)
	{
		$user=gulModel::where("id", $req->id)->first();

		if($user->delete())
			return "delete";
		return "no";
	}


	public function signUp(Request $req)
	{
		$val=Validator::make($req->all(),[
			'name'=>'required',
			'last_name'=>'required',
			'password'=>'required|unique:gul',
		]);

		if($val->fails())
			return $val->errors();

		$user=gulModel::create($req->all());
		return "Registration is complete";
	}


	public function signIn(Request $req)
	{
		$val=Validator::make($req->all(),[
			'name'=>'required|exists:gul',
			'password'=>'required|exists:gul',
		]);

		if($val->fails())
			return $val->errors();

		$user=gulModel::where("name",$req->name)->first();
		if($req->password==$user->password)
			$user->api_token=Str::random(50);
		$user->save();
		return "authorization was successful";
	}
}
