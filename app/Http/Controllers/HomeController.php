<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Keranjang;
use App\Models\Order;
use App\Models\Transaksi;
use App\Models\Bank;
use App\User;
use App\Models\Pengiriman;
use App\Models\Province;
use App\Models\City;
use App\Models\Courier;
use App\Models\CustomKategori;
use Kavist\RajaOngkir\Facades\RajaOngkir;
use stdClass;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Stmt\TryCatch;

class HomeController extends Controller
{
    //
    public function index()
    {
		$dataBarang = Product::where('status_aktif', 1)
		->where('kategori_id', 1)
		->orderBy('created_at', 'desc')
		->paginate(8);
		
		return view('web.home.index')->with(compact('dataBarang'));

		
	}

	public function detail($id)
    {
		$dataBarang = Product::where('id', $id)->first();
		return view('web.detail.index')->with(compact('dataBarang'));
	}

	public function custom(Request $request)
    {
		$dataCustom = CustomKategori::all();
		return view('web.custom.index')->with(compact('dataCustom'));
	}

	public function customCheckout(Request $request)
    {
		$messages = [
			'required' => 'Please fill the field',
		];

		$this->validate($request,[
			'jumlah_qty' => 'required',
			'note' => 'required',
			'photo' => 'required|mimes:jpeg,bmp,png,svg',
		], $messages);

		$dataCustom = $request->all();
		// dd($dataCustom);
		$couriers = Courier::pluck('title', 'code');
		$provinces = Province::pluck('title', 'province_id');
		$dataUser = User::where('id', Auth::user()->id)->first();
		
		$cekTransaksi =  Transaksi::where('status_order', '1')->count();
		// dd($cekTransaksi+1);
		if(!$cekTransaksi){
			$kodeBelakang = 1;
		}else{
			$kodeBelakang = $cekTransaksi+1;
		}
		$kodeDepan = 'Custom - '.$kodeBelakang ;
		// dd($kodeDepan);
		

		$item_details = array();
		$data = new stdClass();
		$data->qty = $dataCustom['jumlah_qty'];
		$data->note = $dataCustom['note'];
		$data->photo = $dataCustom['photo'];
		$data->custom_id = $dataCustom['custom_id'];

		
		// $request->session()->put('qty', $dataCustom['jumlah_qty']);
		// $request->session()->put('note', $dataCustom['note']);
		// $request->session()->put('custom_id', $dataCustom['custom_id']);

		if ($request->hasFile('photo')) {
			// menyimpan data file yang diupload ke variabel $file
			$file = $request->file('photo');
			// $nama_file = $file->getClientOriginalName();
			$nama_file = 'Custom-'.$dataUser->nama_depan.'-'.$file->getClientOriginalName();
			$tujuan_upload = 'template/web/img/customOrder/';
			$foto = $nama_file;
			$path = $file->move($tujuan_upload,$nama_file);
			$data->nama_foto = $foto;
			// $request->session()->put('photo', $foto);
		} 
		$data->kodeDepan = $kodeDepan;
		array_push($item_details, $data);
		
		
		return view('web.custom.checkout')->with(compact('couriers', 'provinces', 'dataUser','dataCustom', 'item_details'));
	}

