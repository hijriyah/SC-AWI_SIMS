<?php

namespace App\Http\Controllers;

use App\Models\SosialLink;
use Illuminate\Http\Request;
use App\Models\Role;

class SosialLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $adminSession = session('Admin_user');
        $specAdmin = auth()->user()->username;
        
        // role check
        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsName(session('role_name'));

        $query = SosialLink::query();
        
        if($request->has('search'))
        {
            $query->where('name', 'like', "%{$request->search}%");
        }

        $dataSosialLink = $query->paginate(10);

        if($request->ajax())
        {
            $html = view('Pages.pengaturan.sosiallink.partials.table', compact('dataSosialLink'))->render();
            return response()->json([
                'html' => $html
            ]);
            // return view('Pages.master.guru.guru', compact(['adminSession', 'specAdmin', 'listMenu', 'dataGuru']))->render();

        }

        return view('Pages.pengaturan.sosiallink.sosiallink', compact(['adminSession', 'specAdmin', 'listMenu', 'dataSosialLink']));
    }


    public function storePage()
    {
        $adminSession = session('Admin_user');
        $specAdmin = auth()->user()->username;
        
        // role check
        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsName(session('role_name'));

        return view('Pages.pengaturan.sosiallink.add', compact(['adminSession', 'specAdmin', 'listMenu']));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validation = $request->validate([
            'facebook' => 'required',
            'linkedin' => 'required',
            'twitter' => 'required',
            'google' => 'required'
        ], [
            'facebook.required' => 'facebook tidak boleh kosong',
            'linkedin.required' => 'facebook tidak boleh kosong',
            'twitter.required' => 'facebook tidak boleh kosong',
            'google.required' => 'facebook tidak boleh kosong',
        ]);

        $data = SosialLink::create([
            'facebook' => $request->facebook,
            'linkedin' => $request->linkedin,
            'twitter' => $request->twitter,
            'google' =>  $request->google
        ]);
        $data->save();

        return redirect()->route('pengaturan_sosiallink_page')->with('success', 'data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(SosialLink $sosialLink)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($uuid)
    {
        //
        $adminSession = session('Admin_user');
        $specAdmin = auth()->user()->username;
        
        // role check
        $roleCheck = new Role;
        $listMenu = $roleCheck->permissionsName(session('role_name'));

        $dataEdit = SosialLink::findByUuid($uuid);

        return view('Pages.pengaturan.sosiallink.edit', compact(['adminSession', 'specAdmin', 'listMenu', 'dataEdit']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $uuid)
    {
        //
        $data = SosialLink::findByUuid($uuid);
        $data->update($request->all());

        return redirect()->route('pengaturan_sosiallink_page')->with('success', 'data berhasil disimpan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($uuid)
    {
        //
        $data = SosialLink::findByUuid($uuid);

        if($data)
        {
            $data->delete();
            return redirect()->route('pengaturan_sosiallink_page')->with('success', 'data berhasil dihapus');
        }
        else {
            return redirect()->route('pengaturan_sosiallink_page')->with('error', 'data tidak ditemukan');
        }
    }
}
