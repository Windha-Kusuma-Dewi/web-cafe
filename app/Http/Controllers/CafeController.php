<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cafe;

class CafeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $cafes = Cafe::where('name', 'LIKE', '%'.$request->search.'%')->orderBy('name', 'ASC')
        ->simplePaginate(5);
        return view('cafe.home', compact('cafes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view(view: 'cafe.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
        ], [
            'type.required' => 'Type of drink must be filled!',
            'name.required' => 'drink name must be filled in!',
            'price.required' => 'Drink price must be filled in!',
            'price.numeric' => 'Drink prices must be numbers!', 
            'stock.required' => 'Drink stock must be filled!',
            'stock.numeric' => 'Drink stock must be in large quantities!', 
        ]);
    
        // Menambahkan data ke database
        $proses = Cafe::create([
            'name' => $request->name,
            'type' => $request->type,
            'price' => $request->price,
            'stock' => $request->stock,
        ]);
        //jika Medicine::create berhasil (if), jika gagal (else)
        if ($proses) {
            return redirect()->route('home')->with('success', 'Drink data successfully added!');
        } else {
            return redirect()->route('cafes.add')->with('failed', 'Failed to add drink data!');
        }
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
    public function edit($id)
    {
        //
        $cafe = Cafe::where('id', $id)->first();
        return view('cafe.edit', compact('cafe'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'type' => 'required',
            'name' => 'required|min:2|max:20',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
        ]);

        $cafeBefore = Cafe::where('id', $id)->first();

        $proses = $cafeBefore->update([
            'type' => $request->type,
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
        ]);

        if ($proses) {
            return redirect()->route('home')->with('success', 'data has been successfully changed');
        } else {
            return redirect()->route('cafes.edit')->with('failed, failed to change data');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $proses = Cafe::where('id', $id)->delete();
        if ($proses) {
            return redirect()->back()->with('success', 'Drink data successfully deleted!');
        } else {
            return redirect()->back()->with('failed', 'failed to delete drink data!');
        }
    }
}