	public function customInvoice(Request $request)
    {	
		// dd($request->session()->all());

		// dd($request->all());
		// if(has($messages)){
		// 	return Redirect::back()->withErrors(['$messages', $messages]);
		// }

		$dataItem = $request->all();
		$berat= 100;
		// dd($dataItem);
		$custom = CustomKategori::where('id', $dataItem['custom_id'])->first();
		$total = $dataItem['qty'] * $custom['harga'];
		// dd($custom);
		// $request->session()->put('Provinsi',$request->province_destination);
		
		$kota_asal=$request->city_origin;
		$provinsi = $request->province_destination;
		$kota_tujuan=$request->city_destination;
		$kurir=$request->courier;

		$cost = RajaOngkir::ongkosKirim([
			'origin' => $request->city_origin,
			'destination' => $request->city_destination,
			'weight' => $berat,
			'courier' => $request->courier,
		])->get();

		if ($request->courier=="jne") {
			$tarif =($cost[0]["costs"][1]["cost"][0]["value"]);//jne reg
			$durasi = ($cost[0]["costs"][1]["cost"][0]["etd"]);
		} elseif($request->courier=="pos"){
			//pos
			$tarif = ($cost[0]["costs"][0]["cost"][0]["value"]);//harga
			$durasi = ($cost[0]["costs"][0]["cost"][0]["etd"]); // waktu
		}else {
			$tarif = ($cost[0]["costs"][0]["cost"][0]["value"]);
			$durasi = ($cost[0]["costs"][0]["cost"][0]["etd"]);
		}
		
		$kota_origin = City::where('city_id', $kota_asal)->first();
		$kota_destination = City::where('city_id', $kota_tujuan)->first();
		$provinsi = Province::where('id', $request->province_destination)->first();

		$request->session()->put('alamat', $dataItem['alamat']);
		$request->session()->put('qty', $dataItem['qty']);
		$request->session()->put('note', $dataItem['note']);
		$request->session()->put('nama_foto', $dataItem['nama_foto']);
		$request->session()->put('kodeDepan', $dataItem['kodeDepan']);
		$request->session()->put('custom_id', $dataItem['custom_id']);
		$request->session()->put('kurir', $kurir);
		$request->session()->put('total', $total);
		$request->session()->put('tarif', $tarif);
		$request->session()->put('durasi', $durasi);

		
		$kota_asal=$request->city_origin;
		$provinsi = $request->province_destination;
		$kota_tujuan=$request->city_destination;
		$request->session()->put('kota_asal', $kota_asal);
		$request->session()->put('provinsi', $provinsi);
		$request->session()->put('kota_tujuan', $kota_tujuan);


		
		return view('web.custom.invoice')->with(compact('tarif', 'durasi','kota_origin','kota_destination','kurir', 'dataItem', 'custom', 'total'));
	}

	public function custompayment(Request $request)
    {
		$dataSession = $request->session()->all();
		$kodeDepan = $dataSession['kodeDepan'];
		// dd($dataSession);
		$dataBank = Bank::all();
		
		return view('web.custom.payment')->with(compact('kodeDepan','dataBank'));
	}

