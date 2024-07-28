<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\DB;

use App\Models\Jamaah;

use App\Models\Infaq;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Log;

use RealRashid\SweetAlert\Facades\Alert;

class HomeuserController extends Controller

{

    /**

     * Display a listing of the resource.

     */

    public function index()

    {

        $userId = Auth::id();

        Log::info('Authenticated User ID: ' . $userId);

        $jamaahs = DB::table('jamaahs')

            ->join('infaqs', 'jamaahs.infaq_id', '=', 'infaqs.id')

            ->select('jamaahs.*', 'infaqs.name as infaq_name')

            ->where('jamaahs.user_id', $userId)

            ->get();

        return view('homeuser', compact('jamaahs'));

    }

    /**

     * Show the form for creating a new resource.

     */

    public function create()

    {

        $infaqs = Infaq::all();

        return view('infaq.create', compact('infaqs'));

    }

    /**

     * Store a newly created resource in storage.

     */

        public function store(Request $request)
        {
            $messages = [
                'required' => ':Attribute harus diisi.',
                'numeric' => 'Isi :attribute dengan angka.',
                'file' => 'Upload bukti transfermu.',
                'mimes' => 'Format file harus jpg, jpeg, png, atau pdf.',
            ];

            $validator = Validator::make($request->all(), [
                'nama' => 'required',
                'nomor' => 'required|numeric',
                'infaq' => 'required',
                'file' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            ], $messages);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $filePath = null;
            if ($request->hasFile('file')) {
                $filePath = $request->file('file')->store('uploads', 'public');
            }

            $userId = Auth::id(); // Mendapatkan ID pengguna yang sedang autentikasi

            Log::info('Storing Jamaah data with User ID: ' . $userId); // Log untuk debugging

            DB::table('jamaahs')->insert([
                'nama' => $request->nama,
                'nomor' => $request->nomor,
                'infaq_id' => $request->infaq,
                'file_path' => $filePath,
                'user_id' => $userId, // Menyimpan ID pengguna yang autentikasi
            ]);

            Alert::success('Added Successfully', 'Infaq Added Successfully.');

            return redirect()->route('homeuser.index');
        }

    /**

     * Display the specified resource.

     */

    public function show($id)

    {

        $userId = Auth::id();

        $jamaah = Jamaah::where('user_id', $userId)->findOrFail($id);

        return view('infaq.show', compact('jamaah'));

    }

    /**

     * Show the form for editing the specified resource.

     */

    public function edit($id)

    {

        $userId = Auth::id();

        $jamaah = Jamaah::where('user_id', $userId)->findOrFail($id);

        $infaqs = Infaq::all();

        return view('infaq.edit', compact('jamaah', 'infaqs'));

    }

    /**

     * Update the specified resource in storage.

     */

        public function update(Request $request, $id)
        {
            $messages = [
                'required' => ':Attribute harus diisi.',
                'numeric' => 'Isi :attribute dengan angka.',
                'file' => 'Upload bukti transfermu.',
                'mimes' => 'Format file harus jpg, jpeg, png, atau pdf.',
            ];

            $validator = Validator::make($request->all(), [
                'nama' => 'required',
                'nomor' => 'required|numeric',
                'infaq' => 'required',
                'file' => 'file|mimes:jpg,jpeg,png,pdf|max:2048',
            ], $messages);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $userId = Auth::id();

            Log::info('Updating Jamaah data with User ID: ' . $userId); // Log untuk debugging

            $jamaah = Jamaah::where('user_id', $userId)->findOrFail($id);

            if ($request->hasFile('file')) {
                $filePath = $request->file('file')->store('uploads', 'public');
                $jamaah->file_path = $filePath;
            }

            $jamaah->nama = $request->nama;
            $jamaah->nomor = $request->nomor;
            $jamaah->infaq_id = $request->infaq;
            $jamaah->save();

            Alert::success('Updated Successfully', 'Infaq Updated Successfully.');

            return redirect()->route('homeuser.index');
        }

    /**

     * Remove the specified resource from storage.

     */

    public function destroy($id)

    {

        $userId = Auth::id();

        $jamaah = Jamaah::where('user_id', $userId)->findOrFail($id);

        $jamaah->delete();

        Alert::success('Deleted Successfully', 'Infaq Deleted Successfully.');

        return redirect()->route('homeuser.index');

    }

}

