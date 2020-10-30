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
        $users = UserQr::orderBy('created_at','desc')->paginate(20);
        $users->each(function ($user){
            $user['date'] = $user->created_at->format('d/m/Y');
        });
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
            'user_name'=>'required',
            'user_id_number'=>'required|unique:user_qrs,id_number',
            'user_region'=>'required',
        ],[
            'name.required'=>"الاسم الرباعي مطلوب",
            'user_id_number.required'=>"رقم الهوية مطلوبة",
            'user_id_number.unique'=>"رقم الهوية مسجل من قبل, مستخدم مسجل بهذا الرقم",
            'user_region.required'=>"الحي أو المنطقة مطلوب",
        ]);
        $userQr= new UserQr();
        $userQr->name= $request->user_name;
        $userQr->id_number= $request->user_id_number;
        $userQr->region= $request->user_region;
        $userQr->save();

        $id_number=$userQr->id_number;

        $pdf = \PDF::loadView('userQrcode_download',compact('id_number'));
        redirect()->route('main_page');
        return $pdf->download($id_number.'.pdf');
    }

    public function downloadQR($id)
    {
        $userQr= UserQr::whereId($id)->first();
        $id_number=$userQr->id_number;

        $pdf = \PDF::loadView('userQrcode_download',compact('id_number'));
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
    public function destroy($id)
    {
        UserQr::destroy($id);
        return response()->json(null,200);
    }
}
