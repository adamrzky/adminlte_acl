<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Intervention\Image\ImageManager;
use Image;
use Illuminate\Support\Facades\Route;

class QrisController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('qris.index');
    }

    public function hit (Request $request)
    {

        // dd($request['qrType']);
        // Log::channel('weblog')->info('req : ' . $request);
        $data = [
            "qrType" =>  $request['qrType'],
            "param" => [
                "MPI" => [
                    "MERCHANT_ID" =>  $request['MERCHANT_ID'],
                    "AMOUNT" =>  $request['AMOUNT'],
                    "TIP_INDICATOR" =>  $request['TIP_INDICATOR'],
                    "FEE_AMOUNT" =>  $request['FEE_AMOUNT'],
                    "FEE_AMOUNT_PERCENTAGE" =>  $request['FEE_AMOUNT_PERCENTAGE'],
                        ]
                      ]
                ];
                
        Log::channel('weblog')->info('REQ SEND : ' .  json_encode($data));
            

        // dd($data['param']);

        $token = Http::timeout(5)->withHeaders([
            'Content-Type' => 'application/json',
            'Access-Control-Allow-Origin' => '*',
        ])->post(
            route('gettoken'),
            [
                "email" => "admin@gmail.com",
                "password" => "123456"
            ]
        );
        $resptoken = $token->json();
        // dd($resptoken['access_token']);

        // $response = Http::withHeaders([
        //     'Content-Type' => 'application/json',
        // ])->post(
        //     'http://192.168.26.75:9800/v1/api/aquerier/create/qr',
        //     $data
        // );

        // $request = Request::create('api/gettoken', 'POST', [
        //     "email" => "admin@gmail.com",
        //     "password" => "123456"
        // ]);
        // $request->headers->set('Content-Type', 'application/json');

        // $response = Route::dispatch($request);

        // dd($response);

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' .$resptoken['access_token'] ,
            'Content-Type' => 'application/json',
        ])->post(
            'http://127.0.0.1:8000/api/qris',
            $data
        );

        
        // dd($data['AMOUNT']);

        // Log::channel('weblog')->info('resp : ' . $response);
        //  dd($response['MPO']['QR']);

        // return response()([
        //     'qr'    => $response['MPO']['QR'],
        // ]);
        // dd($response['MPO']['QR']);
        
        return response()->json([
            'qr'    => $response['MPO']['QR'],
            // 'qr' => $base64,
    
        ]);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        //
    }
}
