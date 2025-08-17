<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterWilayah;
use App\Models\Agen;
use Illuminate\Support\Facades\Http;

class RegistrationController extends Controller
{
    public function index(Request $request)
    {

        $title = 'Tentang Kami';

        $provinsi = MasterWilayah::whereRaw('CHAR_LENGTH(REPLACE(kode, ".", "")) = 2')->get();

        return view('frontend.pages.agent-register', compact('title', 'provinsi'));
    }

    public function form_registrasi_agen(Request $request)
    {

        $title = 'Tentang Kami';

        $provinsi = MasterWilayah::whereRaw('CHAR_LENGTH(REPLACE(kode, ".", "")) = 2')->get();

        return view('frontend.pages.agen-register-form', compact('title', 'provinsi'));
    }

    public function store(Request $request)
    {
        $request->merge([
            'nilai_ipk' => str_replace(',', '.', $request->nilai_ipk),
        ]);

        $request->validate(
            [
                // Identitas
                'nama_lengkap' => 'required|string|max:100',
                'gender' => 'required|in:Laki-laki,Perempuan',
                'birth_city' => 'required|string|max:100',
                'birth_date' => 'required|date',
                'no_hp' => 'required|string|max:20',
                'email' => 'required|email|unique:agens,email',
                'social_media' => 'required|string',
                'social_media_id' => ['required', 'string', 'regex:/^@.+$/'],

                // Alamat
                'alamat_lengkap' => 'required|string',
                'kode_pos' => 'required|string|max:10',

                // Pendidikan
                'pendidikan' => 'required|string',
                'nama_sekolah' => 'required|string',
                'tahun_lulus' => 'required|digits:4',
                'nilai_ipk' => 'required|numeric|min:0|max:100',
                'sertifikat_kompetensi' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',

                // Pekerjaan
                'nama_perusahaan' => 'required|string',
                'tahun_masuk' => 'required|digits:4',
                'tahun_keluar' => 'required|digits:4|gte:tahun_masuk',
                'alasan_keluar' => 'required|string',

                // Dokumen
                'kartu_nama' => 'required|file|image|max:2048',
                'pas_foto' => 'required|file|image|max:2048',
                'ktp' => 'required|file|image|max:2048',
                'cv' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',

                'perjanjian' => 'accepted',

                'g-recaptcha-response' => ['required', function ($attribute, $value, $fail) {
                    $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                        'secret' => env('RECAPTCHA_SECRET_KEY'),
                        'response' => $value,
                    ]);

                    if (!optional($response->json())['success']) {
                        $fail('Captcha tidak valid. Silakan coba lagi.');
                    }
                }],
            ],
            [
                'social_media_id.required' => 'ID media sosial wajib diisi dan menggunakan tanda @ di awal.',
                'social_media_id.regex' => 'ID media sosial harus diawali dengan @ (misal: @username).',
                'nilai_ipk.required' => 'Nilai wajib diisi.',
                'nilai_ipk.numeric' => 'Nilai harus berupa angka.',
                'nilai_ipk.min' => 'Nilai minimal adalah 0.',
                'nilai_ipk.max' => 'Nilai maksimal adalah 100.',
            ]
        );

        // Upload dokumen
        $pas_foto = $request->file('pas_foto')->store('dokumen/pas_foto', 'public');
        $ktp = $request->file('ktp')->store('dokumen/ktp', 'public');
        $cv = $request->file('cv')->store('dokumen/cv', 'public');

        $sertifikat = null;
        if ($request->hasFile('sertifikat_kompetensi')) {
            $sertifikat = $request->file('sertifikat_kompetensi')->store('dokumen/sertifikat', 'public');
        }

        // Simpan ke database
        Agen::create([
            'nama_lengkap' => $request->nama_lengkap,
            'gender' => $request->gender,
            'birth_city' => $request->birth_city,
            'birth_date' => $request->birth_date,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'social_media' => $request->social_media,
            'social_media_id' => $request->social_media_id,
            'alamat_lengkap' => $request->alamat_lengkap,
            'kode_pos' => $request->kode_pos,
            'pendidikan' => $request->pendidikan,
            'nama_sekolah' => $request->nama_sekolah,
            'tahun_lulus' => $request->tahun_lulus,
            'nilai_ipk' => $request->nilai_ipk,
            'sertifikat_kompetensi' => $sertifikat,
            'nama_perusahaan' => $request->nama_perusahaan,
            'tahun_masuk' => $request->tahun_masuk,
            'tahun_keluar' => $request->tahun_keluar,
            'alasan_keluar' => $request->alasan_keluar,
            'pas_foto' => $pas_foto,
            'ktp' => $ktp,
            'cv' => $cv,
            'perjanjian' => true,
            'status' => 'Pending',
        ]);

        return back()->with('success', 'Pendaftaran berhasil dikirim.');
    }
}
