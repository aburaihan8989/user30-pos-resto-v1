<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CostController extends Controller
{
    public function index(Request $request)
    {
        //get data products
        $costs = DB::table('costs')
            ->when($request->input('name'), function ($query, $name) {
                return $query->where('name', 'like', '%' . $name . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        //sort by created_at desc

        return view('pages.costs.index', compact('costs'));
    }

    public function create()
    {
        return view('pages.costs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|integer'
        ]);

        $data = $request->all();

        $cost = new \App\Models\Cost;
        $cost->name = $request->name;
        $cost->price = (int) $request->price;
        $cost->description = $request->description;
        $cost->save();

        return redirect()->route('cost.index')->with('success', 'Cost successfully created');
    }

    public function edit($id)
    {
        $cost = \App\Models\Cost::findOrFail($id);
        return view('pages.costs.edit', compact('cost'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|integer'
        ]);

        $data = $request->all();

        $cost = \App\Models\Cost::findOrFail($id);
        $cost->name = $request->name;
        $cost->price = (int) $request->price;
        $cost->description = $request->description;
        $cost->update();

        return redirect()->route('cost.index')->with('success', 'Cost successfully updated');
    }

    public function destroy($id)
    {
        $cost = \App\Models\Cost::findOrFail($id);
        $cost->delete();
        return redirect()->route('cost.index')->with('success', 'Cost successfully deleted');
    }
}
