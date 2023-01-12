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

    public function hit(Request $request)
    {
        // Log::channel('weblog')->info('req : ' . $request);
        $data = $request->toArray();

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

        $response = Http::timeout(10)->withHeaders([
            'Authorization' => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiN2EyODkzM2VjZWFjYmJhNTBkYzM2YzQ5NGY2YzNhMDcwN2Q0OGQ5NDE5ZGVhYWRmZWU4NzFhMDkwYzdiMDFjMWQ2ZGYyY2E0OGMyZjQ0NjciLCJpYXQiOjE2NzM0MDg2NTYsIm5iZiI6MTY3MzQwODY1NiwiZXhwIjoxNjczNDEyMjU2LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.aBWwDQdpnWOvzKgAgGswD6p7ND1KlCSHRbGLzVoE164TDt-TFaT2tBzjJQuTrYCBFiNZU-UuwA1Mvtv3iDmv77vc6x1k3g9qp2ABlN2uzTVJ93TKvxVG3JDsrDQHrDd1RQfzMFHAPUSltrPGZJASolq5HnzwdBDk04z9-BqI3TgDHmKsubHH31tPCww1B-rvQIeEMe6DUYAnPB1TIP4KWG8ZkBO4UtIf97Nw05tESz-b7d8Q62-eKceLJS4VJ--m2_6jK9pK9iGPNU2KmfCbtVvi13zCfuEnfiGAQl7_-4ynU4Z2WCTUeal-aL6f6DS_R4tk7Vjw_zBuWF2wFoV1aMAl2lUs8T8copXvhQbskbNdoCdXj1_ZLf_gF8VFvZ8ECnhTx1mZfQqW26jfLtpDBeLYht4X5lIpjdlvgSQ_TizMILQdGRm1W6uTh7o-UxHsdfBoaVtenfLjOHC6caPCunZBjBL4LnGtBkWt91RHoFGEnJjX8ot4dVAaqlNNwBl3Vk4wTIU54j1BewMRhH4PMjJrJMnZgtDxORHdTXd-7UUWwDZATlwUzfnMwb0bz0U4OIaSKnHoWoPzfVZHgXjUZ6pPutiFMgqoGoRzlk_kikDBwLHFmPh3Z8hEyryydanoaUxaL5KoGNDdvxBUv-8jwUSmPUTRymTbNGEbWvndwLE',
            'Content-Type' => 'application/json',
        ])->post(
            'http://127.0.0.1:8000/api/qris',
            $data
        );
        dd($response->json());

        // Log::channel('weblog')->info('resp : ' . $response);

        return response()->json([
            'data'    => $response,
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
