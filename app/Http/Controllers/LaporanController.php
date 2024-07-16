<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->has('start_date') && $request->has('end_date')) {
            $start_date = $request->start_date;
            $end_date = $request->end_date;

            $data['barang_masuk'] = BarangMasuk::with('stockBarang', 'createdBy', 'updatedBy')->whereBetween('tanggal', [$start_date, $end_date])->get();
            $data['barang_keluar'] = BarangKeluar::with('stockBarang', 'createdBy', 'updatedBy')->whereBetween('tanggal', [$start_date, $end_date])->get();
        } else {
            $start_date = date('Y-m-01');
            $end_date = date('Y-m-d');
            $data['barang_masuk'] = BarangMasuk::with('stockBarang', 'createdBy', 'updatedBy')->get();
            $data['barang_keluar'] = BarangKeluar::with('stockBarang', 'createdBy', 'updatedBy')->get();
        }

        $data['merge'] = collect();

        foreach ($data['barang_masuk'] as $key => $value) {
            $data['barang_masuk'][$key]->jenis = 'Masuk';
            $data['merge']->push($value);
        }

        foreach ($data['barang_keluar'] as $key => $value) {
            $data['barang_keluar'][$key]->jenis = 'Keluar';
            $data['merge']->push($value);
        }

        return view('laporan.index', [
            'data' => $data,
            'start_date' => $start_date,
            'end_date' => $end_date,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
