<?php

namespace App\Http\Controllers;

use App\Models\BarangModel;
use App\Models\KategoriModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Validator;

class BarangController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Barang',
            'list' => ['Home', 'Barang']
        ];

        $page = (object) [
            'title' => 'Daftar barang dalam sistem'
        ];

        $activeMenu = 'barang';
        $kategori = KategoriModel::all();

        return view('barang.index', compact('breadcrumb', 'page', 'activeMenu', 'kategori'));
    }

    // Mengambil data barang dari database dalam format JSON untuk DataTables
    public function list(Request $request)
    {
        $barang = BarangModel::select(
            'm_barang.barang_id',
            'm_barang.barang_kode',
            'm_barang.barang_nama',
            'm_barang.harga_beli',
            'm_barang.harga_jual',
            'm_kategori.kategori_nama'
        )
            ->join('m_kategori', 'm_barang.kategori_id', '=', 'm_kategori.kategori_id'); // Join tabel kategori

        // Filter data barang berdasarkan kategori_id jika ada
        if ($request->kategori_id) {
            $barang->where('m_barang.kategori_id', $request->kategori_id);
        }

        return DataTables::of($barang)
            ->addIndexColumn() // Menambahkan kolom index / nomor urut
            ->addColumn('aksi', function ($barang) { // Menambahkan kolom aksi
                $btn = '<button onclick="modalAction(\'' . url('/barang/' . $barang->barang_id . '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/barang/' . $barang->barang_id . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/barang/' . $barang->barang_id . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';
                return $btn;
            })
            ->rawColumns(['aksi']) // Memberitahu bahwa kolom aksi berisi HTML
            ->make(true);
    }

    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Barang',
            'list' => ['Home', 'Barang', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah barang baru'
        ];

        $activeMenu = 'barang';
        $kategori = KategoriModel::all();

        return view('barang.create', compact('breadcrumb', 'page', 'activeMenu', 'kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang_kode' => 'required|string|min:2|unique:m_barang,barang_kode',
            'barang_nama' => 'required|string|max:100',
            'kategori_id' => 'required|exists:m_kategori,kategori_id',
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric'
        ]);

        BarangModel::create($request->all());

        return redirect('/barang')->with('success', 'Data barang berhasil disimpan');
    }

    public function show(string $id)
    {
        $barang = BarangModel::find($id);

        if (!$barang) {
            return redirect('/barang')->with('error', 'Data barang tidak ditemukan');
        }

        $breadcrumb = (object) [
            'title' => 'Detail Barang',
            'list' => ['Home', 'Barang', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail barang'
        ];

        $activeMenu = 'barang';

        return view('barang.show', compact('breadcrumb', 'page', 'barang', 'activeMenu'));
    }

    public function edit(string $id)
    {
        $barang = BarangModel::find($id);

        if (!$barang) {
            return redirect('/barang')->with('error', 'Data barang tidak ditemukan');
        }

        $breadcrumb = (object) [
            'title' => 'Edit Barang',
            'list' => ['Home', 'Barang', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit Barang'
        ];

        $activeMenu = 'barang';
        $kategori = KategoriModel::all();

        return view('barang.edit', compact('breadcrumb', 'page', 'barang', 'activeMenu', 'kategori'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'barang_kode' => 'required|string|max:10|unique:m_barang,barang_kode,' . $id . ',barang_id',
            'barang_nama' => 'required|string|max:100',
            'kategori_id' => 'required|exists:m_kategori,kategori_id',
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric'
        ]);

        $barang = BarangModel::find($id);

        if (!$barang) {
            return redirect('/barang')->with('error', 'Data barang tidak ditemukan');
        }

        $barang->update($request->all());

        return redirect('/barang')->with('success', 'Data barang berhasil diubah');
    }

    public function destroy(string $id)
    {
        $barang = BarangModel::find($id);
        if (!$barang) {
            return redirect('/barang')->with('error', 'Data barang tidak ditemukan');
        }

        try {
            $barang->delete();
            return redirect('/barang')->with('success', 'Data barang berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/barang')->with('error', 'Data barang gagal dihapus karena masih digunakan di tabel lain');
        }
    }

    // Menampilkan form tambah barang
    public function create_ajax()
    {
        $kategori = KategoriModel::all();
        return view('barang.create_ajax', compact('kategori'));
    }

    // Menyimpan barang via AJAX
    public function store_ajax(Request $request)
    {
        if ($request->ajax()) {
            $rules = [
                'kategori_id'  => 'required|exists:m_kategori,kategori_id',
                'barang_kode'  => 'required|string|min:2|max:10|unique:m_barang,barang_kode',
                'barang_nama'  => 'required|string|min:3|max:100',
                'harga_beli'   => 'required|numeric|min:1',
                'harga_jual'   => 'required|numeric|min:1'
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors(),
                ]);
            }

            BarangModel::create($request->all());
            return response()->json([
                'status'  => true,
                'message' => 'Barang berhasil ditambahkan'
            ]);
        }
        return response()->json([
            'status'  => true,
            'message' => 'Barang berhasil ditambahkan',
            'redirect' => url('/barang') // Kirim URL tujuan ke frontend
        ]);
    }

    public function edit_ajax(string $id)
    {
        $barang = BarangModel::find($id);
        $kategori = KategoriModel::select('kategori_id', 'kategori_nama')->get();

        return view('barang.edit_ajax', ['barang' => $barang, 'kategori' => $kategori]);
    }

    public function update_ajax(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'barang_kode' => 'required|string|max:10|unique:m_barang,barang_kode,' . $id . ',barang_id',
            'barang_nama' => 'required|string|max:100',
            'kategori_id' => 'required|exists:m_kategori,kategori_id',
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validasi gagal.',
                'msgField' => $validator->errors()
            ]);
        }

        $barang = BarangModel::find($id);
        if (!$barang) {
            return response()->json([
                'status' => false,
                'message' => 'Data barang tidak ditemukan.'
            ]);
        }

        $barang->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Data barang berhasil diperbarui.'
        ]);
    }

    // Menampilkan konfirmasi hapus barang
    public function confirm_ajax(string $id)
    {
        $barang = BarangModel::find($id);

        return view('barang.confirm_ajax', ['barang' => $barang]);
    }

    // Hapus data barang via AJAX
    public function delete_ajax(Request $request, string $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $barang = BarangModel::find($id);
            if ($barang) {
                $barang->delete();
                return response()->json([
                    'status'  => true,
                    'message' => 'Data barang berhasil dihapus'
                ]);
            } else {
                return response()->json([
                    'status'  => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }
        return redirect('/');
    }
    public function show_ajax($id)
    {
        $barang = BarangModel::find($id);

        // Pastikan data ditemukan
        if (!$barang) {
            return response()->json(['success' => false, 'message' => 'Barang tidak ditemukan'], 404);
        }

        // Kembalikan tampilan view barang
        return view('barang.show_ajax', compact('barang'));
    }

    public function import()
    {
        return view('barang.import');
    }

    public function import_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                // validasi file harus xls atau xlsx, max 1MB
                'file_barang' => ['required', 'mimes:xlsx', 'max:1024']
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors()
                ]);
            }
            $file = $request->file('file_barang'); // ambil file dari request
            $reader = IOFactory::createReader('Xlsx'); // load reader file excel
            $reader->setReadDataOnly(true); // hanya membaca data
            $spreadsheet = $reader->load($file->getRealPath()); // load file excel
            $sheet = $spreadsheet->getActiveSheet(); // ambil sheet yang aktif
            $data = $sheet->toArray(null, false, true, true); // ambil data excel
            $insert = [];
            if (count($data) > 1) { // jika data lebih dari 1 baris
                foreach ($data as $baris => $value) {
                    if ($baris > 1) { // baris ke 1 adalah header, maka lewati
                        $insert[] = [
                            'kategori_id' => $value['A'],
                            'barang_kode' => $value['B'],
                            'barang_nama' => $value['C'],
                            'harga_beli' => $value['D'],
                            'harga_jual' => $value['E'],
                            'created_at' => now(),
                        ];
                    }
                }
                if (count($insert) > 0) {
                    // insert data ke database, jika data sudah ada, maka diabaikan
                    BarangModel::insertOrIgnore($insert);
                }
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil diimport'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Tidak ada data yang diimport'
                ]);
            }
        }
        return redirect('/');
    }

