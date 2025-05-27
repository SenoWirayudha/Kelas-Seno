<?php

namespace App\Http\Controllers;

use App\Models\order;
use Illuminate\Http\Request;
use App\Http\Requests\StoreorderRequest;
use App\Http\Requests\UpdateorderRequest;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $status = $request->status;
        
        $query = Order::join('pelanggans','orders.idpelanggan','=','pelanggans.idpelanggan')
            ->select(['orders.*','pelanggans.*']);
            
        if ($status !== null) {
            $query->where('status', $status);
        }
        
        $orders = $query->orderBy('status','ASC')->paginate(5);
        
        return view('Backend.order.select',['orders'=> $orders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreorderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreorderRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\order  $order
     * @return \Illuminate\Http\Response
     */
    public function show($idorder)
    {
        $order = Order::where('idorder',$idorder)->first();
        return view('Backend.order.update',['order' => $order]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit($idorder)
    {
        $orders = Order::join('orderdetails','orders.idorder','=','orderdetails.idorder')
        ->join('menus','orderdetails.idmenu','=','menus.idmenu')
        ->join('pelanggans','orders.idpelanggan','=','pelanggans.idpelanggan')
        ->where("orders.idorder",$idorder)
        ->get(['orders.*','orderdetails.*','menus.*','pelanggans.*']);

        return view('Backend.order.detail',['orders' => $orders]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateorderRequest  $request
     * @param  \App\Models\order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idorder)
    {
        $data = $request->validate([
            'bayar' => 'required'
        ]);

        $kembalis = Order::where('idorder',$idorder)->first();
        $kembali = $data['bayar']-$kembalis->total;

        Order::where('idorder',$idorder)->update([
            'bayar' => $data['bayar'], 
            'kembali' => $kembali,
            'status' => 1,
        ]);

        return redirect('admin/order');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(order $order)
    {
        //
    }
}
