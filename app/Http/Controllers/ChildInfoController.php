<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ChildInfo;

class ChildInfoController extends Controller
{
    const LGUS = [
        'Alegria','Bacuag','Burgos','Claver','Dapa','Del Carmen','General Luna',
        'Gigaquit','Mainit','Malimono','Pilar','Placer','San Benito','San Franciso',
        'San Isidro','Santa Monica','Sison','Socorro','Surigao City','Tagana-an','Tubod'
    ];

    public function index(Request $request)
    {
        $query = ChildInfo::query();
        
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('lgu_name', 'like', '%' . $request->search . '%');
        }
        
        $children = $query->orderBy('created_at', 'desc')->paginate(15);
        $lgus = self::LGUS;
        sort($lgus);
        
        return view('children.index', compact('children', 'lgus'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:0',
            'lgu_name' => 'required|string|max:100',
        ]);

        ChildInfo::create($data);

        return redirect()->route('children.index')->with('success', 'Child record added successfully.');
    }

    public function update(Request $request, $id)
    {
        $child = ChildInfo::findOrFail($id);
        
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:0',
            'lgu_name' => 'required|string|max:100',
        ]);

        $child->update($data);

        return redirect()->route('children.index')->with('success', 'Child record updated successfully.');
    }

    public function destroy($id)
    {
        ChildInfo::findOrFail($id)->delete();
        return redirect()->route('children.index')->with('success', 'Child record deleted.');
    }
}
