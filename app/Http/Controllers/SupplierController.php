<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Http\Requests\StoreSupplierRequest;
use App\Http\Requests\UpdateSupplierRequest;

use Illuminate\Foundation\Http\FormRequest;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //query data
        $supplier = Supplier::all();
        return view('supplier.view',
                    [
                        'supplier' => $supplier
                    ]
                  );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       // berikan kode supplier secara otomatis
        // 1. query dulu ke db, select max untuk mengetahui posisi terakhir 
        
        return view('supplier/create',
                    [
                        'kode_supplier' => Supplier::getKodeSupplier()
                    ]
                  );
        // return view('supplier/view');
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSupplierRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSupplierRequest $request)
    {
        //digunakan untuk validasi kemudian kalau ok tidak ada masalah baru disimpan ke db
        $validated = $request->validate([
            'kode_supplier' => 'required',
            'nama_supplier' => 'required|unique:supplier|min:1|max:255',
            'nama_perusahaan' => 'required|unique:supplier|min:1|max:255',
            'alamat' => 'required',
            'cp' => 'required',
        ]);

        // masukkan ke db
        Supplier::create($request->all());
        
        $notification = array(
            'message' => 'Data supplier berhasil ditambah!',
            'alert-type' => 'success'
        );
 
        return redirect()->route('supplier.index')->with($notification);
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
    public function edit(Supplier $supplier)
    {
        return view('supplier.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSupplierRequest  $request
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSupplierRequest $request, Supplier $supplier)
    {
        //digunakan untuk validasi kemudian kalau ok tidak ada masalah baru diupdate ke db
        $validated = $request->validate([
            'kode_supplier' => 'required',
            'nama_supplier' => 'required|max:255',
            'nama_perusahaan' => 'required|max:255',
            'alamat' => 'required',
            'cp' => 'required',
        ]);
    
        $supplier->update($validated);
    
        $notification = array(
            'message' => 'Data supplier berhasil diubah!',
            'alert-type' => 'success'
        );

        return redirect()->route('supplier.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //hapus dari database
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();

        $notification = array(
            'message' => 'Data supplier berhasil dihapus!',
            'alert-type' => 'success'
        );

        return redirect()->route('supplier.index')->with($notification);
    }

}
