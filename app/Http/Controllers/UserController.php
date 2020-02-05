<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use Acme\Constants;
use Acme\DataResult;
use Response;
use Hash;
use Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $result = new DataResult;
    //   $users = User::whereNull(Constants::DELETED_AT)->get();
      $roles = Role::whereNull(Constants::DELETED_AT)->get()->pluck('name', 'id');
      $result->data = $roles;
      $result->error = false;

      return view('user.index')->with('result', $result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $result = new DataResult;
        $input = $request->all();
        $exist = User::where('email', $input['email'])->first();
        if($exist) {
            $result->error = true;
            $result->message = 'Email is already registered.';
            return response()->json($result);
        }
        
        $input['password'] = Hash::make($input['password']);
        $data = User::create($input);

        if($data) {
            $result->data = $data;
            $result->error = false;
        } else {
            $result->error = true;
            $result->message = Constants::ERROR_RETRY_MSG;
        }

        return response()->json($result);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $result = new DataResult;
      $user = User::find($id);

      if($User) {
        $result->data = $User;
        $result->error = false;
      } else {
        $result->error = true;
        $result->message = Constants::ERROR_NF_MSG;
      }

      return response()->json($result);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = Auth::user();

        return view('user.edit')->with('user', $user);
    }

    public function editAccount(Request $request) 
    {
        $result = new DataResult;
        $user = Auth::user();
        $input = $request->all();

        if($user) {
            User::where(Constants::ID, $user->id)->update($input);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // try {
          $result = new DataResult;
          $input = $request->all();
          $user = User::find($id);
          if($user->email != $input['email']) {
              $exists = User::where('email', $input['email'])->first();
              if($exists) {
                $result->error = true;
                $result->message = 'Email is already registered.';
                return response()->json($result);
              }
          }

          if(isset($input['password'])) {
            $input['password'] = Hash::make($input['password']);
          }

          if(isset($input['password_confirm'])) {
            unset($input['password_confirm']);
          }
          User::where(Constants::ID, $id)->update($input);

          $result->error = false;
          $result->message = Constants::SUCCESS_MSG;
        // } catch(\Exception $ex) {
          $result->error = false;
          $result->message = Constants::ERROR_RETRY_MSG;
        // }

        return response()->json($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $result = new DataResult;
      if($id != '' && $id != 0) {
        User::where(Constants::ID, $id)->delete();
      }

      $result->error = false;
      $result->message = 'Deleted';

      return response()->json($result);
    }

    public function getList(Request $request) 
    {
      $result = new DataResult;
      $users = User::select('id', 'name', 'email', 'role_id', 'created_at')->whereNull('deleted_at')->get();

      $result->data = $users;
      $result->error = false;

      if($users->count() == 0) {
        $result->data = [];
      }

      return response()->json($result);
    }
}
