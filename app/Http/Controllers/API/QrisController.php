<?php

namespace App\Http\Controllers\API;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

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

        

        // $image1 = storage_path('images\qris.png');
        // $image2 = QrCode::size(400)->generate($qris);
        $combine = base64_encode(QrCode::format('png')->merge('\storage\images\qris.png')->generate($qris));
        
        // // dd($image1);
        // list($width,$height) = getimagesize($image1);

        // $image1 = imagecreatefrompng($image1);
        // $image2 = imagecreatefromjpeg($image2);
        
        // imagecopymerge($image1,$image2,40,100,0,0,$width,$height,100);
        // header('Content-Type:image/jpg');
        // imagepng($image1);
        
        // imagepng($image1,'merged.png');
        // $masterImg = imagepng($image1,'merged.png');

        // $combine =  base64_encode(QrCode::size(200)->generate($qris));
      

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
    public function update()
    {
        //
    }

    public function mergeImg()
    {
        $image1 = storage_path('images\qris.png');
        $image2 = public_path('images\qris2.jpg');

        list($width,$height) = getimagesize($image2);

        $image1 = imagecreatefromstring(file_get_contents($image1));
        $image2 = imagecreatefromstring(file_get_contents($image2));

        // imagecopymerge($image1,$image2,100,100,200,200,$width,$height,150);
        imagecopymerge($image1, $image2, 100, 100 , 0, 0, 200 , 200 , 100);
        header('Content-Type:image/jpg');
        imagepng($image1);

        $masterImg = imagejpeg($image1,'merged.png');

        dd($masterImg);
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