public function export_excel(){
    //ambil data barang yang akan di export
    $barang = BarangModel::select('kategori_id','barang_kode','barang_nama','harga_beli','harga_jual')
        ->orderBy('kategori_id')
        ->with('kategori')
        ->get();

    //load library excel
    $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet(); //ambil sheet yang aktif

    $sheet->setCellValue('A1','No');
    $sheet->setCellValue('B1','Kode Barang');
    $sheet->setCellValue('C1','Nama Barang');
    $sheet->setCellValue('D1','Harga Beli');
    $sheet->setCellValue('E1','Harga Jual');
    $sheet->setCellValue('F1','Kategori');

    $sheet->getStyle('A1:F1')->getFont()->setBold(true); // bold header
    $no = 1; // nomor data dimulai dari 1
    $baris = 2; //baris data dimulai dari baris ke 2
    foreach ($barang as $key => $value) {
        $sheet->setCellValue('A'.$baris, $no);
        $sheet->setCellValue('B'.$baris, $value->barang_kode);
        $sheet->setCellValue('C'.$baris, $value->barang_nama);
        $sheet->setCellValue('D'.$baris, $value->harga_beli);
        $sheet->setCellValue('E'.$baris, $value->harga_jual);
        // Check if category exists before accessing it
        $sheet->setCellValue('F'.$baris, $value->kategori ? $value->kategori->kategori_nama : 'No Category');
        $baris++;
        $no++;
    }

    foreach(range('A','F') as $columnID){
        $sheet->getColumnDimension($columnID)->setAutoSize(true); // set auto size untuk kolom
    }

    $sheet->setTitle('Data Barang'); // set title sheet

    $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
    $filename = 'Data Barang '.date('Y-m-d H:i:s').'.xlsx';

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="'.$filename.'"');
    header('Cache-Control: max-age=0');
    header('Cache-Control: max-age=1');
    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
    header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
    header('Cache-Control: cache, must-revalidate');
    header('Pragma: public');

    $writer->save('php://output');
    exit;
} // end function export_excel

public function export_pdf(){
    $barang = BarangModel::select('kategori_id','barang_kode','barang_nama','harga_beli','harga_jual')
    ->orderBy('kategori_id')
    ->orderBy('barang_kode')
    ->with('kategori')
    ->get();

    //use Barryvdh\DomPDF\Facade\Pdf;
    $pdf = Pdf::loadView('barang.export_pdf', ['barang' => $barang]);
    $pdf->setPaper('a4','potrait'); //set ukuran kertas dan orientasi
    $pdf->setOption("isRemoteEnabled", true); //set true jika ada gambar dari url
    $pdf->render();

    return $pdf->stream('Data Barang '.date('Y-m-d H:i:s').'.pdf');
}
}