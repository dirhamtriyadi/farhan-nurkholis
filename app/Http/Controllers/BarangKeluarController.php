<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BarangKeluar;
use App\Models\StockBarang;

class BarangKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barangKeluar = BarangKeluar::with('stockBarang', 'createdBy', 'updatedBy')->latest()->get();

        return view('barang-keluar.index', [
            'data' => $barangKeluar,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $stockBarang = StockBarang::latest()->get();

        return view('barang-keluar.create', [
            'stockBarang' => $stockBarang,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'stock_barang_id' => 'required',
            'tanggal' => 'required|date',
            'kuantitas' => 'required|numeric',
            'keterangan' => 'nullable',
        ]);

        $validatedData['created_by'] = auth()->user()->id;

        $barangKeluar = BarangKeluar::create($validatedData);

        $stockBarang = StockBarang::find($request->stock_barang_id);
        $stockBarang->kuantitas -= $barangKeluar->kuantitas;
        $stockBarang->save();

        return redirect()->route('barang-keluar.index')->with('success', 'Barang keluar created successfully.');
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
        $barangKeluar = BarangKeluar::findOrFail($id);
        $stockBarang = StockBarang::latest()->get();

        return view('barang-keluar.edit', [
            'data' => $barangKeluar,
            'stockBarang' => $stockBarang,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'stock_barang_id' => 'required',
            'tanggal' => 'required|date',
            'kuantitas' => 'required|numeric',
            'keterangan' => 'nullable',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $barangKeluar = BarangKeluar::findOrFail($id);

        $stockBarang = StockBarang::find($barangKeluar->stock_barang_id);
        $stockBarang->kuantitas += $barangKeluar->kuantitas;
        $stockBarang->save();

        $barangKeluar->delete();

        $request->session()->flash('success', 'Barang keluar deleted successfully.');
        return response()->json('Barang keluar deleted successfully.', 200);
        // return redirect()->route('barang-keluar.index')->with('success', 'Barang keluar deleted successfully.');
    }
}
