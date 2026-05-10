<?php

namespace App\Http\Controller;

use App\Http\Request;
use App\Http\Controller;

class UserController extends Controller
{
    public function show(Request $request)
    {
        $id = $request->param(0);

        return $this->json([
            'status' => 'success',
            'user_id' => $id
        ]);
    }
}