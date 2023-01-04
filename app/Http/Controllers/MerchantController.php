<?php

namespace App\Http\Controllers;
use App\Models\Merchant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class MerchantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:merchant-list|merchant-create|merchant-edit|merchant-delete', ['only' => ['index','show']]);
        $this->middleware('permission:merchant-create', ['only' => ['create','store']]);
        $this->middleware('permission:merchant-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:merchant-delete', ['only' => ['destroy']]);
    }
    
    public function index()
    {
        $merchant = Merchant::latest()->paginate(5);

        // dd($merchant);

        return view('merchant.index',compact('merchant'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

   
        
      
        
        /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('merchant.create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        request()->validate([
            // 'ID' => '',
            // 'CREATED_AT' => 'required',
            // 'UPDATED_AT' => 'required',
            // 'TERMINAL_LABEL' => 'required',
            // 'MERCHANT_COUNTRY' => 'required',
            // 'QRIS_MERCHANT_DOMESTIC_ID' => 'required',
            // 'TYPE_QR' => 'required', 
            'MERCHANT_NAME' => 'required',
            // 'MERCHANT_CITY' => 'required',
            // 'POSTAL_CODE' => 'required',
            'MERCHANT_CURRENCY_CODE' => 'required',
            // 'MERCHANT_TYPE' => 'required',
            // 'MERCHANT_ID' => 'required',
            'REKENING_NUMBER' => 'required',
            'CATEGORY' => 'required',
            'CRITERIA' => 'required',
            'STATUS' => 'required',
            'MERCHANT_ADDRESS' => 'required'
        ]);
    
        Merchant::create($request->all());
        
        return redirect()->route('merchant.index')
                        ->with('success','Merchant created successfully.');
                       
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Merchant  $merchant
     * @return \Illuminate\Http\Response
     */
    public function show(Merchant $merchant, $id)
    {
        // $id = Crypt::decrypt($id);
        $merchant = Merchant::where('id', $id)->first();
        return view('merchant.show', compact('merchant'));
    }

    // public function broadcast(Merchant $merchant, $id)
    // {
    //     $id = Crypt::decrypt($id);
    //     $merchant = Merchant::where('id', $id)->first();
    //     return view('merchants.show', compact('merchant'));
    // }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Merchant  $merchant
     * @return \Illuminate\Http\Response
     */
    // public function edit(Merchant $merchant)
    // {
    //     return view('merchants.edit',compact('merchant'));
    // }
    public function edit(Merchant $merchant, $id)
    {
        // $id = Crypt::decrypt($id);
        $merchant = Merchant::where('id', $id)->first();
        return view('merchant.edit', compact('merchant'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Merchant  $merchant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Merchant $merchant)
    {
        request()->validate([
            // 'ID' => '',
            'CREATED_AT' => '',
            'UPDATED_AT' => '',
            // 'TERMINAL_LABEL' => '',
            'MERCHANT_COUNTRY' => '',
            // 'QRIS_MERCHANT_DOMESTIC_ID' => 'required',
            // 'TYPE_QR' => 'required', 
            'MERCHANT_NAME' => '',
            'MERCHANT_CITY' => 'required',
            'POSTAL_CODE' => '',
            'MERCHANT_CURRENCY_CODE' => '',
            // 'MERCHANT_TYPE' => 'required',
            'MERCHANT_ID' => '',
            'REKENING_NUMBER' => '',
            'CATEGORY' => '',
            'CRITERIA' => '',
            'STATUS' => '',
            'MERCHANT_ADDRESS' => ''
        ]);
        
        
        
        $merchant->save($request->all());
        // dd($merchant); 
    
        return redirect()->route('merchant.index')
                        ->with('success','Merchant updated successfully');
    }
    
    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  \App\Merchant  $merchant
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy(Merchant $merchant)
    // {
    //     $qris_merchant->delete();
    
    //     return redirect()->route('merchants.index')
    //                     ->with('success','Merchant deleted successfully');
    // }
    
}
