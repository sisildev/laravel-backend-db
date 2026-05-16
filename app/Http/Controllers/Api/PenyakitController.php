<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Penyakit;

class PenyakitController extends Controller {
    public function index() {
        return response()->json(['success' => true, 'data' => Penyakit::all()]);
    }
    public function show($slug) {
        $p = Penyakit::where('slug', $slug)->firstOrFail();
        return response()->json(['success' => true, 'data' => $p]);
    }
}