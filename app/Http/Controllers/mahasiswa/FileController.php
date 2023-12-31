<?php

namespace App\Http\Controllers\mahasiswa;
use App\Http\Controllers\Controller;

use App\DataTables\BerkasDataTable;
use App\Models\Document;
use App\Models\File;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class FileController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:create layanan/berkas')->only('create');
    }

    public function index(BerkasDataTable $dataTable)
    {
        //
        $this->authorize('read layanan/berkas');
        return $dataTable->render('layanan.mahasiswa.file.file');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $documents = Document::all();
        $berka = new File(); // Instantiate a new File model object
    
        return view('layanan.mahasiswa.file.file-action', compact('documents', 'berka'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, File $berka)
    {
        $berka = new File();
        $berka->user_id = auth()->id();
        $berka->jenis_file = $request->jenis_file;
        $berka->bukti_file = $request->bukti_file;
        $berka->status = 'Belum Validasi';
        $berka->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Create data successfully'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $documents = Document::all();
        $berka = File::findOrFail($id);

        return view('layanan.mahasiswa.file.file-detail', compact('documents', 'berka'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(File $berka)
    {
        $documents = Document::all();
        return view('layanan.mahasiswa.file.file-action',compact('documents', 'berka'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, File $berka)
    {
        $berka->user_id = auth()->id();
        $berka->jenis_file = $request->jenis_file;
        $berka->bukti_file = $request->bukti_file;
        $berka->keterangan = $request->keterangan;
        $berka->status = $request->status;
        $berka->save();

        return response()->json([
            'status' => 'success',
            'message' => 'updated data successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(File $berka)
    {
        $berka->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Delete data successfully'
        ]);
    }
}