	public function customsavepayment(Request $request)
    {
		// save item
		$dataSession = $request->session()->all();
		// dd($dataSession);
		$dataSum = $dataSession['total'];
		$alamat = $dataSession['alamat'];
		$hapusString = substr($dataSum, 0);
		// dd($dataSession);

		$messages = [
			'not_in'    => 'Pilih terlebih dahulu'
        ];

        $this->validate($request,[
            'data_bank' => 'required|not_in:0',
		], $messages);

		// transaksi
		$dataTransaksi = new Transaksi;
		$dataTransaksi->user_id = Auth::user()->id;
		$dataTransaksi->kd_transaksi = $dataSession['kodeDepan'];
		$dataTransaksi->total = $hapusString +  $dataSession['tarif'];
		$dataTransaksi->nama_bank = $request->data_bank;
		$dataTransaksi->status_pembayaran = 1;
		$dataTransaksi->alamat = $alamat;
		$dataTransaksi->created_at = Date("Y-m-d H:i:s", time()+60*60*7);
		$dataTransaksi->updated_at = null;
		$dataTransaksi->status_order = 1;

		if ($request->hasFile('bukti_foto')) {
                // menyimpan data file yang diupload ke variabel $file
                $file = $request->file('bukti_foto');
				$nama_file = $file->getClientOriginalName();
				
				$tujuan_upload = 'template/web/img/bukti_pembayaran/';
				
                $path = $file->move($tujuan_upload,$nama_file);
				
				$dataTransaksi->bukti_foto = $nama_file;
		}
		// dd($data);
		$dataTransaksi->save();
		// end transaksi

		// barang
		$data = new Product;
		$namabrg = explode('.', $dataSession['nama_foto']);
		// dd($namabrg['0']);
		$data->nama_barang = $namabrg['0'];
		$data->kategori_id = 2;
		$kategoriCustom = CustomKategori::where('id', $dataSession['custom_id'])->first();
		$data->harga = $kategoriCustom['harga'];
		$data->foto = $dataSession['nama_foto'];	
		$data->deskripsi = "Custom - " .$kategoriCustom['nama_kategori'];
		$data->berat = 100;
		$data->stok = $dataSession['qty'];
		$data->status_aktif = 0;
		$data->save();
		// end barang

		// tbpengiriman
		$kota_origin = City::where('city_id', $dataSession['qty'])->first();
		$provinsi = Province::where('id', $dataSession['qty'])->first();
		$kota_destination = City::where('city_id', $dataSession['qty'])->first();

		$dataPengiriman = new pengiriman;
		$dataPengiriman->id_transaksi = $dataTransaksi->id;
		$dataPengiriman->kota_asal = $kota_origin['title'];
		$dataPengiriman->provinsi_tujuan = $provinsi['title'];
		// dd($dataPengiriman->provinsi_tujuan);
		$dataPengiriman->kota_tujuan = $kota_destination['title'];
		$dataPengiriman->nama_kurir = $dataSession['kurir'];
		$totalBerat =  $dataSession['qty'] * 100;
		$dataPengiriman->total_berat = $totalBerat;
		$dataPengiriman->ongkir = $dataSession['tarif'];
		$dataPengiriman->estimasi = $dataSession['durasi'];
		// dd($dataPengiriman);
		$dataPengiriman->save();
		
		// tbproduk
		// $order_items = Keranjang::where('user_id', '=', Auth::user()->id )->get();
        // foreach ($order_items as $k => $v) 
        // {
			$dataOrder = new Order;
			$dataOrder->transaksi_id = $dataTransaksi->id;
			$dataOrder->barang_id = $data->id;
			$dataOrder->qty = $dataSession['qty'];
			$dataOrder->harga = $kategoriCustom['harga'];
			$totalHarga =  $dataSession['qty'] * $kategoriCustom['harga'];
			$dataOrder->total = $totalHarga;
			$dataOrder->ukuran =$dataSession['note'];
			$dataOrder->total_berat = $totalBerat;
			$dataOrder->custom_design = '1';
			$dataOrder->save();
		// }
		
		// Keranjang::where('user_id', Auth::user()->id)->delete();

		return redirect('historypembelian')->with('flash_message','Tunggu Konfirmasi Admin');

	}

	public function cart(Request $request)
	{

		if ( Auth::check() ) {
			$dataKeranjang = Keranjang::where('user_id', Auth::user()->id)->get();
			if(!$dataKeranjang){
				$countKeranjang = 0;
				$dataSum = 0;
			}else{
				$countKeranjang = $dataKeranjang->count();
				$dataSum = Keranjang::where('user_id', Auth::user()->id)->sum('total');
				$dataqty = Keranjang::where('user_id', Auth::user()->id)->sum('qty');
				$databrt = Keranjang::where('user_id', Auth::user()->id)->sum('total_berat');
			}
			$request->session()->put('dataSum', $dataSum);
			$request->session()->put('dataqty', $dataqty);
			$request->session()->put('databerat', $databrt);
			
			// dd($databrt);
			return view('web.cart.index')->with(compact('dataKeranjang','countKeranjang','dataSum'));

		}else{

			return view('web.errors.404');

		}
	}

