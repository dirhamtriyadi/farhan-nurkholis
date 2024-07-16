<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BarangMasuk;
use App\Models\StockBarang;

class BarangMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barangMasuk = BarangMasuk::with('stockBarang', 'createdBy', 'updatedBy')->latest()->get();

        return view('barang-masuk.index', [
            'data' => $barangMasuk,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $stockBarang = StockBarang::latest()->get();

        return view('barang-masuk.create', [
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

        $barangMasuk = BarangMasuk::create($validatedData);

        $stockBarang = StockBarang::find($request->stock_barang_id);
        $stockBarang->kuantitas += $barangMasuk->kuantitas;
        $stockBarang->save();

        return redirect()->route('barang-masuk.index')->with('success', 'Barang masuk created successfully.');
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
        $barangMasuk = BarangMasuk::findOrFail($id);
        $stockBarang = StockBarang::latest()->get();

        return view('barang-masuk.edit', [
            'data' => $barangMasuk,
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

        $validatedData['updated_by'] = auth()->user()->id;

        $barangMasuk = BarangMasuk::findOrFail($id);
        $stockBarang = StockBarang::find($barangMasuk->stock_barang_id);
        $stockBarang->kuantitas -= $barangMasuk->kuantitas;
        $stockBarang->save();

        $barangMasuk->update($validatedData);

        $stockBarang = StockBarang::find($request->stock_barang_id);
        $stockBarang->kuantitas += $barangMasuk->kuantitas;
        $stockBarang->save();

        return redirect()->route('barang-masuk.index')->with('success', 'Barang masuk updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $barangMasuk = BarangMasuk::findOrFail($id);

        $stockBarang = StockBarang::find($barangMasuk->stock_barang_id);
        $stockBarang->kuantitas -= $barangMasuk->kuantitas;
        $stockBarang->save();

        $barangMasuk->delete();

        $request->session()->flash('success', 'Barang masuk deleted successfully.');
        return response()->json('Barang masuk deleted successfully.', 200);
        // return redirect()->route('barang-masuk.index')->with('success', 'Barang masuk deleted successfully.');
    }
}
