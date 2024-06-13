<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Jamaah;
use App\Models\Infaq;


class JamaahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // RAW SQL QUERY
        $jamaahs = DB::select('
        select *, jamaahs.id as jamaah_id, infaqs.name as
        infaq_name
        from jamaahs
        left join infaqs on jamaahs.infaq_id = infaqs.id
        ');
        return view('home', [
        'jamaahs' => $jamaahs
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    // RAW SQL Query
    $infaqs = DB::select('select * from infaqs');

    return view('welcome', compact('infaqs'));
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $messages = [
        'required' => ':Attribute harus diisi.',
        'numeric' => 'Isi :attribute dengan angka'
    ];

    $validator = Validator::make($request->all(), [
        'nama' => 'required',
        'nomor' => 'required|numeric',
        'Infaq' => 'required',
    ], $messages);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // INSERT QUERY
    DB::table('jamaahs')->insert([
        'nama' => $request->nama,
        'nomor' => $request->nomor,
        'infaq_id' => $request->infaq,
        ]);
        return redirect()->route('welcome');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
