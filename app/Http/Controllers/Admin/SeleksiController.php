<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Services\SeleksiService;
use App\Http\Requests\StoreSeleksiRequest;
use Illuminate\Http\Request;

class SeleksiController extends Controller
{
    protected $seleksiService;

    public function __construct(SeleksiService $seleksiService)
    {
        $this->seleksiService = $seleksiService;
    }

    public function index(Request $request)
    {
        $kriterias = $this->seleksiService->getAllKriteria();
        $pesertas = $this->seleksiService->getPesertaWithScores($request->search);

        return view('admin.seleksi.index', compact('pesertas', 'kriterias'));
    }

    public function show($id)
    {
        $pendaftaran = $this->seleksiService->getPendaftaranDetail($id);
        $kriterias = $this->seleksiService->getAllKriteria();

        return view('admin.seleksi.show', compact('pendaftaran', 'kriterias'));
    }

    public function store(StoreSeleksiRequest $request, $id)
    {
        $this->seleksiService->storeScore($id, $request->validated());

        return redirect()->back()->with('success', 'Nilai seleksi berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        $this->seleksiService->deleteScore($id);

        return redirect()->back()->with('success', 'Nilai seleksi berhasil dihapus.');
    }
}
