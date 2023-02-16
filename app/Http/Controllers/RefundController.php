<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Refund;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use Illuminate\Foundation\Auth\AuthenticatesUsers;



class RefundController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Refund::get()->toArray();

        $amount = $data[0]['RETRIEVAL_REFERENCE_NUMBER'];

        // $user = new AuthenticatesUsers();
        // dd($user);

        // dd($amount);
        // dd($data);
        return view('refund.index', compact('data', 'amount'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function hit(Request $request)
    {
      
        // dd($request->toArray());

        $request->validate([
            'RRN'=>'required',
            'AMOUNTS' => 'required|integer',
            'AMOUNT' => 'required|integer|lte:AMOUNTS'
        ]);
     
        $data = [
        
                "RRN" => $request['RRN'],
                "AMOUNT" => $request['AMOUNT']
            
        ];

        // dd($request->user());

        // $request->validate([

        //     $this->username() => 'required|string',
        //     'password' => 'required|string',
        // ]);

        // dd($request);

        // dd($data);
        $user = $request->user();

        $token = Http::timeout(5)->withHeaders([
            'Content-Type' => 'application/json',
            'Access-Control-Allow-Origin' => '*',
        ])->post(
            'http://127.0.0.1:8000/api/gettoken',
            [
                "email" => $user->email,
                "password" => '123456'
            ]
        );
        $resptoken = $token->json();

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' .$resptoken['access_token'] ,
            'Content-Type' => 'application/json',
        ])->post(
            'http://127.0.0.1:8000/api/refund',
            $data
        );
        
        // dd($response->json());
        $res = $response['RC'];

        // dd($res);
        $error = ( $response != '0000' );
        $errorMsg =  $response['RM'];
        
        if ($res != '0000') {

            // dd($resp);
        }
        try {

            return redirect()->route('refund.index')
            ->with('errors', 'Refund Failed ' . ' => '  . json_encode($errorMsg)         );

            
            

            // return response()->json([
            //     'IN'    => $response['MPO']['INVOICE_NUMBER'],
            // ]);
        } catch (\Throwable $th) {

            return redirect()->route('refund.index')
            ->with('success','Refund successfully . Invoice Number : '  .  json_encode($res)  );
     }


        // dd($res);
        // $invoiceNumber = 

        // dd($data);
        // dd($response->json());
        // return redirect()->route('refund.index')
        //                 ->with('success','Refund successfully . Invoice Number : '  .  json_encode($res)  );
       
    }
}

