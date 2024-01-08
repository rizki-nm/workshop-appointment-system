<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Drug;
use Illuminate\Http\Request;

class DrugController extends Controller
{
    public function index()
    {
        $drugs = Drug::all();
        return view('dashboard.admin.drug.index', compact('drugs'));
    }

    public function store(Request $request)
    {
            $validation = $request->validate([
                'name' => 'required',
                'packaging' => 'required',
                'price' => 'required|numeric|min:1',
            ]);

        if ($request->code == null) {
            $code = 'DRG' . rand(1000, 9999);
            $validation['code'] = $code;
        } else {
            $code = Drug::where('code', $request->code)->first();
            if ($code) {
                $notification = array(
                    'status' => 'error',
                    'title' => 'Kode obat sudah digunakan',
                    'message' => 'Kode obat sudah digunakan'
                );
                return back()->with($notification);
            } else {
                $validation['code'] = $request->code;
            }
        }

        Drug::create($validation);

        $notification = array(
            'status' => 'toast_success',
            'title' => 'Data obat berhasil ditambahkan',
            'message' => 'Data obat berhasil ditambahkan'
        );

        return redirect()->route('dashboard.admin.drug.index')->with($notification);
    }

    public function update(Request $request, $id)
    {
        $drug = Drug::findOrfail($id);

        $validation = $request->validate([
            'name' => 'required',
            'packaging' => 'required',
            'price' => 'required|numeric|min:1',
        ]);

        if ($request->code == $drug->code) {
            $validation['code'] = $request->code;
        } else {
            $code = Drug::where('code', $request->code)->first();
            if ($code) {
                $notification = array(
                    'status' => 'error',
                    'title' => 'Kode obat sudah digunakan',
                    'message' => 'Kode obat sudah digunakan'
                );
                return back()->with($notification);
            } else {
                $validation['code'] = $request->code;
            }
        }


        $drug->update($validation);

        $notification = array(
            'status' => 'toast_success',
            'title' => 'Data obat berhasil diubah',
            'message' => 'Data obat berhasil diubah'
        );

        return redirect()->route('dashboard.admin.drug.index')->with($notification);
    }

    public function destroy($id)
    {
        $drug = Drug::findOrfail($id);

        $drug->delete();

        $notification = array(
            'status' => 'toast_success',
            'title' => 'Data obat berhasil dihapus',
            'message' => 'Data obat berhasil dihapus'
        );

        return redirect()->route('dashboard.admin.drug.index')->with($notification);
    }
}
