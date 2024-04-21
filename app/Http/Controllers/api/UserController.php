<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use App\Helpers\APIFormatter;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function user(Request $request) {
        try {
            $user = User::where('id', Auth::id())->first();

            if($user) {
                return APIFormatter::createAPI(200, "Success", $user);
            } else {
                return APIFormatter::createAPI(400, 'Failed');
            }
        } catch (Exception $e) {
            return APIFormatter::createAPI(500, 'Failed', $e);
        }
    }
}