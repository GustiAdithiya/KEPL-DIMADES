<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\MitraRequest;
use App\Models\Mitra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;

class MitraController implements ControllerInterface
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Mitra::orderBy('name', 'ASC')->paginate(10);
        $this->data['data'] = $data;
        return view('admin.mitra.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.mitra.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            if (Mitra::create($request->all())) {
                Session::flash('success', 'Mitra has been saved');
            } else {
                Session::flash('error', 'Mitra could not be saved');
            }
            return redirect()->route('mitra.index');
        } catch (\Throwable $th) {
            Session::flash('error', "Periksa Kembali Isian");
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Mitra::findOrFail(Crypt::decrypt($id));
        $this->data['data'] = $data;
        return view('admin.mitra.edit', $this->data);
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
        try {
            $data = Mitra::findOrFail(Crypt::decrypt($id));
            if ($data->update($request->all())) {
                Session::flash('success', 'Mitra has been updated');
            } else {
                Session::flash('error', 'Mitra could not be update');
            }
            return redirect()->route('mitra.index');
        } catch (\Throwable $th) {
            Session::flash('error', "Periksa Kembali Isian");
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Mitra::findOrFail(Crypt::decrypt($id));
        if ($data->delete()) {
            Session::flash('success', 'Mitra has been deleted');
        } else {
            Session::flash('error', 'Mitra could not be delete');
        }
        return redirect()->route('mitra.index');
    }
}
