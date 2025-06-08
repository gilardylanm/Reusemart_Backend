<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Penitip;
use App\Models\Request_Donasi;
use App\Models\Donasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class OwnerWebController extends Controller
{
    public function index()
    {
        $reqList = Request_Donasi::with('organisasi')->get();
        $barangList = Barang::where('STATUS_BARANG', 'barang untuk donasi')->get();

        return view('owner', compact('reqList', 'barangList'));
    }

    public function historyDonasi()
    {
        $donasiList = Donasi::with(['requestDonasi.organisasi', 'barang'])->get();
        return view('ownerHistoryDonasi', compact('donasiList'));
    }

    public function penitipanHabis()
    {
        $now = Carbon::now();

        $barangList = Barang::whereHas('penitipan', function ($query) use ($now) {
            $query->where('TANGGAL_BERAKHIR', '<', $now);
        })->get();
        return view('ownerBarangEnd', compact('barangList'));
    }

    public function transaksiPenitip()
    {
        $penitip = Penitip::all();
        return view('ownerTransaksiPenitip', compact('penitip'));
    }

    public function penjualanPerKategori()
    {
        $kategoriList = [
            'Elektronik & Gadget',
            'Pakaian & Aksesori',
            'Perabotan Rumah Tangga',
            'Buku, Alat Tulis, & Peralatan Sekolah',
            'Hobi, Mainan, & Koleksi',
            'Perlengkapan Bayi & Anak',
            'Otomotif & Aksesori',
            'Perlengkapan Taman & Outdoor',
            'Peralatan Kantor & Industri',
            'Kosmetik & Perawatan Diri'
        ];

        $tahun = date('Y');

        $data = [];

        foreach ($kategoriList as $kategori) {
            $barangs = Barang::where('KATEGORI_BARANG', $kategori)
                ->whereHas('penitipan', function ($query) use ($tahun) {
                    $query->whereYear('TANGGAL_PENITIPAN', $tahun);
                })
                ->get();

            $terjual = $barangs->where('STATUS_BARANG', 'Terjual')->count();
            $gagal = $barangs->whereIn('STATUS_BARANG', ['Tersedia', 'barang untuk donasi', 'Terdonasi', 'Diambil'])->count();

            $data[$kategori] = [
                'terjual' => $terjual,
                'gagal' => $gagal,
            ];
        }

        return view('ownerKategoriBarang', [
            'kategoriData' => $data
        ]);
    }

    public function cetakNotaKategori()
    {
        $kategoriList = [
            'Elektronik & Gadget',
            'Pakaian & Aksesori',
            'Perabotan Rumah Tangga',
            'Buku, Alat Tulis, & Peralatan Sekolah',
            'Hobi, Mainan, & Koleksi',
            'Perlengkapan Bayi & Anak',
            'Otomotif & Aksesori',
            'Perlengkapan Taman & Outdoor',
            'Peralatan Kantor & Industri',
            'Kosmetik & Perawatan Diri'
        ];

        $tahun = date('Y');

        $data = [];

        foreach ($kategoriList as $kategori) {
            $barangs = Barang::where('KATEGORI_BARANG', $kategori)
                ->whereHas('penitipan', function ($query) use ($tahun) {
                    $query->whereYear('TANGGAL_PENITIPAN', $tahun);
                })
                ->get();

            $terjual = $barangs->where('STATUS_BARANG', 'Terjual')->count();
            $gagal = $barangs->whereIn('STATUS_BARANG', ['Tersedia', 'barang untuk donasi', 'Terdonasi', 'Diambil'])->count();

            $data[$kategori] = [
                'terjual' => $terjual,
                'gagal' => $gagal,
            ];
        }

        $tanggalCetak = Carbon::now()->locale('id')->isoFormat('D MMMM Y');

        $pdf = Pdf::loadView('pdf.notaPerKategori', [
            'kategoriData' => $data,
            'tahun' => $tahun,
            'tanggalCetak' => $tanggalCetak,
        ]);

        return $pdf->download('Laporan-Penjualan-Kategori-Barang.pdf');
    }

    public function cetakBarangEnd()
    {
        $now = Carbon::now();

        $barangList = Barang::whereHas('penitipan', function ($query) use ($now) {
            $query->where('TANGGAL_BERAKHIR', '<', $now);
        })->get();

        $tanggalCetak = Carbon::now()->locale('id')->isoFormat('D MMMM Y');
        $pdf = Pdf::loadView('pdf.notaBarangEnd', [
            'tanggalCetak' => $tanggalCetak,
            'barangList' => $barangList,
        ]);

        return $pdf->download('Laporan-Penitipan-Habis-Barang.pdf');
    }

    public function cetakHistoryDonasi()
    {
        $tahun = date('Y');
        $tanggalCetak = Carbon::now()->locale('id')->isoFormat('D MMMM Y');

        $donasiList = Donasi::with(['requestDonasi.organisasi', 'barang'])->get();
        $pdf = Pdf::loadView('pdf.notaDonasiBarang', [
            'tahun' => $tahun,
            'tanggalCetak' => $tanggalCetak,
            'donasiList' => $donasiList,
        ]);

        return $pdf->download('Laporan-History-Donasi-Barang.pdf');
    }

    public function cetakReqDonasi()
    {
        $reqList = Request_Donasi::with('organisasi')
            ->where('STATUS_REQUEST', 'menunggu')
            ->get();
        $barangList = Barang::where('STATUS_BARANG', 'barang untuk donasi')->get();
        $tanggalCetak = Carbon::now()->locale('id')->isoFormat('D MMMM Y');

        $pdf = Pdf::loadView('pdf.notaRequestDonasi', [
            'tanggalCetak' => $tanggalCetak,
            'reqList' => $reqList,
            'barangList' => $barangList,
        ]);

        return $pdf->download('Laporan-Req-Donasi-Barang.pdf');
    }

    public function cetakTransaksiPenitip($id)
    {
        $penitip = Penitip::findOrFail($id);
        $tahun = date('Y');
        $bulan = Carbon::now()->locale('id')->isoFormat('MMMM');

        // Ambil semua barang penitip yang sudah terjual (ada relasi ke pembelian)
        $barangList = Barang::where('STATUS_BARANG', 'Terjual')
            ->whereHas('penitipan', function ($query) use ($id) {
                $query->where('ID_PENITIP', $id);
            })
            ->whereHas('pembelian')
            ->with(['penitipan', 'pembelian'])
            ->get();



        $tanggalCetak = Carbon::now()->locale('id')->isoFormat('D MMMM Y');

        $pdf = Pdf::loadView('pdf.notaTransaksiPenitip', compact('penitip', 'barangList', 'tanggalCetak', 'tahun', 'bulan'));

        return $pdf->download('Laporan-Transaksi-Penitip-' . $penitip->NAMA_PENITIP . '.pdf');
    }
}
