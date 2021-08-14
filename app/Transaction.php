<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'ip','nama','alamat','email','total_harga','catatan','nomor','kode'
    ];
}
