<?php

namespace App\Http\Controllers;

use App\Models\patient;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patients= patient::orderByDesc('updated_at')->paginate(15);
        $last_update =patient::orderByDesc('updated_at')->first()->updated_at->format('d M Y - H:i');

        return response()->json([
            'patients'=>$patients,
            'last_update'=>$last_update
        ],200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function patients(){
        $activePage='all management';
        $route='/patient';
        $title='جميع الحالات';
        return view('patient.patient',compact('title','route','activePage'));
    }
    public function healthy(){
        $activePage='healthy management';
        $route='/dashboard/patient/gethealthy';
        $title='إدارة المتعافين';
        return view('patient.patient',compact('title','route','activePage'));
    }
    public function contact(){
        $activePage='contact management';
        $route='/dashboard/patient/getcontact';
        $title='إدارة المخالطين';
        return view('patient.patient',compact('title','route','activePage'));
    }
    public function injured(){
        $activePage='injured management';
        $route='/dashboard/patient/getinjured';
        $title='إدارة المصابين';
        return view('patient.patient',compact('title','route','activePage'));
    }

    public function gethealthy(){
        $patients= patient::where('status','healthy')->orderByDesc('updated_at')->paginate(15);
        $last_update =patient::where('status','injured')->orderByDesc('updated_at')->first()->updated_at->format('d M Y - H:i');

        return response()->json([
            'patients'=>$patients,
            'last_update'=>$last_update
        ],200);
    }
    public function getcontact(){
        $patients= patient::where('status','contact')->orderByDesc('updated_at')->paginate(15);
        $last_update =patient::where('status','contact')->orderByDesc('updated_at')->first()->updated_at->format('d M Y - H:i');

        return response()->json([
            'patients'=>$patients,
            'last_update'=>$last_update
        ],200);
    }
    public function getinjured(){

        $patients= patient::where('status','injured')->orderByDesc('updated_at')->paginate(15);
        $last_update =patient::where('status','injured')->orderByDesc('updated_at')->first()->updated_at->format('d M Y - H:i');

        return response()->json([
            'patients'=>$patients,
            'last_update'=>$last_update
        ],200);
    }

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
                'first_name'=>'required',
                'father_name'=>'required',
                'granddad_name'=>'required',
                'last_name'=>'required',
                'id_number'=>'required|unique:patients',
                'gender'=>'required|in:male,female',
                'phone'=>'required',
                'status'=>'required|in:healthy,contact,injured',
                'city'=>'required',
                'area'=>'required',
        ]);
        $patient=new patient();
            $patient->first_name=$request->first_name;
            $patient->father_name=$request->father_name;
            $patient->granddad_name=$request->granddad_name;
            $patient->last_name=$request->last_name;
            $patient->id_number=$request->id_number;
            $patient->gender=$request->gender;
            $patient->phone=$request->phone;
            $patient->status=$request->status;
            $patient->city=$request->city;
            $patient->area=$request->area;
            $patient->date_injury=$request->date_injury ?$request->date_injury:null;
            $patient->save();
        return response()->json(true,200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function show(patient $patient)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function edit(patient $patient)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, patient $patient)
    {
        if ($request->status == 'injured'){
            $patient->update([
                'status'=>$request->status,
                'date_injury'=>(today()->format('Y-m-d')),
                'updated_at'=>now(),
            ]);
        }else{
            $patient->update([
                'status'=>$request->status,
                'updated_at'=>now(),
            ]);
        }
        $patient->save();

        return response()->json(['date'=>today()->format('Y-m-d')],200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy(patient $patient)
    {
        $result=$patient->delete();
        return response()->json($result,200);
    }
}
