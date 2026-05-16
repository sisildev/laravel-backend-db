<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Riwayat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RiwayatController extends Controller
{

    public function index(Request $request)
    {
        $riwayat = Riwayat::where('user_id', $request->user()->id)
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(fn($r) => $this->_format($r));
        return response()->json(['success' => true, 'data' => $riwayat]);
    }

    public function store(Request $request)
    {
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('scans', 'public');
        }
        $riwayat = Riwayat::create([
            'user_id' => $request->user()->id,
            'label' => $request->label,
            'confidence' => $request->confidence,
            'image_path' => $imagePath,
            'all_predictions' => json_decode($request->all_predictions ?? '[]', true),
        ]);
        return response()->json(['success' => true, 'data' => $this->_format($riwayat)], 201);
    }

    public function destroy(Request $request, $id)
    {
        $riwayat = Riwayat::where('user_id', $request->user()->id)->findOrFail($id);
        if ($riwayat->image_path) {
            Storage::disk('public')->delete($riwayat->image_path);
        }
        $riwayat->delete();
        return response()->json(['success' => true, 'message' => 'Riwayat dihapus']);
    }

    public function destroyAll(Request $request)
    {
        $all = Riwayat::where('user_id', $request->user()->id)->get();
        foreach ($all as $r) {
            if ($r->image_path)
                Storage::disk('public')->delete($r->image_path);
        }
        Riwayat::where('user_id', $request->user()->id)->delete();
        return response()->json(['success' => true, 'message' => 'Semua riwayat dihapus']);
    }

    public function stats(Request $request)
    {
        $userId = $request->user()->id;
        $total = Riwayat::where('user_id', $userId)->count();
        $sehat = Riwayat::where('user_id', $userId)->where('label', 'like', '%sehat%')->count();
        $moler = Riwayat::where('user_id', $userId)->where('label', 'like', '%moler%')->count();
        $busuk = Riwayat::where('user_id', $userId)->where('label', 'like', '%busuk%')->count();
        $trotol = Riwayat::where('user_id', $userId)->where('label', 'like', '%trotol%')->count();
        return response()->json([
            'success' => true,
            'data' => [
                'total' => $total,
                'sehat' => $sehat,
                'moler' => $moler,
                'busuk_daun' => $busuk,
                'trotol' => $trotol,
            ]
        ]);
    }

    private function _format(Riwayat $r): array
    {
        $baseUrl = config('app.url');

        return [
            'id' => $r->id,
            'label' => $r->label,
            'confidence' => $r->confidence,
            'image_url' => $r->image_path ? $baseUrl . '/storage/' . $r->image_path : null,
            'all_predictions' => $r->all_predictions ?? [],
            'created_at' => $r->created_at->toIso8601String(),
        ];
    }
}