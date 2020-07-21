<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengiriman extends Model
{
    // //
    // /**
    //  * The attributes that are mass assignable.
    //  *
    //  * @var array
    //  */
    // protected $fillable = [
    //     'id_transaksi', 'kota_asal','provinsi_tujuan', 'kota_tujuan', 'nama_kurir', 'total_berat','ongkir', 'estimasi'
    // ];

    // /**
    //  * The attributes that should be hidden for arrays.
    //  *
    //  * @var array
    //  */
    // protected $hidden = [
    
    // ];
    
    // protected $table = "pengirimen";
    
    protected $table = 'pengirimen';
	protected $primaryKey = 'id';


}
