<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ExpenseCategory;
use App\Expense;
use Acme\Common;
use DB;
use Auth;
use Acme\DataResult;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $result = new DataResult;
        $data = [];
        $labels = [];
        $hexCodes = [];
        $newHex = Common::getRandomHexCode();
        $expenseCategories = ExpenseCategory::select('name','color')
            ->withCount(['expenses' => function($query) use ($user) {
                $query->select(DB::raw("SUM(amount) as total"));
            }])->get();

        foreach($expenseCategories as $category) {
            $data[] = $category->expenses_count;
            $labels[] = $category->name;
            $hexCodes[] = $category->color;
        }
        $result->data = [
            'data' => $data,
            'labels' => $labels,
            'backgroundColor' => $hexCodes,
            'all' => $expenseCategories
        ];

        return view('home')->with('result', $result);
    }
}
