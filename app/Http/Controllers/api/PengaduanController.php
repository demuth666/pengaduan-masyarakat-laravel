<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengaduan;
use App\Helpers\APIFormatter;

class PengaduanController extends Controller
{
    public function create(Request $request) {
        try {
            $request->validate([
                'user_id' => 'required',
                'aduan' => 'required',
                'bukti' => 'required|mimes:jpeg,png,jpg,mp3,wav,mp4|max:20480',
            ]);

            $tanggal = date('Y-m-d H:i:s');

            $path = $request->file('bukti')->store('bukti', 'public');

            $pengaduan = Pengaduan::create([
                'user_id' => $request->user_id,
                'aduan' => $request->aduan,
                'tanggal' => $tanggal,
                'status' => "Belum Ditinjau",
                'bukti' => $path,
            ]);

            if($pengaduan) {
                return APIFormatter::createAPI(200, "Success", $pengaduan);
            } else {
                return APIFormatter::createAPI(400, 'Failed');
            }
        } catch (Throwable $th) {
            return APIFormatter::createAPI(500, 'Failed', $th);
        }
    }
}