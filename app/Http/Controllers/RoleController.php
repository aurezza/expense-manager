<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\User;
use Acme\Constants;
use Acme\DataResult;
use Response;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $result = new DataResult;
      $roles = Role::whereNull(Constants::DELETED_AT)->get();

      $result->data = $result;
      $result->error = false;

      if($roles->count() == 0) {
        $result->data = 'No records found.';
      }

      return view('role.index')->with('data', $result);
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

      $data = Role::create($input);

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
      $role = Role::find($id);

      if($role) {
        $result->data = $role;
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
    public function edit($id)
    {
        //
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
        try {
          $result = new DataResult;
          Role::where(Constants::ID, $id)->update($request->all());

          $result->error = false;
          $result->message = Constants::SUCCESS_MSG;
        } catch(\Exception $ex) {
          $result->error = false;
          $result->message = Constants::ERROR_RETRY_MSG;
        }

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
      $users = User::where('role_id', $id)->get()->count();

      if(count($users)) {
        $result->message = "This role is associated with one or more user.";
        $result->error = true;
        return response()->json($result);
      }

      if($id != '' && $id != 0) {
        Role::where(Constants::ID, $id)->delete();
      }
    }

    public function getList(Request $request) 
    {
      $result = new DataResult;
      $roles = Role::select('id', 'name', 'description', 'created_at')->whereNull('deleted_at')->get();

      $result->data = $roles;
      $result->error = false;

      if($roles->count() == 0) {
        $result->data = 'No records found.';
      }

      return response()->json($result);
    }
}
