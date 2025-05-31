<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = DB::table('orders')
        ->join('pelanggans','pelanggans.idpelanggan','=','orders.idpelanggan')
        ->select('orders.*','pelanggans.*')
        ->orderBy('orders.status','asc')
        ->get();

        return response()->json($data);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     public function store(Request $request)
    {
        // Ambil langsung dari request tanpa sub-key 'order'
        $idpelanggan = $request->input('idpelanggan');
        $tglorder = $request->input('tglorder');
        $total = $request->input('total');
        $bayar = $request->input('bayar');
        $kembali = $request->input('kembali');
        $status = $request->input('status');

        $details = $request->input('details');

        // Simpan ke tabel orders dan ambil ID-nya
        $idorder = DB::table('orders')->insertGetId([
            'idpelanggan' => $idpelanggan, // Gunakan variabel langsung
            'tglorder' => $tglorder,
            'total' => $total,
            'bayar' => $bayar,
            'kembali' => $kembali,
            'status' => $status
        ]);

        // Simpan semua item ke tabel details
        foreach ($details as $item) {
            DB::table('details')->insert([
                'idorder' => $idorder,
                'idmenu' => $item['idmenu'],
                'jumlah' => $item['jumlah'],
                'hargajual' => $item['hargajual']
            ]);
        }

        return response()->json(['success' => true, 'message' => 'Order berhasil disimpan']);
    }
        
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show($a, $b)
    {
        //

        $data = DB::table('orders')
        ->join('pelanggans','pelanggans.idpelanggan','=','orders.idpelanggan')
        ->select('orders.*','pelanggans.*')
        ->where('tglorder', '>=', $a)
        ->where('tglorder', '<=', $b)
        ->orderBy('orders.status','asc')
        ->get();
        
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $data = [
            'bayar' => $request->input('bayar'),
            'kembali' => $request->input('kembali'),
            'status' => $request->input('status')
        ];

        $order = Order::where('idorder',$id)->update($data);

        if ($order) {
            return response()->json([
                'pesan' => 'Sudah Dibayar'
            ]);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
