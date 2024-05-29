<?php

namespace App\Http\Controllers;

use App\models\Guru;
use Illuminate\Http\Request;
use Storage;


class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $guru = Guru::latest()->paginate(5);
        return view('guru.index', compact('guru'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('guru.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
                //validate form
                $this->validate($request, [
                    'nip' => 'required|min:5',
                    'nama_guru' => 'required|min:5',
                    'jenis_kelamin' => 'required',
                    'agama' => 'required',
                    'tempat_lahir' => 'required',
                    'tanggal_lahir' => 'required',
                    'foto' => 'required',
                ]);

                $guru = new guru();
                $guru -> nip = $request -> nip;
                $guru -> nama_guru = $request -> nama_guru;
                $guru -> jenis_kelamin = $request -> jenis_kelamin;
                $guru -> agama = $request -> agama;
                $guru -> tempat_lahir = $request -> tempat_lahir;
                $guru -> tanggal_lahir = $request -> tanggal_lahir;

                //upload foto
                $image = $request -> file ('foto');
                $image->storeAs('public/gurus/', $image->hashName());
                $guru->foto = $image->hashName();
                $guru->save();
                return redirect()->route('guru.index');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $guru = Guru::findOrFail($id);
        return view('guru.show', compact('guru'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $guru = Guru::findOrFail($id);
        return view('guru.edit', compact('guru'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nip' => 'required',
            'nama_guru' => 'required',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'foto' => 'required|file|max:1024',
        ]);

        $guru=Guru:: findOrFail($id);
        $guru -> nip = $request -> nip;
        $guru -> nama_guru = $request -> nama_guru;
        $guru -> jenis_kelamin = $request -> jenis_kelamin;
        $guru -> agama = $request -> agama;
        $guru -> tempat_lahir = $request -> tempat_lahir;
        $guru -> tanggal_lahir = $request -> tanggal_lahir;

         //upload foto
         $image = $request -> file ('foto');
         $image->storeAs('public/gurus/' , $image->hashName());

         //delete old image
         Storage::delete('public/gurus/' . $guru->foto);


         $guru->foto = $image->hashName();
         $guru->save();
         return redirect()->route('guru.index');

    }

    public function destroy($id)
    {
        $guru = Guru::findOrFail($id);
        Storage::delete('public/gurus/' . $guru->foto);
        $guru->delete();
        return redirect()->route('guru.index');

    }
}
