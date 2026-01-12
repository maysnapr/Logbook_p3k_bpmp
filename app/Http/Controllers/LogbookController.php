<?php

namespace App\Http\Controllers;

use App\Models\Logbook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogbookController extends Controller
{
    // Dashboard: Statistik User + Feed Random
    public function dashboard()
    {
        $user = Auth::user();
        
        // 1. Data untuk Statistik (Pribadi/Admin)
        $queryStats = str_contains($user->email, 'admin') ? Logbook::query() : Logbook::where('user_id', $user->id);
        $logs = $queryStats->orderBy('tanggal', 'desc')->get();

        // 2. Data Feed Galeri (Random dari SEMUA pegawai)
        // Mengambil 6 data acak untuk ditampilkan seperti postingan
        $feedLogs = Logbook::with('user')
                           ->inRandomOrder()
                           ->limit(6)
                           ->get();
        
        return view('dashboard', compact('logs', 'feedLogs'));
    }

    public function create()
    {
        return view('logbook.input');
    }

    public function history()
    {
        $user = Auth::user();
        $logs = Logbook::where('user_id', $user->id)->orderBy('tanggal', 'desc')->paginate(10);
        return view('logbook.history', compact('logs'));
    }

    public function adminMonitoring(Request $request)
    {
        $user = Auth::user();

        if (!str_contains($user->email, 'admin')) {
            return redirect()->route('dashboard')->with('error', 'Akses ditolak.');
        }

        $query = Logbook::with('user');

        if ($request->has('search')) {
            $search = $request->search;
            $query->whereHas('user', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        }

        $logs = $query->orderBy('tanggal', 'desc')->paginate(15);

        return view('admin.monitoring', compact('logs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'lokasi' => 'required|string',
            'sasaran_pekerjaan' => 'required|string',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'kegiatan' => 'required|string',
            'output' => 'required|string',
            'bukti_foto' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        $pathFoto = null;
        if ($request->hasFile('bukti_foto')) {
            $pathFoto = $request->file('bukti_foto')->store('bukti_kegiatan', 'public');
        }

        Logbook::create([
            'user_id' => Auth::id(),
            'tanggal' => $request->tanggal,
            'lokasi' => $request->lokasi,
            'sasaran_pekerjaan' => $request->sasaran_pekerjaan,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'kegiatan' => $request->kegiatan,
            'output' => $request->output,
            'bukti_foto' => $pathFoto,
        ]);

        return redirect()->route('logbook.history')->with('success', 'Kegiatan berhasil disimpan!');
    }
}