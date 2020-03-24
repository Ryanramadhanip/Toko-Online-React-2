<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Orders;
use App\detail_Orders;
use App\User;
use App\Alamat;
use App\Product;
use Auth;
class OrdersController extends Controller
{

  function __construct()
  {

  }

  public function get()
  {
    $order = [];
    foreach (Orders::all() as $o) {
      $detail = [];
      foreach ($o->detail_orders as $d){
        $itemDetail = [
          "id_order" => $d->id_order,
          "id_product" => $d->id_product,
          "quantity" => $d->quantity
        ];
      array_push($detail, $itemDetail);
    }
    $item = [
      "id_order" => $o->id,
      "id_user" => $o->id_user,
      "username" => $o->user->username,
      "id_alamat" => $o->id_alamat,
      "total" => $o->total,
      "bukti_bayar"=>$o->bukti_bayar,
      "status"=>$o->status,
      "detail" => $detail
    ];
    array_push($order, $item);
  }
  return response(["order" =>$order]);
  }

  public function accept($id)
  {
    $o = Orders::where("id", $id)->first();
    $o->status = "dikirim";
    $o->save();
  }

  public function decline($id)
  {
    $o = Orders::where("id", $id)->first();
    $o->status = "ditolak";
    $o->save();
  }

  public function getById($id)
  {
    try {
      $order = Orders::where("id", $id)->get();
      return response(["orders" => $order]); 
    } catch (\Exception $e) {
      return response(["message" => $e->getMessage()]);
    }
  }
 }
 ?>
