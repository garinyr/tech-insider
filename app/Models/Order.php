<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
	//
	public function transaksi() {
        return $this->belongsTo('App\Models\Transaksi', 'transaksi_id', 'id');
	}
	
	public function product() {
		return $this->belongsTo('App\Models\Product', 'barang_id', 'id');
		
	}

}
		