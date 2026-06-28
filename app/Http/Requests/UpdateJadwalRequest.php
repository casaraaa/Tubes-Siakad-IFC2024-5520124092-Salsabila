<?php

namespace App\Http\Requests;

class UpdateJadwalRequest extends StoreJadwalRequest
{
    // Aturan validasi jadwal identik antara tambah dan ubah,
    // sehingga cukup mewarisi StoreJadwalRequest tanpa perubahan apa pun.
}