	public function savecart(Request $request)
	{
		$messages = [
            // 'required' => 'Field :attribute wajib',
        ];
		// dd($request->all());	
        $this->validate($request,[
			'ukuran' => 'required|not_in:0',
			'jumlah_qty' => 'required|integer',
		], $messages);

		// $v->sometimes('reason', 'required|max:500', function ($input) {
		// 	return $input->games >= 100;
		// });

		$id = $request->id_barang;
		$dataBarang = Product::where('id', $id)->first();

		$cekDataKeranjang = Keranjang::where('barang_id', $request->id_barang)->where('ukuran', $request->ukuran)->where('user_id', Auth::user()->id)->first();

		$berat = $dataBarang->berat;
		$qty = $request->jumlah_qty;
		$totalBerat = $berat * $qty;
		// dd($totalBerat);
		if(!$cekDataKeranjang){

			$data = new Keranjang;
			$data->barang_id = $dataBarang->id;
			$data->user_id = Auth::user()->id;
			$data->qty = $qty;
			$data->harga = $dataBarang->harga;
			$data->total = $data->qty*$data->harga;
			$data->ukuran = $request->ukuran;
			$data->total_berat = $totalBerat;
			$data->note = $request->note;
			$data->save();
			// dd('save baru');
		}else{
			$data = Keranjang::where('barang_id', $request->id_barang)->where('ukuran', $request->ukuran)->where('user_id', Auth::user()->id)->first();
			// dd($data);
			$dataStok = Product::where('id', $request->id_barang)->first();
			$data->barang_id = $dataBarang->id;
			$totalQty = $data->qty+$request->jumlah_qty;
			if($totalQty > $dataStok->stok) {
				return redirect('cart')->with('flash_message','Order melebihi stok yang tersedia, silahkan hubungi marketing.');
			} else {
				$data->qty = $totalQty;
				$data->total = $data->qty*$data->harga;
				$data->note = $request->note;
				$data->save();
			}
			// dd('ubah qty');

		}

		return redirect('cart')->with('flash_message','Data Berhasil Ditambah');

	}

	public function editcart(Request $request, $id)
	{
		// finish
		$data = Keranjang::where('id', $id)->first();
		$dataProduk = Product::where('id', $data->barang_id)->first();
		// dd($dataProduk);
		$qtyBaru = $request->updateqty;
		if($qtyBaru > $dataProduk->stok) {
			return redirect('cart')->with('flash_message','Order melebihi stok yang tersedia, silahkan hubungi marketing.');
		}else {
			$data->qty = $qtyBaru;
			$data->total_berat = $request->updateqty * $dataProduk->berat;
			$data->total = $data->qty*$data->harga;
			// dd($dataProduk);
			$data->save();
	
			return redirect('cart')->with('flash_message','Data Berhasil Diubah');
		}
	}

	public function deletecart($id)
	{
        // hapus data
        Keranjang::where('id',$id)->delete();
    
        return redirect('cart')->with('flash_message','Data Berhasil Didelete');
	}
	
	public function historypembelian()
	{

		if ( Auth::check() ) {
			$dataTransaksi = Transaksi::where('user_id', Auth::user()->id)->get();

			if(!$dataTransaksi){
				$countTransaksi = 0;
			}else{
				$countTransaksi = $dataTransaksi->count();
			}
	
			return view('web.historypembelian.index')->with(compact('dataTransaksi','countTransaksi'));

		}else{

			return view('web.errors.404');

		}

	}

