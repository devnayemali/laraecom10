<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sections = Section::latest()->get();
        return view('admin.modules.section.index', compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.modules.section.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->isMethod('POST')) {
            $rules = [
                'name' => 'required|string|max:255',
                'status' => 'required'
            ];
            $messages = [
                'name.required' => 'Section Name is required',
                'status.required' => 'Status is required'
            ];
            $this->validate($request, $rules, $messages);
            $data = $request->except(['_token']);
            Section::create($data);
            session()->flash('cls', 'success');
            session()->flash('msg', 'Section Created Successfully.');
            return redirect()->route('admin.section-index');
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $data = $request->all();
        Section::where('id', $data['id'])->update(['name' => $data['name']]);
        session()->flash('cls', 'success');
        session()->flash('msg', 'Section Updated Successfully');
        return redirect()->route('admin.section-index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $section = Section::findOrFail($id);
        $section->delete();
        if ($section){
            $status = 1;
        }else{
            $status = 0;
        }
        return response()->json($status);
    }

    public function section_status(Request $request)
    {
        $data = $request->all();
        if ($data['section_status'] == 1) {
            $status = 1;
        }else{
            $status = 0;
        }
        Section::where('id', $data['section_id'])->update(['status' => $status]);
        return response()->json($status);
    }

}
