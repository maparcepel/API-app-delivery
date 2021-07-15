<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    
    public function edit(Request $request)
    {
        // $data = toArray(new UserResource($request));
        $user = User::findOrFail($request->id)->update($request->all());
        return response($user );
    }

}