	public function viewhistory($id)
	{
		if ( Auth::check() ) {
			$dataOrder = Order::where('transaksi_id', $id)->get();
				if($dataOrder['0']['custom_design'] == 1) {
					$dataOrder = Order::where('transaksi_id', $id)->first();
					$dataProduk = Product::where('id', $dataOrder['barang_id'])->first();
					$dataTransaksi = Transaksi::where('id', $id)->first();

					$dataPengiriman = Pengiriman::where('id_transaksi', $id)->first();
					if(!$dataOrder){
						$countOrder = 0;
					}else{
						$countOrder = $dataOrder->count();
						$dataSum = Order::where('transaksi_id', $id)->sum('total');
					}
					return view('web.historypembelian.view')->with(compact('dataOrder','countOrder', 'dataPengiriman', 'dataSum', 'dataProduk', 'dataTransaksi'));
				}
			// dd(empty($dataOrder['custom_design']));
			$dataPengiriman = Pengiriman::where('id_transaksi', $id)->first();
				if(!$dataOrder){
					$countOrder = 0;
				}else{
					$countOrder = $dataOrder->count();
					$dataSum = Order::where('transaksi_id', $id)->sum('total');
				}
			// dd($dataPengiriman->resi_pengiriman);
			return view('web.historypembelian.view')->with(compact('dataOrder','countOrder', 'dataPengiriman', 'dataSum'));
		}else{
			return view('web.errors.404');

		}
	}
		
	public function invoice(Request $request)
	{
		
		$dataSession = $request->session()->all();
		$dataSum = $dataSession['dataSum'];
		// dd($dataSession);
		// $cekTransaksi = Order::where('custom_design', '0')
		// ->groupBy('transaksi_id')
		// ->count();
		$cekTransaksi = Transaksi::where('status_order', '1')
		->count();
		// dd($cekTransaksi+1);
		if(!$cekTransaksi){
			$kodeBelakang = 1;
		}else{
			$kodeBelakang = $cekTransaksi+1;
		}
		$kodeDepan = 'KDTR - '.$kodeBelakang ;
		$request->session()->put('kodeDepan', $kodeDepan);
		$data = Keranjang::where('user_id', Auth::user()->id)->get();

		$couriers = Courier::pluck('title', 'code');
		$provinces = Province::pluck('title', 'province_id');

		$dataUser = User::where('id', Auth::user()->id)->first();
		// dd($dataUser);
		// $city = City::pluck('title', 'id');
		// dd($data);

		// dd($dataSum);

		return view('web.invoice.index')->with(compact('kodeDepan','data','dataSum', 'couriers', 'provinces', 'dataUser'));
	}

	public function getCities($id)
	{
		$city = City::where('province_id', $id)->pluck('title', 'city_id');
		// dd($city);
		return json_encode($city);
	}

