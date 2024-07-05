<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::orderBy('created_at', 'desc')->get();
        return $users;
    }
}
