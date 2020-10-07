<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResourceController extends Controller
{
    public function getJson(){
        return response()->json([
            'success' => false,
            'message' => 'UnAuthorized'
        ]);
    }
}
