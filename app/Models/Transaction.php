<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class Transaction extends Model
{
    protected $table = 'qris_transaction_aquerier_main';
    /**
     * The attributes that are mass assignable.
     *	
     * @var array
     */
    protected $fillable = [
        'MERCHANT_ID',
        'AMOUNT_TIP_PERCENTAGE',
        'AMOUNT',
        'EXPIRE_DATE_TIME',
        'CREATED_AT',
        'UPDATED_AT',
        'TRANSACTION_ID',
        'DESCRIPTION',
        'TRANSACTION_TYPE',
        'QRIS',
        'TIP_INDICATOR',
        'FEE_AMOUNT',
        'STATUS',
        'STATUS_TRANSFER',
        'POSTAL_CODE',
        'AMOUNT_REFUND',
        'RETRIEVAL_REFERENCE_NUMBER'

    ];
}