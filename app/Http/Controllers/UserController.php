<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Validator; 

class UserController extends Controller
{
    
    public function edit(Request $request){

        $authenticatedUserId =  auth()->user()->id;
        

            $validatedData = $request->validate([
                'name'      => 'required|max:255',
                'surname'   => 'required|max:255',
                'phone'     => 'required|max:20',
                'email'     => 'required|email|unique:users,email,'.$authenticatedUserId,
                'user_type' => 'required|max:20',
            ]);

            $user = User::findOrFail($authenticatedUserId);
            $user->update($validatedData);
            
            return response(['user' => $request->all(), 'message' => 'Edited Successfully' ]);
        
    }

}
