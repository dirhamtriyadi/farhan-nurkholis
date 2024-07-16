<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StockBarang;

class StockBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stockBarang = StockBarang::latest()->get();

        return view('stock-barang.index', [
            'data' => $stockBarang,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('stock-barang.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'jenis' => 'required',
            'kategori' => 'required',
            'merk' => 'required',
            'satuan' => 'required',
            'kuantitas' => 'required|numeric',
            'keterangan' => 'nullable',
        ]);

        $validatedData['created_by'] = auth()->user()->id;

        StockBarang::create($validatedData);

        return redirect()->route('stock-barang.index')->with('success', 'Stock barang created successfully.');
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
        $stockBarang = StockBarang::findOrFail($id);

        return view('stock-barang.edit', [
            'data' => $stockBarang,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'jenis' => 'required',
            'kategori' => 'required',
            'merk' => 'required',
            'satuan' => 'required',
            'kuantitas' => 'required|numeric',
            'keterangan' => 'nullable',
        ]);

        $validatedData['updated_by'] = auth()->user()->id;

        StockBarang::findOrFail($id)->update($validatedData);

        return redirect()->route('stock-barang.index')->with('success', 'Stock barang updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        StockBarang::findOrFail($id)->delete();

        $request->session()->flash('success', 'Stock barang deleted successfully.');
        return response()->json('Stock barang deleted successfully.', 200);
        // return redirect()->route('stock-barang.index')->with('success', 'Stock barang deleted successfully.');
    }
}
