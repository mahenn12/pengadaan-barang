<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Session;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supplier = Supplier::all();
        return view('admin.supplier.index', compact('supplier'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.supplier.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validasi data
        $validated = $request->validate([
            'nama_supplier' => 'required',
            'no_telepon' => 'required',
            'alamat' => 'required',
        ]);

        $supplier = new Supplier;
        $supplier->nama_supplier = $request->nama_supplier;
        $supplier->no_telepon = $request->no_telepon;
        $supplier->alamat = $request->alamat;
        $supplier->save();

        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Berhasil menyimpan Supplier $supplier->nama_supplier"
        ]);

        return redirect()->route('supplier.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('admin.supplier.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //validasi data
        $validated = $request->validate([
            'nama_supplier' => 'required',
            'no_telepon' => 'required',
            'alamat' => 'required',
        ]);

        $supplier = Supplier::findOrFail($id);
        $supplier->nama_supplier = $request->nama_supplier;
        $supplier->no_telepon = $request->no_telepon;
        $supplier->alamat = $request->alamat;
        $supplier->save();

        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Berhasil mengedit Supplier $supplier->nama_supplier"
        ]);

        return redirect()->route('supplier.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supplier = Supplier::findOrFail($id);

        if(!Supplier::destroy($id)) {
            return redirect()->back();
        } else {
            Session::flash("flash_notification", [
                "level" => "success",
                "message" => "Berhasil menghapus Supplier $supplier->nama_supplier"
            ]);
            return redirect()->route('supplier.index');
        }

        $supplier->delete();
    }
}