	public function submit(Request $request)
	{	
		// dd($request->all());
		$messages = [
			'required' => 'Harap Diisi',
			'alamat.min' => 'Alamat Minimal 25 Karakter',
			'nama_penerima.regex' => 'Hanya Boleh Huruf'
		];

		$this->validate($request,[
			'province_destination' => 'required',
			'city_destination' => 'required',
			'courier' => 'required',
			'nama_penerima' => 'required|regex:/^[\pL\s\-]+$/u',
			'alamat' => 'required|min:25',
		], $messages);

		$dataSession = $request->session()->all();
		$dataSum = $dataSession['dataSum'];
		$kodeDepan = $dataSession['kodeDepan'];
		// $qty = $dataSession['dataqty'];
		$berat= $dataSession['databerat'];
		
		// dd($request);
		// $city_origin,$city_destination,$weight,$courier
		$request->session()->put('Provinsi',$request->province_destination);
		
		$kota_asal=$request->city_origin;
		$kota_tujuan=$request->city_destination;
		$kurir=$request->courier;
		// $courier="tiki";
		// dd($dataSum);
		$cost = RajaOngkir::ongkosKirim([
			'origin' => $request->city_origin,
			'destination' => $request->city_destination,
			'weight' => $berat,
			'courier' => $request->courier,
		])->get();

		if ($request->courier=="jne") {
			$tarif =($cost[0]["costs"][1]["cost"][0]["value"]);//jne reg
			$durasi = ($cost[0]["costs"][1]["cost"][0]["etd"]);
		} elseif($request->courier=="pos"){
			//pos
			$tarif = ($cost[0]["costs"][0]["cost"][0]["value"]);//harga
			$durasi = ($cost[0]["costs"][0]["cost"][0]["etd"]); // waktu
		}else {
			$tarif = ($cost[0]["costs"][0]["cost"][0]["value"]);
			$durasi = ($cost[0]["costs"][0]["cost"][0]["etd"]);
		}
		
		$kota_origin = City::where('city_id', $kota_asal)->first();
		$kota_destination = City::where('city_id', $kota_tujuan)->first();
		$provinsi = Province::where('id', $request->province_destination)->first();
		// dd($provinsi);
		// $kotaAsal = $kota_origin->title;
		// dd($kota_destination->title);
		// dd($kota_origin->title);

		// dd($cost);


		if ( Auth::check() ) {
			$dataKeranjang = Keranjang::where('user_id', Auth::user()->id)->get();
			if(!$dataKeranjang){
				$countKeranjang = 0;
				$dataSum = 0;
			}else{
				$countKeranjang = $dataKeranjang->count();
				$dataSum = Keranjang::where('user_id', Auth::user()->id)->sum('total');
				$dataqty = Keranjang::where('user_id', Auth::user()->id)->sum('qty');
				$databrt = Keranjang::where('user_id', Auth::user()->id)->sum('total_berat');
			}
			$alamat = $request->alamat;
			$total_final = $dataSum + $tarif;
			$kurir = $request->courier;

			$namaPenerima = $request->nama_penerima;

			$request->session()->put('dataSum', $dataSum);
			$request->session()->put('dataqty', $dataqty);
			$request->session()->put('databerat', $databrt);
			$request->session()->put('alamat', $alamat);
			$request->session()->put('totalfinal', $total_final);
			// tbpengiriman
			$request->session()->put('namaPenerima', $namaPenerima);
			$request->session()->put('kotaAsal', $kota_origin->title);
			$request->session()->put('kotaTujuan', $kota_destination->title);
			$request->session()->put('provinsi', $provinsi->title);
			$request->session()->put('kurir', $kurir);
			$request->session()->put('tarif', $tarif);
			$request->session()->put('estimasi', $durasi);
			$request->session()->put('totalberat', $berat);
		}
		return view('web.invoice.invoice')->with(compact('dataSession', 'tarif', 'durasi','kota_origin','kota_destination','kurir', 'countKeranjang', 'dataKeranjang', 'dataSum', 'alamat', 'total_final'));
	}
		
	public function payment(Request $request)
    {
		$dataSession = $request->session()->all();
		$kodeDepan = $dataSession['kodeDepan'];

		$dataBank = Bank::all();
		
		return view('web.payment.index')->with(compact('kodeDepan','dataBank'));
	}

