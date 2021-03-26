<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Client;

class UserController extends Controller
{
  // get current user
  public function get(Request $request)
  {
    $user = auth('api')->user();
    return response()->json($user);
  }

  public function list() {
    $clients = Client::select(['id', 'name', 'secret'])->get()->toArray();
    return response($clients);
  }

  public function new() {

  }
}
