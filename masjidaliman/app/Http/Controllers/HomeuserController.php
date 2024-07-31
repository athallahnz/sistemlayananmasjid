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
        //debug, jalan gak lu :'(
        Log::info('Store method called');

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
            Log::info('Validation failed: ', $validator->errors()->all());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('uploads', 'public');
        }

        $userId = Auth::id(); // get id yang masuk skrg
        Log::info('User ID for storing: ' . $userId);
        Log::info('Request data: ', $request->all());
        Log::info('File path: ' . $filePath);

        // debugging part 1 untuk insert data
        Log::info('Data to insert: ', [
            'nama' => $request->nama,
            'nomor' => $request->nomor,
            'infaq_id' => $request->infaq,
            'file_path' => $filePath,
            'user_id' => $userId
        ]);

        // catch error
        try {
            //debug part 2
            Log::info('Inserting data for user');

            DB::table('jamaahs')->insert([
                'nama' => $request->nama,
                'nomor' => $request->nomor,
                'infaq_id' => $request->infaq,
                'file_path' => $filePath,
                'user_id' => $userId, // GET DATA GAK LUUUU
            ]);
    // debug
            Log::info('Data inserted for user');
        } catch (\Exception $e) {
            // debug kalo eror
            Log::error('Error inserting data: ' . $e->getMessage());
        }
    //debug kalo store berhasil
        Log::info('Store method completed');

        Alert::success('Added Successfully', 'Infaq Added Successfully.');

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
