<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use DataTables;
// use Yajra\DataTables\Facades\DataTables;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // function __construct()
    // {
    //      $this->middleware('permission:transaction-list|transaction-create|transaction-edit|transaction-delete', ['only' => ['index','show']]);
    //      $this->middleware('permission:transaction-create', ['only' => ['create','store']]);
    //      $this->middleware('permission:transaction-edit', ['only' => ['edit','update']]);
    //      $this->middleware('permission:transaction-delete', ['only' => ['destroy']]);
    //      $this->middleware('permission:transaction-broadcast', ['only' => ['broadcast']]);
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index(TransactionDataTable $dataTable)
    // {
    //     return $dataTable->render('transaction.index');
    // }

    public function index()
    {
        return view('transactions.index');
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
        $data = Transaction::latest();
        
        return DataTables::of($data)
        ->toJson();
    }
}
    public function data2(Request $request)
    {

        
        $searchValue = $request['search']['value']; // Search value
        $searchByAmount = $request['searchByAmount'];
        $searchByStatus = $request['searchByStatus'];
        ## Search 
            $searchQuery = " ";
            if($searchByAmount != ''){
               $searchQuery .= " and (emp_name like '%".$searchByAmount."%' ) ";
            }
            if($searchByStatus != ''){
               $searchQuery .= " and (gender='".$searchByStatus."') ";
            }
            if($searchValue != ''){
               $searchQuery .= " and (emp_name like '%".$searchValue."%' or 
                  email like '%".$searchValue."%' or 
                  city like'%".$searchValue."%' ) ";
            }




    }
 }

