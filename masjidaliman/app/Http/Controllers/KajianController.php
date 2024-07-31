<?php

namespace App\Http\Controllers;

use App\Models\Kajian;
use Illuminate\Http\Request;

class KajianController extends Controller
{
    public function index()
    {
        $kajians = Kajian::all();
        return view('kajians.index', compact('kajians'));
    }

    public function create()
    {
        return view('kajians.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'title' => 'required',
        'youtube_link' => 'required|url',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048' // Validasi untuk gambar
    ]);

    $input = $request->all();

    if ($image = $request->file('image')) {
        $destinationPath = 'images/';
        $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
        $image->move($destinationPath, $profileImage);
        $input['image'] = "$profileImage";
    }

    Kajian::create($input);

    return redirect()->route('kajians.index')
                        ->with('success', 'Kajian created successfully.');
}


    public function show(Kajian $kajian)
    {
        return view('kajians.show', compact('kajian'));
    }

    public function edit(Kajian $kajian)
    {
        return view('kajians.edit', compact('kajian'));
    }

    public function update(Request $request, Kajian $kajian)
{
    $request->validate([
        'title' => 'required',
        'youtube_link' => 'required|url',
        'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048' // Validasi untuk gambar
    ]);

    $input = $request->all();

    if ($image = $request->file('image')) {
        $destinationPath = 'images/';
        $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
        $image->move($destinationPath, $profileImage);
        $input['image'] = "$profileImage";

        // Delete old image
        if ($kajian->image && file_exists($destinationPath . $kajian->image)) {
            unlink($destinationPath . $kajian->image);
        }
    } else {
        unset($input['image']);
    }

    $kajian->update($input);

    return redirect()->route('kajians.index')
                        ->with('success', 'Kajian updated successfully.');
}


    public function destroy(Kajian $kajian)
    {
        $kajian->delete();
        return redirect()->route('kajians.index')
                            ->with('success', 'Kajian deleted successfully.');
    }
}
