<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\transaksi;

class transaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaksi = transaksi::all();
        return $transaksi;
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
        $transaksi = transaksi::create([
            "tanggal_beli" => $request->tanggal_beli,
            "nama" => $request->nama,
            "konser" => $request->konser,
            "jadwal" => $request->jadwal,
            "jumlah" => $request->jumlah,
        ]);
        
        return response()->json([
            'success' => 201,
            'message' => "Data tiket berhasil disimpan",
            'data' => $transaksi
        ],
        201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transaksi = transaksi::find($id);
        if ($transaksi){
            return response()->json([
                'status' => 200,
                'data' => $transaksi
            ], 200);
        }else{
            return response()->json([
                'status' => 404,
                'message' => 'id atas ' . $id . ' tidak ditemukan'
            ],404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $transaksi = transaksi::where('id', $id)->first();
        if($transaksi){
            $transaksi->tanggal_beli = $request->tanggal_beli ? $request->tanggal_beli : $tiket->tanggal_beli;
            $transaksi->nama = $request->nama ? $request->nama : $tiket->nama;
            $transaksi->konser = $request->konser ? $request->konser : $tiket->konser;
            $transaksi->jadwal = $request->jadwal ? $request->jadwal : $tiket->jadwal;
            $transaksi->jumlah = $request->jumlah ? $request->jumlah : $tiket->jumlah;
            $transaksi->save();
            return response()->json([
                'status' => 200,
                'message' => "Tiket Berhasil Diubah",
                'data' => $transaksi
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => "Tiket Tidak Dapat  Ditemukan"
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transaksi = transaksi::where('id', $id)->first();
        if($transaksi){
            $transaksi->delete();
            return response()->json([
                'status' => 200,
                'message' => "Transaksi Dibatalkan"
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => "Transaksi Tidak Dapat Ditemukan"
            ], 404);
        }
    }
}
