<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use Maatwebsite\Excel\Concerns\Exportable;

class LaporanExport implements FromCollection, WithHeadings
{
    use Exportable;

    public function __construct($start_date, $end_date)
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }

    public function collection() {
        if ($this->start_date && $this->end_date) {
            $data['barang_masuk'] = BarangMasuk::with('stockBarang', 'createdBy', 'updatedBy')->whereBetween('tanggal', [$this->start_date, $this->end_date])->get();
            $data['barang_keluar'] = BarangKeluar::with('stockBarang', 'createdBy', 'updatedBy')->whereBetween('tanggal', [$this->start_date, $this->end_date])->get();
        } else {
            $start_date = date('Y-m-01');
            $end_date = date('Y-m-d');
            $data['barang_masuk'] = BarangMasuk::with('stockBarang', 'createdBy', 'updatedBy')->get();
            $data['barang_keluar'] = BarangKeluar::with('stockBarang', 'createdBy', 'updatedBy')->get();
        }

        $data['merge'] = collect();

        foreach ($data['barang_masuk'] as $key => $value) {
            $tempData = [
                'No' => $key + 1,
                'Nama Barang' => $value->stockBarang->nama,
                'Tanggal' => $value->tanggal,
                'Kuantitas' => $value->kuantitas,
                'Dibuat Oleh' => $value->createdBy->name,
                'Status' => 'Masuk',
                'Keterangan' => $value->keterangan,
            ];
            // $data['barang_masuk'][$key]->jenis = 'Masuk';
            $data['merge']->push($tempData);
        }

        foreach ($data['barang_keluar'] as $key => $value) {
            $tempData = [
                'No' => $key + 1,
                'Nama Barang' => $value->stockBarang->nama,
                'Tanggal' => $value->tanggal,
                'Kuantitas' => $value->kuantitas,
                'Dibuat Oleh' => $value->createdBy->name,
                'Status' => 'Keluar',
                'Keterangan' => $value->keterangan,
            ];
            // $data['barang_keluar'][$key]->jenis = 'Keluar';
            $data['merge']->push($tempData);
        }

        return $data['merge'];
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama Barang',
            'Tanggal',
            'Kuantitas',
            'Dibuat Oleh',
            'Status',
            'Keterangan',
        ];
    }
}
