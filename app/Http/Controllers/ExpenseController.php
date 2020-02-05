<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Expense;
use App\ExpenseCategory;
use Acme\Constants;
use Acme\DataResult;
use Response;
use Hash;
use Auth;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $result = new DataResult;
      $categpries = ExpenseCategory::whereNull(Constants::DELETED_AT)->get()->pluck('name', 'id');
      $result->data = $categpries;
      $result->error = false;

      return view('expense.index')->with('result', $result);
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
        $user = Auth::user();
        $result = new DataResult;
        $input = $request->all();

        if($user) {
          $input['user_id'] = $user->id;
        }
        
        $data = Expense::create($input);

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
      $user = Expense::find($id);

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
          Expense::where(Constants::ID, $id)->update($request->all());

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
      if($id != '' && $id != 0) {
        Expense::where(Constants::ID, $id)->delete();
      }
    }

    public function getList(Request $request) 
    {
      $result = new DataResult;
      $users = Expense::select('id', 'category_id', 'amount', 'entry_date', 'created_at')->whereNull('deleted_at')->get();

      $result->data = $users;
      $result->error = false;

      if($users->count() == 0) {
        $result->data = [];
      }

      return response()->json($result);
    }
}
