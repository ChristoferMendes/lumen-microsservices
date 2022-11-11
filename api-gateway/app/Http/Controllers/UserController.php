<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\ApiResponser;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    use ApiResponser;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Return the list of users
     *
     * @return Response
     */
    public function index() {
        $users = User::all();
 
        return $this->validResponse($users);
    }

    /**
     * Create an user
     *
     * @return Response
     */
    public function store(Request $request) {
        $rules = [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ];

        $this->validate($request, $rules);

        $fields = $request->all();
        $fields['password'] = Hash::make($request->password);

        $user = User::create($fields);

        return $this->validResponse($user, Response::HTTP_CREATED);
    }

    /**
     * Show details of an existing author
     *
     * @return Illuminate\Http\Response
     */
    public function show($id) {
       $user = User::findOrFail($id);

       return $this->validResponse($user);
      
    }

    /**
     * Modify an existing author
     *
     * @return Illuminate\Http\Response
     */
    public function update($id, Request $request) {
        $user = User::findOrFail($id);

        $rules = [
          'name' => 'max:255',
          'email' => 'email|unique:users,email,' . $id,
          'password' => 'min:8|confirmed',
        ];

        $this->validate($request, $rules);
        $user->fill($request->all());

        if ($request->has('password')) {
          $user->password = Hash::make($request->password);
        }

        if ($user->isClean()) {
            return $this->errorResponse('At least one value must change',
            Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $user->save();

        return $this->validResponse($user);
    }

    /**
     * Remove an axisting author
     *
     * @return Illuminate\Http\Response
     */
    public function destroy($id) {
       $user = User::findOrFail($id);

       $user->delete();

       return $this->validResponse($user);
    }
    
    /**
     * Identify existing user
     *
     * @return Response
     */
    public function me (Request $request) {
      return $this->validResponse($request->user());
    }
}
