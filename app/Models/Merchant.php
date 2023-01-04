<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class Merchant extends Model
{
    // protected $connection = 'mysql2';
    // protected $table = 'QRIS_MERCHANT';
    protected $table = 'qris_merchant_2';
    
   

    /**
     * The attributes that are mass assignable.
     *	
     * @var array
     */
    protected $fillable = [
        'ID',
        'CREATED_AT',
        'UPDATED_AT',
        'TERMINAL_LABEL',
        'MERCHANT_COUNTRY',
        'QRIS_MERCHANT_DOMESTIC_ID',
        'TYPE_QR',
        'MERCHANT_NAME',
        'MERCHANT_CITY',
        'POSTAL_CODE',
        'MERCHANT_CURRENCY_CODE',
        'MERCHANT_TYPE',
        'MERCHANT_ID',
        'REKENING_NUMBER',
        'CATEGORY',
        'CRITERIA',
        'STATUS',
        'MERCHANT_ADDRESS'
    ];
    
}