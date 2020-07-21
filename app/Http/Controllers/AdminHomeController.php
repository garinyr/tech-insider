<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Models\Product;
use App\Models\Bank;
use App\Models\Pengiriman;
use App\Models\Usermodel;
use App\Models\Transaksi;
use App\Models\Order;
use App\Models\CustomKategori;
use Mail;

class AdminHomeController extends Controller
{
    //
    public function home(Request $request)
    {
        $posttahun = $request->tahun;   

        if($posttahun == ''){
            $datatahun = '2019';
        }else{
            $datatahun = $posttahun;
        }

        return view('admin.home.index')->with(compact('datatahun'));
	}
	
    public function login()
    {
	  	return view('admin.login.index');
	}
	
    public function ceklogin(Request $request)
    {
        $email = $request->email;
		$password = $request->password;
		// $data = user::where('email', $email)->first();
		// $data->password = $password;
		// $data->password = hash::make($password);
		// $data->save;
		// dd($data);
		
		// dd($data->password);
        Auth::attempt(['email' => $email, 'password' => $password]);
        if ( Auth::check() ) {
			if(Auth::user()->modul_name == 1){
				return redirect('/admin/dashboard')->with('flash_message','Login Berhasil');
			}else{
				Auth::logout();
				return redirect('admin/login')->with('flash_message_error','Maaf Anda Bukan Admin');
			}
        }else {
			return redirect('admin/login')->with('flash_message_error','Email atau Password salah');
        }
	}
	
	public function reset()
    {
		$data = User::where('id', 3)->first();
		$data->password = bcrypt('123');
		$data->save();
		dd('berhasil');
	}

    public function logout()
    {
        Auth::logout();
        return redirect('admin/login');

	}
	
    public function product()
    {
        $dataProduct = Product::orderBy('id', 'asc')->get();
	  	return view('admin.product.index')->with(compact('dataProduct'));
	}
	
    public function addproduct()
    {
	  	return view('admin.product.add');
	}

	public function saveproduct(Request $request)
    {
		// $item = $request->all();
		// dd($item);
		$data = new Product;
		$data->nama_barang = $request->nama_barang;
		$data->kategori_id = 1;
		$data->harga = $request->harga;

		if ($request->hasFile('foto')) {
                // menyimpan data file yang diupload ke variabel $file
                $file = $request->file('foto');
				$nama_file = $file->getClientOriginalName();
				
				// $file = Image::make($file->getRealPath())->resize(470, 265);

                // isi dengan nama folder tempat kemana file diupload
                // $datemonth = date('Y-m');
				$tujuan_upload = 'template/web/img/product/';
				// $path = $file->save(public_path($tujuan_upload .$nama_file));
                $path = $file->move($tujuan_upload,$nama_file);

                // $datemonth = date('Y-m');
                // $file = $request->file('foto');
                // $path = $file->store('uploads/1/'.$datemonth);
                // $coba = $tujuan_upload.'/'.$nama_file;
				// dd($nama_file);
				
				$data->foto = $nama_file;
		}

		$data->deskripsi = $request->deskripsi;
		$data->berat = $request->berat;
		$data->stok = $request->stok;
		$data->status_aktif = 1;
		$data->updated_at = null;
		$data->save();

		return redirect('admin/product')->with('flash_message','Data Berhasil DiTambah');
	}

	public function editproduct($id)
    {
		$dataProduct = Product::where('id', $id)->first();
		return view('admin.product.edit')->with(compact('dataProduct'));
	}

