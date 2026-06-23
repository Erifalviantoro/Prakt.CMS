public function index($id)
{
    $teknisi = Teknisi::findOrFail($id);

    $servis = DetailServis::with('booking')
        ->where('teknisi_id', $id)
        ->latest()
        ->get();

    // 🔥 STATISTIK
    $total = DetailServis::where('teknisi_id', $id)->count();

    $antrian = DetailServis::where('teknisi_id', $id)
        ->where('status_servis', 'antrian')
        ->count();

    $proses = DetailServis::where('teknisi_id', $id)
        ->where('status_servis', 'proses')
        ->count();

    $selesai = DetailServis::where('teknisi_id', $id)
        ->where('status_servis', 'selesai')
        ->count();

    return view('teknisi.dashboard', compact(
        'teknisi',
        'servis',
        'total',
        'antrian',
        'proses',
        'selesai'
    ));
}