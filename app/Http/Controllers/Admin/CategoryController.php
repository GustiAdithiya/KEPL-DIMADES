<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Http\Controllers\Admin\ControllerInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;

class CategoryController implements ControllerInterface
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('name', 'ASC')->paginate();
        $this->data['categories'] = $categories;
        return view('admin.category.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
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
            if (Category::create($request->all())) {
                Session::flash('success', 'Category has been saved');
            } else {
                Session::flash('error', 'Category could not be saved');
            }
            return redirect()->route('category.index');
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
        $category = Category::findOrFail(Crypt::decrypt($id));
        $this->data['data'] = $category;
        return view('admin.category.edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($request, $id)
    {
        try {
            $category = Category::findOrFail(Crypt::decrypt($id));
            if ($category->update($request->all())) {
                Session::flash('success', 'Category has been saved');
            } else {
                Session::flash('error', 'Category could not be saved');
            }
            return redirect()->route('category.index');
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
        $category = Category::finOrFail(Crypt::decrypt($id));
        if ($category->delete()) {
            Session::flash('success', 'Category has been deleted');
        }
        return redirect()->route('category.index');
    }
}