	public function savepayment(Request $request)
    {
		// save item
		$dataSession = $request->session()->all();
		$dataSum = $dataSession['totalfinal'];
		$alamat = $dataSession['alamat'];
		$hapusString = substr($dataSum, 0);
		// dd($dataSession);

		$messages = [
			'not_in'    => 'Pilih terlebih dahulu'
        ];

        $this->validate($request,[
            'data_bank' => 'required|not_in:0',
		], $messages);

		$data = new Transaksi;
		$data->user_id = Auth::user()->id;
		$data->kd_transaksi = $dataSession['kodeDepan'];
		$data->total = $hapusString;
		$data->nama_bank = $request->data_bank;
		$data->status_pembayaran = 1;
		$data->alamat = $alamat;
		$data->created_at = Date("Y-m-d H:i:s", time()+60*60*7);
		$data->updated_at = null;
		$data->status_order = 0;

		if ($request->hasFile('bukti_foto')) {
                // menyimpan data file yang diupload ke variabel $file
                $file = $request->file('bukti_foto');
				$nama_file = $file->getClientOriginalName();
				
				$tujuan_upload = 'template/web/img/bukti_pembayaran/';
				
                $path = $file->move($tujuan_upload,$nama_file);
				
				$data->bukti_foto = $nama_file;
		}

		// dd($data);
		$data->save();

		// tbpengiriman
		$dataPengiriman = new pengiriman;
		$dataPengiriman->id_transaksi = $data->id;
		$dataPengiriman->kota_asal = $dataSession['kotaAsal'];
		$dataPengiriman->provinsi_tujuan = $dataSession['provinsi'];
		// dd($dataPengiriman->provinsi_tujuan);
		$dataPengiriman->kota_tujuan = $dataSession['kotaTujuan'];
		$dataPengiriman->nama_kurir = $dataSession['kurir'];
		$dataPengiriman->total_berat = $dataSession['totalberat'];
		$dataPengiriman->ongkir = $dataSession['tarif'];
		$dataPengiriman->estimasi = $dataSession['estimasi'];
		// dd($dataPengiriman);
		$dataPengiriman->save();
		
		// tbproduk
		$order_items = Keranjang::where('user_id', '=', Auth::user()->id )->get()->toArray();
        foreach ($order_items as $k => $v) 
        {
			$dataOrder[$k] = new Order;
			$dataOrder[$k]->transaksi_id = $data->id;
			$dataOrder[$k]->barang_id = $v['barang_id'];
			$dataOrder[$k]->qty = $v['qty'];
			$dataOrder[$k]->harga = $v['harga'];
			$dataOrder[$k]->total = $v['total'];
			$dataOrder[$k]->created_at = $v['created_at'];
			$dataOrder[$k]->updated_at = $v['updated_at'];
			$dataOrder[$k]->ukuran = $v['ukuran'];
			$dataOrder[$k]->total_berat = $v['total_berat'];
			$dataOrder[$k]->note = $v['note'];
			$dataOrder[$k]->save();
		}
		
		Keranjang::where('user_id', Auth::user()->id)->delete();

		return redirect('historypembelian')->with('flash_message','Tunggu Konfirmasi Admin');

	}
	
	public function login()
    {
		return view('web.login.index');
	}

	public function postlogin(Request $request)
    {
		$email = $request->email;
		$password = $request->password;
        Auth::attempt(['email' => $email, 'password' => $password]);
        if ( Auth::check() ) {
			if(Auth::user()->modul_name == 0){
				return redirect('/')->with('flash_message','Login Berhasil');
			}else{
				Auth::logout();
				return redirect('login')->with('flash_message_error','Email atau Password salah');
			}
        }else {
			return redirect('login')->with('flash_message_error','Email atau Password salah');
        }
	}

	public function logout()
    {
		Auth::logout();
        return redirect('/')->with('flash_message','Logout');
	}

	public function registrasi()
    {
		return view('web.registrasi.index');
	}

	public function postregistrasi(Request $request)
    {
		$messages = [
			'required' => 'Please fill the field',
			'unique'    => 'Email is already in use',
			'password_confirmation.same' => 'Password Confirmation should match the Password',
		];

		$this->validate($request,[
			'first_name' => 'required|regex:/^[\pL\s\-]+$/u',
			'last_name' => 'required|regex:/^[\pL\s\-]+$/u',
			'email' => 'required|unique:users,email',
			'no_hp' => 'required|max:14',
			'password' => 'required|min:8',
			'confirm_password' => 'required|min:8|same:password',
			'address' => 'required|min:25',
		], $messages);

		$data =  new User();
		$data->modul_name = 0;
		$data->nama_depan = $request->first_name;
		$data->nama_belakang = $request->last_name;
		$data->email = $request->email;
		$data->no_hp = $request->no_hp;
		$data->password = bcrypt($request->password);
		$data->alamat = $request->address;
		$data->created_at = Date("Y-m-d H:i:s", time()+60*60*7);
		$data->updated_at = null;
		$data->save();

		return redirect('login')->with('flash_message','Registrasi Berhasil, Silahkan Login !');
	}
}
