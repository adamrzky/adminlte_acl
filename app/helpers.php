<?php

use Illuminate\Support\Facades\Http;

function genID($len = 13, $alfanumeric = false)
{
    $digits = '';
    if ($alfanumeric) {
        // $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $permitted_chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        $digits = substr(str_shuffle($permitted_chars), 0, $len);
    } else {
        for ($i = 0; $i < $len; $i++) {
            $digits .= rand(0, 9);
        }
    }
    return $digits;
}

function getCriteria()
{
    $criteria = [
        [
            'id' => 'UMI',
            'desc' => 'Usaha Mikro'
        ],
        [
            'id' => 'UKE',
            'desc' => 'Usaha Kecil'
        ],
        [
            'id' => 'UME',
            'desc' => 'Usaha Menengah'
        ],
        [
            'id' => 'UBE',
            'desc' => 'Usaha Besar'
        ]
    ];

    return $criteria;
}

function getWilayah($prov = '', $negara = 'ID')
{
    $url = 'http://192.168.26.26:10002/api.php?negara=' . $negara . '&prov=' . $prov;
    $response = Http::get($url);

    return $response->json();
}
