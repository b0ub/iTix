<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tiket;

class tiketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tiket = tiket::get();
        return $tiket;
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
        $table = tiket::create([
            "nama" => $request->nama,
            "deskripsi" => $request->deskripsi,
            "kode" => $request->kode
        ]);

        return response()->json([
            'success' => 201,
            'message' => "Tiket Berhasil Dicetak",
            'data' => $table
        ],
            201
                );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tiket = tiket::where('id', $id)->first();
        if ($tiket){
            return response()->json([
                'status' => 200,
                'data' => $tiket
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'data' => 'Data Tidak Dapat Ditemukan'
            ], 404);
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
        $tiket = tiket::where('id', $id)->first();
        if($tiket){
            $tiket->nama = $request->nama ? $request->nama : $tiket->nama;
            $tiket->deskripsi = $request->deskripsi ? $request->deskripsi : $tiket->deskripsi;
            $tiket->kode = $request->kode ? $request->kode : $tiket->kode;
            $tiket->save();
            return response()->json([
                'status' => 200,
                'message' => "Tiket Berhasil Diubah",
                'data' => $tiket
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
        $tiket = tiket::where('id', $id)->first();
        if($tiket){
            $tiket->delete();
            return response()->json([
                'status' => 200,
                'message' => "Tiket Dihapus"
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => "Tiket Tidak Dapat Ditemukan"
            ], 404);
        }
    }
}
