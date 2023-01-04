<?php

namespace App\Http\Controllers\API;


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
        Log::channel('apilog')->info('==============================');
        Log::channel('apilog')->info('REQ : ' . json_encode($request->all()));

        switch ($request->qrType) {
            case '1':
                $data = [
                    "MPI" => [
                        "MERCHANT_ID" => $request->param['MPI']['MERCHANT_ID'],
                        "AMOUNT" => $request->param['MPI']['AMOUNT']
                    ]
                ];

                break;

            case '2':
                $data = [
                    "MPI" => [
                        "MERCHANT_ID" => $request->param['MPI']['MERCHANT_ID'],
                        "AMOUNT" => $request->param['MPI']['AMOUNT']
                    ]
                ];
                break;

            case '3':
                $data = [
                    "MPI" => [
                        "MERCHANT_ID" => $request->param['MPI']['MERCHANT_ID'],
                        "AMOUNT" => $request->param['MPI']['AMOUNT']
                    ]
                ];
                break;

            case '4':
                $data = [
                    "MPI" => [
                        "MERCHANT_ID" => $request->param['MPI']['MERCHANT_ID'],
                        "AMOUNT" => $request->param['MPI']['AMOUNT']
                    ]
                ];
                break;

            case '5':
                $data = [
                    "MPI" => [
                        "MERCHANT_ID" => $request->param['MPI']['MERCHANT_ID'],
                        "AMOUNT" => $request->param['MPI']['AMOUNT']
                    ]
                ];
                break;

            case '6':
                $data = [
                    "MPI" => [
                        "MERCHANT_ID" => $request->param['MPI']['MERCHANT_ID'],
                        "AMOUNT" => $request->param['MPI']['AMOUNT']
                    ]
                ];
                break;

            case '7':
                $data = [
                    "MPI" => [
                        "MERCHANT_ID" => $request->param['MPI']['MERCHANT_ID'],
                        "AMOUNT" => $request->param['MPI']['AMOUNT'],
                        "TIP_INDICATOR" => $request->param['MPI']['TIP_INDICATOR']
                    ]
                ];
                break;

            case '8':
                $data = [
                    "MPI" => [
                        "MERCHANT_ID" => $request->param['MPI']['MERCHANT_ID'],
                        "AMOUNT" => $request->param['MPI']['AMOUNT'],
                        "FEE_AMOUNT" => $request->param['MPI']['FEE_AMOUNT']
                    ]
                ];
                break;

            case '9':
                $data = [
                    "MPI" => [
                        "MERCHANT_ID" => $request->param['MPI']['MERCHANT_ID'],
                        "AMOUNT" => $request->param['MPI']['AMOUNT'],
                        "FEE_AMOUNT_PERCENTAGE" => $request->param['MPI']['FEE_AMOUNT_PERCENTAGE']
                    ]
                ];
                break;

            default:
                $data = [];
                break;
        }

        Log::channel('apilog')->info('REQ SEND API : ' .  json_encode($data));

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post(
            'http://192.168.26.75:9800/v1/api/aquerier/create/qr',
            $data
        );

        Log::channel('apilog')->info('RESP SEND API : ' . json_encode($response->json()));

        $qris = ($response['MPO']['QRIS']);
        $qrcode = QrCode::size(400)->generate($qris);

        $res = $response->json();
        $res['QR'] = base64_encode($qrcode);

        Log::channel('apilog')->info('RESP : ' . json_encode($res));

        return response()->json($res);
    }







    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function hit(Request $request)
    {
        Log::channel('newlog')->info('req : ' .$request);
        // dd($request);
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
        ])->post('http://192.168.26.75:9800/v1/api/aquerier/create/qr', 
            $data
        );

        


        Log::channel('newlog')->info('resp api : ' .$response);

        $qris = ($response['MPO']['QRIS']);
        $combine =  base64_encode(QrCode::size(200)->generate($qris));
      

        return response()->json([
            'data'    => $response['MPO']['QRIS'],
            'qr' => $combine,
         
        ]);
        
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function mergeImg()
    {
       

        // $qrcode = QrCode::size(400)->generate($examp);
        $examp ='adam';
        $qrcodes = QrCode::format('png')->generate($examp);

        dd($qrcode);

        $wmQris = Image::make('images/qris.png');
        $wmQris->resize(100, 50);

        $canvas = Image::canvas(500, 500);

        $canvas->insert($qrcodes, 'center' );
        $canvas->insert($wmQris, 'top' );

        // $canvas->insert('images/qris.png', 'bottom-right', 10, 10);

        $canvas->save('images/hasil.jpg');

        return Image::make($canvas)->response();
        
    }

    
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
