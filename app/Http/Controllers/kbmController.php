<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreKbmRequest;
use App\Services\KbmService;

class kbmController extends Controller
{
    protected $service;

    public function __construct(KbmService $service)
    {
        $this->service = $service;
    }

    //
    public function index(Request $request)
    {
        // Selalu tampilkan semua jadwal KBM tanpa filter berdasarkan role,
        // hanya mendukung filter Hari dan pencarian teks.
        $query = \App\Models\Kbm::query()->with(['guru', 'walas']);

        if ($request->filled('hari')) {
            $query->where('hari', $request->get('hari'));
        }

        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('hari', 'like', "%{$search}%")
                  ->orWhere('mulai', 'like', "%{$search}%")
                  ->orWhere('selesai', 'like', "%{$search}%")
                  ->orWhereHas('guru', function ($guruQuery) use ($search) {
                      $guruQuery->where('nama', 'like', "%{$search}%")
                                ->orWhere('mapel', 'like', "%{$search}%");
                  })
                  ->orWhereHas('walas', function ($walasQuery) use ($search) {
                      $walasQuery->where('jenjang', 'like', "%{$search}%")
                                 ->orWhere('namakelas', 'like', "%{$search}%")
                                 ->orWhereRaw("LOWER(CONCAT(REPLACE(jenjang, ' ', ''), REPLACE(namakelas, ' ', ''))) LIKE ?", [strtolower("%" . str_replace(' ', '', str_replace('-', '', $search)) . "%")])
                                 ->orWhereRaw("LOWER(CONCAT(jenjang, '-', namakelas)) LIKE ?", [strtolower("%{$search}%")]);
                  });
            });
        }

        $jadwals = $query->get();

        return view('jadwal.index', [
            'jadwals' => $jadwals,
        ]);
    }

    public function create()
    {
        $gurus = \App\Models\Guru::all();
        $walas = \App\Models\Walas::all();

        return view('jadwal.create', compact('gurus', 'walas'));
    }

    public function store(StoreKbmRequest $request)
    {
        $this->service->createKbm($request->validated());

        return redirect()->route('jadwal.index')->with('success', 'Jadwal KBM berhasil ditambahkan!');
    }

    public function jadwalGuru($idguru)
    {
        $guru = \App\Models\Guru::with(['kbm.walas', 'kbm.kelas'])->findOrFail($idguru);
        return view('jadwal.guru', compact('guru'));
    }

    public function jadwalKelas($idwalas)
    {
        $kelas = \App\Models\Kelas::with(['kbm.guru'])->findOrFail($idwalas);
        return view('jadwal.kelas', compact('kelas'));
    }

    public function searchKbm(Request $request)
    {
        // Ajax search tanpa filter role, hanya Hari dan teks.
        $query = \App\Models\Kbm::query()->with(['guru', 'walas']);

        if ($request->filled('hari')) {
            $query->where('hari', $request->get('hari'));
        }

        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('hari', 'like', "%{$search}%")
                  ->orWhere('mulai', 'like', "%{$search}%")
                  ->orWhere('selesai', 'like', "%{$search}%")
                  ->orWhereHas('guru', function ($guruQuery) use ($search) {
                      $guruQuery->where('nama', 'like', "%{$search}%")
                                ->orWhere('mapel', 'like', "%{$search}%");
                  })
                  ->orWhereHas('walas', function ($walasQuery) use ($search) {
                      $walasQuery->where('jenjang', 'like', "%{$search}%")
                                 ->orWhere('namakelas', 'like', "%{$search}%")
                                 ->orWhereRaw("LOWER(CONCAT(REPLACE(jenjang, ' ', ''), REPLACE(namakelas, ' ', ''))) LIKE ?", [strtolower("%" . str_replace(' ', '', str_replace('-', '', $search)) . "%")])
                                 ->orWhereRaw("LOWER(CONCAT(jenjang, '-', namakelas)) LIKE ?", [strtolower("%{$search}%")]);
                  });
            });
        }

        $jadwals = $query->get();

        return response()->json([
            'jadwals' => $jadwals,
        ]);
    }

}
