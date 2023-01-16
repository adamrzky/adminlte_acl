<?php

namespace App\Http\Controllers;

use App\Models\Merchant;
use App\Models\Mcc;
use App\Models\MerchantDetails;
use App\Models\MerchantDomestic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;

class MerchantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:merchant-list|merchant-create|merchant-edit|merchant-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:merchant-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:merchant-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:merchant-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $merchant = Merchant::latest()->paginate(5);

        return view('merchant.index', compact('merchant'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mcc = Mcc::orderBy('DESC_MCC')->get()->toArray();
        $criteria = getCriteria();
        $prov = getWilayah();

        return view('merchant.create', compact('mcc', 'criteria', 'prov'));
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
            'norek' => 'required|numeric',
            'merchant' => 'required',
            'mcc' => 'required',
            'criteria' => 'required',
            'prov' => 'required',
            'city' => 'required',
            'address' => 'required',
            'postalcode' => 'required',
            'fee' => 'required',
        ]);

        try {
            $date = date('Y-m-d H:i:s');
            $nmid = 'ID' . genID(13);
            $domain = 'ID.CO.QRIS.WWW';
            $data_domestic = [
                'REVERSE_DOMAIN' => $domain,
                'NMID' => $nmid,
                'MCC' => $request->mcc,
                'CRITERIA' => $request->criteria,
            ];
            $id_domestic = MerchantDomestic::create($data_domestic)->id;

            $data_merchant = [
                'CREATED_AT' => $date,
                'UPDATED_AT' => '',
                'TERMINAL_LABEL' => 'K19',
                'MERCHANT_COUNTRY' => 'ID',
                'QRIS_MERCHANT_DOMESTIC_ID' => $id_domestic,
                'TYPE_QR' => 'STATIS',
                'MERCHANT_NAME' => $request->merchant,
                'MERCHANT_CITY' => $request->city,
                'POSTAL_CODE' => $request->postalcode,
                'MERCHANT_CURRENCY_CODE' => '360',
                'MERCHANT_TYPE' => $request->mcc,
                'MERCHANT_EXP' => '900',
                'MERCHANT_CODE' => genID(5, true),
                'MERCHANT_ADDRESS' => $request->address,
                'STATUS' => '1',
                'NMID' => $nmid
            ];

            $merchant_id = Merchant::create($data_merchant)->id;

            $data_detail = [
                'MERCHANT_ID' => $merchant_id,
                'DOMAIN' => $domain,
                'TAG' => '26',
                'MPAN' => $request->norek,
                'MID' => $nmid,
                'CRITERIA' => $request->criteria
            ];
            $merchant_detail = MerchantDetails::create($data_detail);
            
            return redirect()->route('merchant.index')->with(['msg' => 'Merchant created successfully.']);
        } catch (\Throwable $th) {
            return back()->withErrors(['msg' => 'Merchant created failed. ('.$th->getMessage().')']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Merchant  $merchant
     * @return \Illuminate\Http\Response
     */
    public function show(Merchant $merchant, $id)
    {
        $id = Crypt::decrypt($id);
        $merchant = Merchant::where('id', $id)->first();
        return view('merchant.show', compact('merchant'));
    }



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
        $id = Crypt::decrypt($id);
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
            'TERMINAL_LABEL' => 'required',
            'MERCHANT_COUNTRY' => 'required',
            'QRIS_MERCHANT_DOMESTIC_ID' => 'required',
            'TYPE_QR' => 'required',
            'MERCHANT_NAME' => 'required',
            'MERCHANT_CITY' => 'required',
            'POSTAL_CODE' => 'required',
            'MERCHANT_CURRENCY_CODE' => 'required',
            'MERCHANT_TYPE' => 'required',
            'MERCHANT_ID' => 'required',
            'REKENING_NUMBER' => 'required',
            'CATEGORY' => 'required',
            'CRITERIA' => 'required',
            'STATUS' => 'required',
            'MERCHANT_ADDRESS' => 'required'
        ]);

        // $request = Merchant::find->();
        // $request->update($merchant);

        $merchant->save($request->all());
        // dd($merchant); 

        return redirect()->route('merchant.index')
            ->with('success', 'Merchant updated successfully');
    }
}
