<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StockBarang;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('start_date') && $request->has('end_date')) {
            $start_date = $request->start_date;
            $end_date = $request->end_date;

            $dateS = new Carbon($start_date);
            $dateE = new Carbon($end_date);

            $data['stock_barang'] = StockBarang::with('createdBy', 'updatedBy')->whereBetween('created_at', [$dateS->format('Y-m-d')." 00:00:00", $dateE->format('Y-m-d')." 23:59:59"])->count();
            $data['barang_masuk'] = BarangMasuk::with('stockBarang', 'createdBy', 'updatedBy')->whereBetween('tanggal', [$start_date, $end_date])->count();
            $data['barang_keluar'] = BarangKeluar::with('stockBarang', 'createdBy', 'updatedBy')->whereBetween('tanggal', [$start_date, $end_date])->count();
        } else {
            $start_date = date('Y-m-01');
            $end_date = date('Y-m-d');

            $dateS = new Carbon($start_date);
            $dateE = new Carbon($end_date);

            $data['stock_barang'] = StockBarang::with('createdBy', 'updatedBy')->whereBetween('created_at', [$dateS->format('Y-m-d')." 00:00:00", $dateE->format('Y-m-d')." 23:59:59"])->count();
            $data['barang_masuk'] = BarangMasuk::with('stockBarang', 'createdBy', 'updatedBy')->whereBetween('tanggal', [$start_date, $end_date])->count();
            $data['barang_keluar'] = BarangKeluar::with('stockBarang', 'createdBy', 'updatedBy')->whereBetween('tanggal', [$start_date, $end_date])->count();
        }

        return view('dashboard.index', [
            'start_date' => $start_date,
            'end_date' => $end_date,
            'data' => $data,
        ]);
    }

    public function getChart(Request $request)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $dateS = new Carbon($start_date);
        $dateE = new Carbon($end_date);

        $stock_barang = StockBarang::with('createdBy', 'updatedBy')->whereBetween('created_at', [$dateS->format('Y-m-d')." 00:00:00", $dateE->format('Y-m-d')." 23:59:59"])->get();
        $barang_masuk = BarangMasuk::with('stockBarang', 'createdBy', 'updatedBy')->whereBetween('tanggal', [$start_date, $end_date])->get();
        $barang_keluar = BarangKeluar::with('stockBarang', 'createdBy', 'updatedBy')->whereBetween('tanggal', [$start_date, $end_date])->get();

        $arrayStockBarang = [];
        $arrayBarangMasuk = [];
        $arrayBarangKeluar = [];

        // Logic for chart to month value array
        for ($i = 1; $i <= 12; $i++) {
            $arrayStockBarang[$i] = 0;
            $arrayBarangMasuk[$i] = 0;
            $arrayBarangKeluar[$i] = 0;
        }

        foreach ($stock_barang as $stock) {
            $month = (int) date('m', strtotime($stock->created_at));
            $arrayStockBarang[$month] += 1;
        }

        foreach ($barang_masuk as $masuk) {
            $month = (int) date('m', strtotime($masuk->tanggal));
            $arrayBarangMasuk[$month] += 1;
        }

        foreach ($barang_keluar as $keluar) {
            $month = (int) date('m', strtotime($keluar->tanggal));
            $arrayBarangKeluar[$month] += 1;
        }

        $stock_barang = array_values($arrayStockBarang);
        $barang_masuk = array_values($arrayBarangMasuk);
        $barang_keluar = array_values($arrayBarangKeluar);

        $data = [
            'stock_barang' => $stock_barang,
            'barang_masuk' => $barang_masuk,
            'barang_keluar' => $barang_keluar,
        ];

        return response()->json($data);
    }
}
