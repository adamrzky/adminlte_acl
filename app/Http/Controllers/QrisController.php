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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    public function hit(Request $request)
    {
        // dd($request);
        
        // Log::channel('weblog')->info('req : ' . $request);
        // dd($request->all());
        switch ($request->qrType) {
            case '1':
                $data = [
                    "MPI" => [
                        "MERCHANT_ID" => $request['MERCHANT_ID'],
                        "AMOUNT" => $request['AMOUNT']
                    ]
                ];

                break;

            case '2':
                $data = [
                    "MPI" => [
                        "MERCHANT_ID" => $request['MERCHANT_ID'],
                        "AMOUNT" => $request['AMOUNT']
                    ]
                ];
                break;

            case '3':
                $data = [
                    "MPI" => [
                        "MERCHANT_ID" => $request['MERCHANT_ID'],
                        "AMOUNT" => $request['AMOUNT']
                    ]
                ];
                break;

            case '4':
                $data = [
                    "MPI" => [
                        "MERCHANT_ID" => $request['MERCHANT_ID'],
                        "AMOUNT" => $request['AMOUNT']
                    ]
                ];
                break;

            case '5':
                $data = [
                    "MPI" => [
                        "MERCHANT_ID" => $request['MERCHANT_ID'],
                        "AMOUNT" => $request['AMOUNT']
                    ]
                ];
                break;

            case '6':
                $data = [
                    "MPI" => [
                        "MERCHANT_ID" => $request['MERCHANT_ID'],
                        "AMOUNT" => $request['AMOUNT']
                    ]
                ];
                break;

            case '7':
                $data = [
                    "MPI" => [
                        "MERCHANT_ID" => $request['MERCHANT_ID'],
                        "AMOUNT" => $request['AMOUNT'],
                        "TIP_INDICATOR" => $request['TIP_INDICATOR']
                    ]
                ];
                break;

            case '8':
                $data = [
                    "MPI" => [
                        "MERCHANT_ID" => $request['MERCHANT_ID'],
                        "AMOUNT" => $request['AMOUNT'],
                        "FEE_AMOUNT" => $request['FEE_AMOUNT']
                    ]
                ];
                break;

            case '9':
                $data = [
                    "MPI" => [
                        "MERCHANT_ID" => $request['MERCHANT_ID'],
                        "AMOUNT" => $request['AMOUNT'],
                        "FEE_AMOUNT_PERCENTAGE" => $request['FEE_AMOUNT_PERCENTAGE']
                    ]
                ];
                break;



            default:
                $data = [];
                break;
        }

        // dd($data);
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post(
            'http://192.168.26.75:9800/v1/api/aquerier/create/qr',
            $data
        );


        // dd($data);

        Log::channel('weblog')->info('resp api : ' . $response);
        
        $qris = ($response['MPO']['QRIS']);
        $nmid = ($response['MPO']['NMID']);
        
        //qrcode
        $qrcode =  base64_encode(QrCode::format('png')->size(200)->generate($qris));
    
        //qrispng
        $wmQris = Image::make('images/qris.png');
        $wmQris->resize(100, 50);
        
        //getPngQRCode
        $wmQrcode = Image::make($qrcode);
        $wmQrcode->resize(100, 50);
        
        //canvas
        $canvas = Image::canvas(400, 400);

        //insertToCanvas
        $canvas->insert($wmQris, 'top' );
        $canvas->insert($qrcode, 'center' );
        $canvas->text('NMID : ' .$nmid  , 150 , 350, function($font) {
        
            $font->size(50);

        });
        
        $canvas->save('images/hasil2.jpg');
        

        $base64 = base64_encode($canvas);
        // dd($base64);

        return response()->json([
            'data'    => $response['MPO']['QRIS'],
            'qr' => $base64,

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
