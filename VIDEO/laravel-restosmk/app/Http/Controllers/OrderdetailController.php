<?php

namespace App\Http\Controllers;

use App\Models\orderdetail;
use App\Http\Requests\StoreorderdetailRequest;
use App\Http\Requests\UpdateorderdetailRequest;
use Illuminate\Http\Request;

class OrderdetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $details = Orderdetail::join('orders','orderdetails.idorder','=','orders.idorder')
        ->join('menus','orderdetails.idmenu','=','menus.idmenu')
        ->join('pelanggans','orders.idpelanggan','=','pelanggans.idpelanggan')
        ->select(['orderdetails.*','orders.*','menus.*','pelanggans.*'])
        ->paginate(3);
        return view('Backend.detail.select',['details' => $details]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $tglmulai= $request->tglmulai;
        $tglakhir= $request->tglakhir;

        $details = Orderdetail::join('orders','orderdetails.idorder','=','orders.idorder')
        ->join('menus','orderdetails.idmenu','=','menus.idmenu')
        ->join('pelanggans','orders.idpelanggan','=','pelanggans.idpelanggan')
        ->whereBetween('orders.tglorder',[$tglmulai,$tglakhir])
        ->select(['orderdetails.*','orders.*','menus.*','pelanggans.*'])
        ->paginate(3);
        return view('Backend.detail.select',['details' => $details]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreorderdetailRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreorderdetailRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\orderdetail  $orderdetail
     * @return \Illuminate\Http\Response
     */
    public function show(orderdetail $orderdetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\orderdetail  $orderdetail
     * @return \Illuminate\Http\Response
     */
    public function edit(orderdetail $orderdetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateorderdetailRequest  $request
     * @param  \App\Models\orderdetail  $orderdetail
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateorderdetailRequest $request, orderdetail $orderdetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\orderdetail  $orderdetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(orderdetail $orderdetail)
    {
        //
    }
}
