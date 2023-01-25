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
        $data = Transaction::All();
        return DataTables::of($data)->make(true);
    }
}