	public function editproductsave(Request $request, $id)
    {
		$data = Product::where('id', $id)->first();
		$data->nama_barang = $request->nama_barang;
		$data->status_aktif = $request->status_aktif;
		$data->kategori_id = 1;
		$data->harga = $request->harga;

		if ($request->hasFile('foto')) {
                // menyimpan data file yang diupload ke variabel $file
                $file = $request->file('foto');
				$nama_file = $file->getClientOriginalName();
				
				// $file = Image::make($file->getRealPath())->resize(470, 265);

                // isi dengan nama folder tempat kemana file diupload
                // $datemonth = date('Y-m');
				$tujuan_upload = 'template/web/img/product/';
				// $path = $file->save(public_path($tujuan_upload .$nama_file));
                $path = $file->move($tujuan_upload,$nama_file);

                // $datemonth = date('Y-m');
                // $file = $request->file('foto');
                // $path = $file->store('uploads/1/'.$datemonth);
                // $coba = $tujuan_upload.'/'.$nama_file;
				// dd($nama_file);
				
				$data->foto = $nama_file;
		}

		$data->deskripsi = $request->deskripsi;
		$data->berat = $request->berat;
		$data->stok = $request->stok;
		$data->save();

		return redirect('admin/product')->with('flash_message','Berhasil Di perbarui');
	}
	
	public function deletebarang($id)
    {
		$data = Product::where('id', $id)->delete();
		
		return redirect('admin/product')->with('flash_message','Data Berhasil Dihapus');
		
		
	}

	// custom
	public function custom()
    {
        $dataProduct = CustomKategori::orderBy('id', 'asc')->get();
	  	return view('admin.custom.index')->with(compact('dataProduct'));
	}
	
    public function addcustom()
    {
	  	return view('admin.custom.add');
	}

	public function savecustom(Request $request)
    {
		// $item = $request->all();
		// dd($item);
		$data = new CustomKategori;
		$data->nama_kategori = $request->nama_custom;
		$data->harga = $request->harga;
		$data->save();

		return redirect('admin/custom')->with('flash_message','Data Berhasil DiTambah');
	}

	public function editcustom($id)
    {
		$dataCustom = CustomKategori::where('id', $id)->first();
		return view('admin.custom.edit')->with(compact('dataCustom'));
	}

	public function editcustomsave(Request $request, $id)
    {
		$data = CustomKategori::where('id', $id)->first();
		$data->nama_kategori = $request->nama_custom;
		$data->harga = $request->harga;
		$data->save();

		return redirect('admin/custom')->with('flash_message','Berhasil Di perbarui');
	}
	
	public function deletecustom($id)
    {
		$data = CustomKategori::where('id', $id)->delete();
		
		return redirect('admin/custom')->with('flash_message','Data Berhasil Dihapus');
		
		
	}
	// end custom

	public function bank()
    {
		$dataBank = Bank::orderBy('created_at', 'desc')->get();
	  	return view('admin.bank.index')->with(compact('dataBank'));
	}

	public function addbank()
    {
		return view('admin.bank.add');
	}

	public function savebank(Request $request)
    {
		$data = new Bank;
		$data->no_rek = $request->no_rek;
		$data->nama_bank = $request->nama_bank;
		// dd($data);
		$data->save();

		return redirect('admin/bank')->with('flash_message','Data Berhasil DiTambah');
	}

	public function editbank($id)
    {
		$dataBank = Bank::where('id', $id)->first();
		return view('admin.bank.edit')->with(compact('dataBank'));
	}

	public function editbanksave(Request $request, $id)
    {
		$data = Bank::where('id', $id)->first();
		$data->no_rek = $request->no_rek;
		$data->nama_bank = $request->nama_bank;
		$data->save();

		return redirect('admin/bank')->with('flash_message','Berhasil Di perbarui');
	}

	public function deletebank($id)
    {
		$data = Bank::where('id', $id)->delete();
		
		return redirect('admin/bank')->with('flash_message','Data Berhasil Dihapus');
		
		
	}

    public function transaksi()
    {
		$dataTransaksi = Transaksi::orderBy('id', 'asc')->get();
		// dd($dataTransaksi);
	  	return view('admin.transaksi.index')->with(compact('dataTransaksi'));
	}

