<?php

namespace App\Http\Controllers;

use App\Models\PlaceHolder;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class PlaceHolderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('users/place_table');
    }

    public function getPlaces()
    {
        $places = PlaceHolder::paginate(20);
        /*foreach ($places->items() as $item){
            $item['created_at'] =
              Carbon::createFromFormat('Y-m-d H:i:s', $item->created_at)->;
        }*/

        return response()->json($places,200);
    }
    public function search($sreach)
    {
        $places = PlaceHolder::where('id_number','LIKE','%'.$sreach.'%')
            ->orwhere('place','LIKE','%'.$sreach.'%')->paginate(20);
        return response()->json($places,200);
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
            'place'=>'required',
            'category'=>'required',
            'city'=>'required',
            'area'=>'required',
            'street'=>'required',
            'name'=>'required',
            'id_number'=>'required',
            'phone'=>'required',
        ],[
            'place.required'=>"اسم المكان مطلوب",
            'category.required'=>"تصنيف المكان مطلوب",
            'city.required'=>"اسم المدينة مطلوبة",
            'area.required'=>"اسم الحي مطلوب",
            'street.required'=>"عنوان الشارع",
            'name.required'=>"الاسم الرباعي مطلوب",
            'id_number.required'=>"رقم الهوية مطلوبة",
            'id_number.unique'=>"رقم الهوية مسجل من قبل, مكان مسجل بهذا الرقم",
            'phone.required'=>"رقم التواصل مطلوب",
        ],[

        ]);
        $placeHolder= new PlaceHolder();
        $placeHolder->place= $request->place;
        $placeHolder->category= $request->category;
        $placeHolder->city= $request->city;
        $placeHolder->area= $request->area;
        $placeHolder->street= $request->street;
        $placeHolder->name= $request->name;
        $placeHolder->id_number= $request->id_number;
        $placeHolder->phone= $request->phone;

        $qrcode_img= \QrCode::size(400)
            ->encoding('UTF-8')
            ->gradient(250, 0, 180, 100,50, 150, 'vertical')
            ->generate('100000000'.$placeHolder->id.','.$placeHolder->place);

        $placeHolder->save();

        $place=$placeHolder->place;
        $id=$placeHolder->id;
        //$pdf = \PDF::loadView('qrcode_download',compact('id','place'));

        $html = \View::make('qrcode_download',compact('id','place'));
        $pdfUPN = \PDF::loadHTML($html);
        return $pdfUPN->download('QRcode.pdf');
        return redirect(route('main_page'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PlaceHolder  $placeHolder
     * @return \Illuminate\Http\Response
     */
    public function show(PlaceHolder $placeHolder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PlaceHolder  $placeHolder
     * @return \Illuminate\Http\Response
     */
    public function getQrcode($id)
    {
        $place =PlaceHolder::whereId($id)->first();
        $id=$place->id;
        $placee=$place->place;
        return view('users.qrcode',compact('id','placee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PlaceHolder  $placeHolder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PlaceHolder $placeHolder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PlaceHolder  $placeHolder
     * @return \Illuminate\Http\Response
     */
    public function destroy(PlaceHolder $placeHolder)
    {
        //
    }
}
