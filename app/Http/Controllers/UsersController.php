<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

use App\User;

class UsersController extends Controller
{
    public function create(Request $request)
    {
        $user_id = $request->user()->id;
        $email = $request->input('email');
        if($email){
            $exisitingUser = User::where('email', $email)->first();

            if($exisitingUser){
                return response('User with that email already exists.', 403);
            }
        }

        $user = new User();

        $id = $request->input('id');
        if($id !== 0){
            $user->id = $id;
        }

        $user->name = $request->input('name');
        $user->person_id = $request->input('person_id') ?? null;
        $user->role_id = $request->input('role_id') ?? null;
        $user->foreign_id = $request->input('foreign_id') ?? null;
        $user->foreign_source_id = $request->input('foreign_source_id') ?? null;
        $user->email = $email;
        $user->password = Hash::make($request->input('password'));
        $user->created_by = $user_id;

        $user->save();

        $user_id = $user->id;

        return response($user->toJson(), 201);
    }

    public function get(Request $request, $user_id = null)
    {
        if($user_id){
            $user = User::find($user_id);

            if($user){
                return response($user->toJson(), 200);
            }else{
                return response("User not found.", 404);
            }
        }

        $email = $request->input('email');

        $limit = $request->input('limit');
        $offset = $request->input('offset');

        $users = User::query();

        if($limit && $offset){
            $users->limit($limit)->offset($offset);
        }

        if($email){
            $users->where('email', $email);
        }

        $with_relationships = explode(',', $request->input('with'));

        $with_array = [];
        foreach($with_relationships as $relationship){
            switch($relationship){
                case 'person':
                    $with_array[] = 'person';
                    break;
                case 'role':
                    $with_array[] = 'role';
                    break;
            }
        }
        if($with_array){
            $users->with($with_array);
        }

        $users = $users->get();

        return response($users->toJson(), 200);
    }

    public function update(Request $request, $user_id)
    {
        $user = User::find($user_id);

        $user->name = $request->input('name');
        $user->person_id = $request->input('person_id') ?? null;
        $user->role_id = $request->input('role_id') ?? null;
        $user->foreign_id = $request->input('foreign_id') ?? null;
        $user->foreign_source_id = $request->input('foreign_source_id') ?? null;
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->created_by = $user_id;

        $user->save();

        return response($user->toJson(), 200);
    }

    public function delete(Request $request, $user_id)
    {
        $force_delete = $request->input('force_delete');

        if($force_delete == true){
            $user = User::find($user_id);

            $user->forceDelete();
        }else{
            $user = User::destroy($user_id);
        }

        return response("", 204);
    }
}
