<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ExpenseCategory;
use App\Expense;
use Acme\Constants;
use Acme\DataResult;
use Acme\Common;
use Response;

class ExpenseCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $result = new DataResult;
      $categories = ExpenseCategory::whereNull(Constants::DELETED_AT)->get();

      $result->data = $result;
      $result->error = false;

      if($categories->count() == 0) {
        $result->data = [];
      }

      return view('expensecategory.index')->with('data', $result);
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

        $existingColors = ExpenseCategory::where('color', '!=', '')->get()->pluck('color')->toArray();
        $hexCode = Common::getRandomHexCode();

        while(in_array($hexCode, $existingColors)) {
            $newHex = Common::getRandomHexCode();
        }
        $input['color'] = $hexCode;
        $data = ExpenseCategory::create($input);

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
      $category = ExpenseCategory::find($id);

      if($category) {
        $result->data = $category;
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
          ExpenseCategory::where(Constants::ID, $id)->update($request->all());

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
      $expenses = Expense::where('category_id', $id)->get()->count();

      if(count($expenses) > 1) {
        $result->message = "This category is associated with one or more expenses.";
        $result->error = true;
        return response()->json($result);
      }

      if($id != '' && $id != 0) {
        ExpenseCategory::where(Constants::ID, $id)->delete();
        $result->message = "Deleted!";
        $result->error = false;
      }
      return response()->json($result);
    }

    public function getList(Request $request) 
    {
      $result = new DataResult;
      $categories = ExpenseCategory::select('id', 'name', 'description', 'created_at')->whereNull('deleted_at')->get();

      $result->data = $categories;
      $result->error = false;

      if($categories->count() == 0) {
        $result->data = [];
      }

      return response()->json($result);
    }
}
