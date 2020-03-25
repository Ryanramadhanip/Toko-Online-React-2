<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\DataPengiriman;
use Auth;
class DataPengirimanController extends Controller
{
    function __construct()
    {

    }

    public function get($id_user)
    {
        return response([
            "alamat" => DataPengiriman::where("id_user", $id_user)->get()
        ]);
    }   

    public function save(Request $request)
    {
        $action = $request->action;
        if ($action == "insert") {
            try {

                $dataPengiriman = new DataPengiriman();
                $dataPengiriman->id_user = $request->id_user;
                $dataPengiriman->nama_penerima = $request->nama_penerima;
                $dataPengiriman->jalan = $request->jalan;
                $dataPengiriman->rt = $request->rt;
                $dataPengiriman->rw = $request->rw;
                $dataPengiriman->kecamatan = $request->kecamatan;
                $dataPengiriman->kode_pos = $request->kode_pos;
                $dataPengiriman->kota = $request->kota;
                $dataPengiriman->save();
                return response(["message" => "Data Barang berhasil ditambahkan"]);
            } catch (\Exception $e) {
                return response(["message" => $e->getMessage()]);
            }
        } else if($action == "update"){
            try {

                $dataPengiriman = DataPengiriman::where("id_alamat", $request->id_alamat)->first();
                $dataPengiriman->id_user = $request->id_user;
                $dataPengiriman->nama_penerima = $request->nama_penerima;
                $dataPengiriman->jalan = $request->jalan;
                $dataPengiriman->rt = $request->rt;
                $dataPengiriman->rw = $request->rw;
                $dataPengiriman->kecamatan = $request->kecamatan;
                $dataPengiriman->kode_pos = $request->kode_pos;
                $dataPengiriman->kota = $request->kota;

                // if ($request->file('img_brg')){
                //     $file = $request->file('img_brg');
                //     $name = $file->getClientOriginalName();
                //     $file->move(\base_path() ."/public/image", $name);
                //     $dataPengiriman->img_brg = $name;
                // }
                $dataPengiriman->save();

                return response (["message" => "Data Pengiriman berhasil diubah"]);
            } catch (\Exception $e) {
                return response (["message" => $e->getMessage()]);
            }
        }
    }

    public function drop($id_alamat)
    {
        try {
            DataPengiriman::where("id_alamat", $id_alamat)->delete();
            return response(["message" => "Data pengiriman berhasil dihapus"]);
        } catch (\Exception $e) {
            return response(["message" => $e->getMessage()]);
        }
    }
}
?>