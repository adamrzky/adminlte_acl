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

        $qris = $response['MPO']['QRIS'];
        $qrcode = QrCode::size(400)->generate($qris);

        $res = $response->json();
        // $detail = $this->parsingQrCodeASPI($qris);
        // $res['MPO']['NNS'] = base64_encode($qrcode);
        // $res['MPO']['NMID'] = base64_encode($qrcode);
        $res['MPO']['QR'] = base64_encode($qrcode);

        Log::channel('apilog')->info('RESP : ' . json_encode($res));

        return response()->json($res);
    }

    private function parsingQrCodeASPI($qris, $pIsNested = true)
    {
        while (strlen($qris) > 0) {
            //Get Data ID
            $tID = substr($qris, 0, 2);
            $tIDKey = intval($tID);
            $qris = substr($qris, 2);

            //Get Data Length
            $tLengthData = substr($qris, 0, 2);
            $qris = substr($qris, 2);

            // //Get Data Value
            $tLengthDataInt = intval($tLengthData);
            $tValue = substr($qris, 0, $tLengthDataInt);
            $qris = substr($qris, $tLengthDataInt);

            $additional = ['26', '27', '28', '29', '30', '31', '32', '33', '34', '35', '36', '37', '38', '39', '40', '41', '42', '43', '44', '45', '51', '62'];
            if (in_array($tIDKey, $additional) && $pIsNested) {
                // tResult . put(tIDKey, parsingQrCodeASPI(tValue, false));
                $tResult[$tIDKey] = $this->parsingQrCodeASPI($tValue, false);
            } else {
                $tResult[$tIDKey] = $tValue;
            }
        }

        return $tResult;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function hit(Request $request)
    {
        Log::channel('newlog')->info('req : ' . $request);
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
        ])->post(
            'http://192.168.26.75:9800/v1/api/aquerier/create/qr',
            $data
        );



        Log::channel('newlog')->info('resp api : ' . $response);


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
        $logo_file = storage_path('images\qris.png');
        $image_file = storage_path('images\qris2.jpg');
        $targetfile = storage_path('images\img2.png');
        $photo = imagecreatefromjpeg($image_file);
        $fotoW = imagesx($photo);
        $fotoH = imagesy($photo);
        $logoImage = imagecreatefrompng($logo_file);
        $logoW = imagesx($logoImage);
        $logoH = imagesy($logoImage);
        $photoFrame = imagecreatetruecolor($fotoW, $fotoH);
        $dest_x = $fotoW - $logoW;
        $dest_y = $fotoH - $logoH;
        imagecopyresampled($photoFrame, $photo, 0, 0, 0, 0, $fotoW, $fotoH, $fotoW, $fotoH);
        imagecopy($photoFrame, $logoImage, $dest_x, $dest_y, 0, 0, $logoW, $logoH);
        imagejpeg($photoFrame, $targetfile);
        echo '<img src="' . $targetfile . '" />';
        die;
       

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
