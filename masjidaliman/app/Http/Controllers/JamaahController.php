<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Jamaah;
use App\Models\Infaq;
use RealRashid\SweetAlert\Facades\Alert;

class JamaahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, JadwalsholatController $jadwalsholatController)
    {
        $search = $request->query('search');

        // Fetch Jamaahs with joined Infaqs
        $query = DB::table('jamaahs')
            ->join('infaqs', 'jamaahs.infaq_id', '=', 'infaqs.id')
            ->select('jamaahs.*', 'infaqs.name as infaq_name');

        // Apply search filter if search term is provided
        if ($search) {
            $query->where('jamaahs.nama', 'like', '%' . $search . '%');
        }

        $jamaahs = $query->get();

        // Example of fetching prayer schedule data
        $defaultCityId = 1638; // ID kota Surabaya
        $jadwalDefault = $jadwalsholatController->getJadwalSholat($defaultCityId);

        return view('home', compact('jamaahs', 'jadwalDefault', 'search'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request, JadwalsholatController $jadwalsholatController)
    {
        $searchCity = $request->query('search_city');

        // RAW SQL Query for fetching infaqs
        $infaqsQuery = DB::table('infaqs');

        // Apply search filter if search term is provided
        if ($searchCity) {
            $infaqsQuery->where('name', 'like', '%' . $searchCity . '%');
        }

        $infaqs = $infaqsQuery->get();

        // Example of fetching prayer schedule data
        $defaultCityId = 1638; // ID kota Surabaya
        $jadwalDefault = $jadwalsholatController->getJadwalSholat($defaultCityId);

        return view('welcome', compact('infaqs', 'jadwalDefault', 'searchCity'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'required' => ':Attribute harus diisi.',
            'numeric' => 'Isi :attribute dengan angka',
            'file' => 'Upload bukti transfermu.',
            'mimes' => 'Format file harus jpg, jpeg, png, atau pdf.',
        ];

        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'nomor' => 'required|numeric',
            'infaq' => 'required',
            'file' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048', // Tambahkan validasi untuk file
        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('uploads', 'public');
        }

        // INSERT QUERY
        $userId = Auth::id();
        DB::table('jamaahs')->insert([
            'user_id'=> $request->$userId,
            'nama' => $request->nama,
            'nomor' => $request->nomor,
            'infaq_id' => $request->infaq,
            'file_path' => $filePath, // Simpan path file ke database
        ]);

        Alert::success('Added Successfully', 'Infaq Added Successfully.');

        return redirect()->route('home');
    }

    // Other methods (show, edit, update, destroy) can remain as placeholders if not used immediately


    public function show(string $id)
    {
        // ELOQUENT
        $jamaahs = Jamaah::find($id);
        return view('infaq.show', compact('jamaahs'));

        // Generating a URL
        $url = route('infaq.show', ['id' => 1]);

        // Redirecting to a route
        return redirect()->route('infaq.show', ['id' => 1]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // ELOQUENT
    $infaqs = Infaq::all();
    $jamaahs = Jamaah::find($id);
    return view('infaq.edit', compact('infaqs', 'jamaahs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $messages = [
            'required' => ':Attribute harus diisi.',
            'numeric' => 'Isi :attribute dengan angka',
            'file' => 'Upload bukti transfermu.',
            'mimes' => 'Format file harus jpg, jpeg, png, atau pdf.',
        ];

        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'nomor' => 'required|numeric',
            'infaq' => 'required',
            'file' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048', // Tambahkan validasi untuk file
        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('uploads', 'public');
        }

        // INSERT QUERY
        DB::table('jamaahs')->insert([
            'nama' => $request->nama,
            'nomor' => $request->nomor,
            'infaq_id' => $request->infaq,
            'file_path' => $filePath, // Simpan path file ke database
        ]);

        return redirect()->route('home');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // ELOQUENT
    Jamaah::find($id)->delete();

    Alert::success('Deleted Successfully', 'Infaq Deleted Successfully.');

    return redirect()->route('home');

    // Find the infaq entry by id and delete it
    $jamaahs = Jamaah::findOrFail($id);
    $jamaahs->delete();

    // Redirect or return response
    // return view('home');

    }
}
