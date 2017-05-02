<?php
namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;
class UserController extends Controller{

	public function signup(Request $request)
	{
		$this->validate($request,[
			'name'=>'required',
			'email'=>'required|email|unique:users',
			'password'=>'required'
		]);

		$user = new User([
			'name'=> $request->input('name'),
			'email'=> $request->input('email'),
			'password'=>bcrypt($request->input('password'))
		]); 
		$user->save();
		return response()->json([
				'message'=>'usuario creado!'
			], 201);
	}

	public function signin(Request $request)
	{
		$this->validate($request,[
			'name'=>'required',
			'email'=>'required|email',
			'password'=>'required'
		]);
		$credentials = $request->only('email','password');	
		try {
			if(!$token = JWTAuth::attempt($credentials)){
				return response()->json([
					'error'=> 'credenciales invalidas'
				],401);
			}
		} catch (JWTException $e) {
			return response()->json([
				'error'=> 'no se pudo crear token'
			],500);
		}

		return response()->json([
			'token'=> $token
		],200);
	}
}