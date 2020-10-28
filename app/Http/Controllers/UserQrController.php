<?php

namespace App\Http\Controllers;

use App\Models\UserQr;
use Illuminate\Http\Request;

class UserQrController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users/userQr_table');
    }

    public function getUserQr()
    {
        $users = UserQr::paginate(20);

        return response()->json($users,200);
    }
    public function search($sreach)
    {
        $users = UserQr::where('id_number','LIKE','%'.$sreach.'%')
            ->orwhere('name','LIKE','%'.$sreach.'%')->paginate(20);
        return response()->json($users,200);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'id_number'=>'required|unique:user_qrs',
            'origin'=>'required',
        ],[
            'name.required'=>"الاسم الرباعي مطلوب",
            'id_number.required'=>"رقم الهوية مطلوبة",
            'id_number.unique'=>"رقم الهوية مسجل من قبل, مستخدم مسجل بهذا الرقم",
            'origin.required'=>"الحي أو المنطقة مطلوب",
        ],[

        ]);
        $userQr= new UserQr();
        $userQr->name= $request->name;
        $userQr->id_number= $request->id_number;
        $userQr->region= $request->region;
        $userQr->save();

        $id_number=$userQr->id_number;

        $pdf = \PDF::loadView('qrcode_download',compact('id_number'));
        redirect()->route('main_page');
        return $pdf->download($id_number.'.pdf');
    }

    public function downloadQR($status,$id)
    {
        $userQr= UserQr::whereId($id)->first();
        $id_number=$userQr->id_number;

        $pdf = \PDF::loadView('qrcode_download',compact('id_number'));
        return $pdf->download($id_number.'.pdf');
    }
    public function show(UserQr $userQr)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserQr  $userQr
     * @return \Illuminate\Http\Response
     */
    public function edit(UserQr $userQr)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserQr  $userQr
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserQr $userQr)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserQr  $userQr
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserQr $userQr)
    {
        $userQr->destroy();
        return response()->json(null,200);
    }
}
