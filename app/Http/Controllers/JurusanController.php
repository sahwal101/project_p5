<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;
use Validator;

class JurusanController extends Controller
{

    public function index()
    {
        // index
        $jurusan = Jurusan::latest()->get();
        return view ('jurusan.index', compact('jurusan'));
    }

    public function create()
    {
        //create
        return view ('jurusan.create');
    }

    public function store(Request $request)
    {
        //validate form
        $this->validate($request,[
            'nama_jurusan' => 'required',
        ]);

        $jurusan = new Jurusan();
        $jurusan->nama_jurusan = $request->nama_jurusan;

        $jurusan->save();
        return redirect()->route('jurusan.index');
    }


    public function show($id)
    {
        //show
        $jurusan = Jurusan::findOrFail($id);
        return view('jurusan.show', compact('jurusan'));
    }

    public function edit($id)
    {
        //edit
        $jurusan = Jurusan::findOrFail($id);
        return view('jurusan.edit', compact('jurusan'));
    }

    public function update(Request $request, $id)
    {
        // validate form
        $this->validate($request, [
            'nama_jurusan' => 'required',
        ]);

        // find the jurusan record
        $jurusan = Jurusan::findOrFail($id);
        $jurusan->nama_jurusan = $request->nama_jurusan;

        $jurusan->save();
        return redirect()->route('jurusan.index');
    }


    public function destroy($id)
    {
        //delete
        $jurusan = Jurusan::findOrFail($id);
        $jurusan->delete();
        return redirect()->route('jurusan.index');
    }
}