	public function viewtransaksi($id)
    {
		$dataTransaksi = Transaksi::where('id', $id)->first();
		$dataPengiriman = Pengiriman::where('id_transaksi', $id)->first();
		$dataOrder = Order::where('transaksi_id', $id)->get();
		if($dataOrder['0']['custom_design'] == 1) {
			$dataOrder = Order::where('transaksi_id', $id)->first();
			$dataProduk = Product::where('id', $dataOrder['barang_id'])->first();
			$dataSum = Order::where('transaksi_id', $id)->sum('total');
			return view('admin.transaksi.detail')->with(compact('dataTransaksi', 'dataPengiriman', 'dataOrder', 'dataSum', 'dataProduk'));
		}
		else {
			// dd($dataOrder['custom_design'] == 1);
			// $dataProduk = Product::where('id', $dataOrder['barang_id'])->first();
			$dataSum = Order::where('transaksi_id', $id)->sum('total');
			// dd($dataTransaksi);
			  return view('admin.transaksi.detail')->with(compact('dataTransaksi', 'dataPengiriman', 'dataOrder', 'dataSum'));

		}
	}

	public function acctransaksi($id)
    {
		$data = Transaksi::where('id', $id)->first();
		$data->status_pembayaran = 2;
		
		$dataOrder = Order::where('transaksi_id', $id)->get();

		if($dataOrder['0']['custom_design'] == 1) {
			return redirect('admin/transaksi')->with('flash_message','Berhasil Di Approve');
		}

		foreach($dataOrder as $order){

			$barang = Product::where('id', $order->barang_id)->first();
			
			$barangGudang = $barang->stok;
			$barangLaku = $order->qty;
			$barangFinal = $barangGudang - $barangLaku;

			$barang->stok = $barangFinal;
			$barang->save();		
		}


		$contact = $data->user->email;

		// try{
		// 	Mail::send('admin.email.emailPembayaran', ['nama' => $data->user->name], function ($message) use ($contact)
		// 	{
		// 		$message->subject('Konfirmasi Pembayaran');
		// 		$message->from('suportasyifakebaya@gmail.com', 'Kebaya Asyifa');
		// 		$message->to($contact);
		// 	});

			
			$data->save();
			return redirect('admin/transaksi')->with('flash_message','Berhasil Di Approve');
		
		// }
		// catch (Exception $e){
		// return response (['status' => false,'errors' => $e->getMessage()]);

		// }

		
	}

	public function rejecttransaksi($id)
    {
		$data = Transaksi::where('id', $id)->first();
		$data->status_pembayaran = 0;
		$contact = $data->user->email;

		// try{
		// 	Mail::send('admin.email.emailReject', ['nama' => $data->user->name], function ($message) use ($contact)
		// 	{
		// 		$message->subject('Konfirmasi Penolakan Pembayaran');
		// 		$message->from('suportasyifakebaya@gmail.com', 'Kebaya Asyifa');
		// 		$message->to($contact);
		// 	});

			
			$data->save();
			return redirect('admin/transaksi')->with('flash_message_error','Berhasil Di Reject');
		
		// }
		// catch (Exception $e){
		// return response (['status' => false,'errors' => $e->getMessage()]);

		// }
		

		
	}
	
    public function user()
    {
		// $dataUser = Usermodel::where('modul_name', '0')->orderBy('created_at', 'desc')->get();
		$dataUser = Usermodel::all();
	  	return view('admin.user.index')->with(compact('dataUser'));
	}
	
	public function edituser($id)
    {
		$dataUser = user::where('id', $id)->first();
		// dd($dataUser);
		return view('admin.user.edit')->with(compact('dataUser'));
	}

	public function editusersave(Request $request, $id)
    {
		$data = User::where('id', $id)->first();
		$data->name = $request->nama_user;
		$data->email = $request->email;
		$data->no_hp = $request->hp;
		$data->alamat = $request->alamat;
		$data->modul_name = $request->status;

		$pass = $request->password;

		if($pass != null){
			$data->password = hash::make($pass);
		}
		
		$data->save();

		return redirect('admin/user')->with('flash_message','Berhasil Di perbarui');
	}
	public function saveresi(Request $request, $id)
    {
		$data = Pengiriman::where('id_transaksi', $id)->first();
		$data->resi_pengiriman = $request->no_resi;
		$dataTransaksi = Transaksi::where('id', $id)->first();
		$dataTransaksi->status_pembayaran = 3;
		$dataTransaksi->save();	
		$data->save();

		return redirect('admin/transaksi')->with('flash_message','No Resi Berhasi Di Input');
	}
}
