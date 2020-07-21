<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    //
    protected $table = 'transaksis';
	protected $primaryKey = 'id';

	public function user() {
        return $this->belongsTo('App\User', 'user_id', 'id');
	}

}
