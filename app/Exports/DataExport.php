<?php

namespace App\Exports;

use App\Models\Menu;
use App\Models\Pesanan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DataExport implements FromCollection, WithStyles, WithColumnWidths
{
    /**
     * Mengambil koleksi data untuk diekspor.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Ambil semua pesanan dengan status 1
        $pesanan = Pesanan::where('status', 1)->get();
        $menu = Menu::all();

        // Membuat data untuk diekspor
        $data = $pesanan->map(function ($item) use ($menu) {
            // Mengambil nama menu berdasarkan ID
            $menu1 = $menu->where('id', $item->menu1)->first();
            $menu2 = $menu->where('id', $item->menu2)->first();

            return [
                'nama_pemesan' => $item->nama_pemesan,
                'menu1' => $menu1 ? $menu1->nama_menu.'@'.$menu1->harga : '-',
                'jumlah1' => $item->jumlah1 !== null ? $item->jumlah1 : '-',
                'menu2' => $menu2 ? $menu2->nama_menu.'@'.$menu2->harga : '-',
                'jumlah2' => $item->jumlah2 !== null ? $item->jumlah2 : '-',
                'total_harga' =>'Rp. '. $item->total_harga,
                'catatan' => $item->catatan,
                'metode_pembayaran' => $item->mode_pembayaran,
            ];
        });

        // Menambahkan header ke data
        $header = [
            'nama_pemesan' => 'Nama Pemesan',
            'menu1' => 'Menu 1',
            'jumlah1' => 'Jumlah 1',
            'menu2' => 'Menu 2',
            'jumlah2' => 'Jumlah 2',
            'total_harga' => 'Total Harga',
            'catatan' => 'Catatan',
            'metode_pembayaran' => 'Metode Pembayaran',
        ];

        // Menghitung total penghasilan
        $totalPenghasilan = $pesanan->sum('total_harga');

        // Menambahkan total penghasilan ke data
        $totalRow = [
            'nama_pemesan' => 'Total Penghasilan',
            'menu1' => '',
            'jumlah1' => '',
            'menu2' => '',
            'jumlah2' => '',
            'total_harga' => 'Rp. '.$totalPenghasilan,
            'catatan' => '',
            'metode_pembayaran' => '',
        ];

        // Menggabungkan header dengan data dan menambahkan total penghasilan
        return collect([$header])->merge($data)->push($totalRow);
    }

    /**
     * Mengatur gaya untuk spreadsheet.
     *
     * @param Worksheet $sheet
     * @return array
     */
    public function styles(Worksheet $sheet)
    {
        $lastRow = $sheet->getHighestRow(); // Mendapatkan nomor baris terakhir

        return [
            'A1:H1' => ['font' => ['bold' => true]], // Header bold
            "A2:A$lastRow" => ['font' => ['bold' => true]], // Kolom nama_pemesan bold
            'A:H' => [
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT, // Rata kiri untuk kolom A hingga H
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,   // Rata tengah vertikal
                    'wrapText' => true,  // Bungkus teks
                ]
            ],
        ];
    }

    /**
     * Mengatur lebar kolom.
     *
     * @return array
     */
    public function columnWidths(): array
    {
        return [
            'A' => 20, // Nama Pemesan
            'B' => 10, // Menu 1
            'C' => 5, // Jumlah 1
            'D' => 10, // Menu 2
            'E' => 5, // Jumlah 2
            'F' => 10, // Total Harga
            'G' => 15, // Catatan
            'H' => 15, // Metode Pembayaran
        ];
    }
}
