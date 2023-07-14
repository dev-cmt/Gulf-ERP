<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\BarcodeExport;
use App\Exports\ItemExport;
use Barryvdh\DomPDF\PDF;
use Milon\Barcode\DNS1D;
use Milon\Barcode\DNS2D;
use App\Models\Master\MastItemRegister;
use App\Models\Master\MastUnit;
use App\Models\Master\MastItemGroup;
use App\Models\Master\MastItemCategory;
use App\Models\User;


class MastItemRegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = MastItemRegister::with('unit', 'mastItemGroup')->get();
        return view('layouts.pages.master.item_register.index' , compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $unit = MastUnit::orderBy('unit_name', 'asc')->get();
        $item_group = MastItemGroup::orderBy('part_name', 'asc')->get();
        // $item_category = MastItemCategory::all();
        return view('layouts.pages.master.item_register.create' , compact('unit', 'item_group'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated=$request -> validate([
            'box_code'=> 'required|max:255',
            'gulf_code'=> 'required',
            'part_no'=> 'required',
            'warranty'=> 'required',
            'box_qty'=> 'required',
            'price' => ['required', 'numeric', 'regex:/^\d{1,6}(\.\d{1,2})?$/'],
        ]);
        $data = new MastItemRegister();
        if($request->hasFile("image")){
            if (File::exists("public/images/car-parts/".$data->image)) {
                File::delete("public/images/car-parts/".$data->image);
            }
            //get filename with extension
            $filenamewithextension = $request->file('image')->getClientOriginalName();
            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            //get file extension
            $extension = $request->file('image')->getClientOriginalExtension();
            //filename to store
            $filenametostore = $filename.'_'.time().'.'.$extension;
            //Upload File
            $request->file('image')->move('public/images/car-parts/', $filenametostore); //--Upload Location
            // $request->file('profile_image')->storeAs('public/profile_images', $filenametostore); //--Orginal Img Save
            //Resize image here
            $thumbnailpath = public_path('images/car-parts/'.$filenametostore); //--Get File Location
            // $thumbnailpath = public_path('storage/images/profile/'.$filenametostore);
            $img = Image::make($thumbnailpath)->resize(1200, 850, function($constraint) {
                $constraint->aspectRatio();
            }); 
            $img->save($thumbnailpath);
            $data->image = $filenametostore;
        }
        $number = mt_rand(10000000000, 99999999999);
        if($this->barCodeExists($number)){
            $number = mt_rand(10000000000, 99999999999);
        }
        $data->box_code = $request->box_code;
        $data->gulf_code = $request->gulf_code;
        $data->part_no = $request->part_no;
        $data->description = $request->description;
        $data->box_qty = $request->box_qty;
        $data->warranty = $request->warranty;
        $data->price = $request->price;
        $data->unit_id = $request->unit_id;
        $data->mast_item_group_id = $request->mast_item_group_id;
        $data->user_id = Auth::user()->id;
        $data->bar_code = $number;
        $data->save();
        $notification = array('messege' => 'Item register data save successfully.', 'alert-type' => 'success');
        return redirect()->route('mast_item_register.index')->with($notification);
    }
    public function barCodeExists($number)
    {
        return MastItemRegister::whereBarCode($number)->exists();
    }
    public function generateBarcode()
    {
        $data = MastItemRegister::with('unit', 'mastItemGroup')->get();
        
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadView('layouts.pages.export.mast_item', compact('data'));
        $pdf->setPaper('a4', 'landscape');
        // $pdf = PDF::loadView('barcode')->setPaper('a4', 'portrait');
        // $pdf->save(public_path($path));
        
        return $pdf->download('items.pdf'); //--Dwonload
        // return $pdf->stream('table.pdf'); //--Show
    }
    public function export()
    {
        return Excel::download(new ItemExport, 'ItemRegister.xlsx');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Master\MastItemRegister  $mastItemRegister
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = MastItemRegister::with('unit', 'mastItemGroup')->find($id);
        $unit = MastUnit::get();
        $item_group = MastItemGroup::get();

        return view('layouts.pages.master.item_register.show', compact('data','unit','item_group'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Master\MastItemRegister  $mastItemRegister
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = MastItemRegister::with('unit', 'mastItemGroup')->find($id);
        $unit = MastUnit::get();
        $item_group = MastItemGroup::get();

        return view('layouts.pages.master.item_register.edit', compact('data','unit','item_group'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Master\MastItemRegister  $mastItemRegister
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = MastItemRegister::find($id);
        $validated=$request -> validate([
            'box_code'=> 'required|max:255',
            'gulf_code'=> 'required',
            'part_no'=> 'required',
            'warranty'=> 'warranty',
            'box_qty'=> 'required',
            'price' => ['required', 'numeric', 'regex:/^\d{1,6}(\.\d{1,2})?$/'],
        ]);
        if($request->hasFile("image")){
            if (File::exists("public/images/car-parts/".$data->image)) {
                File::delete("public/images/car-parts/".$data->image);
            }
            //get filename with extension
            $filenamewithextension = $request->file('image')->getClientOriginalName();
            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            //get file extension
            $extension = $request->file('image')->getClientOriginalExtension();
            //filename to store
            $filenametostore = $filename.'_'.time().'.'.$extension;
            //Upload File
            $request->file('image')->move('public/images/car-parts/', $filenametostore); //--Upload Location
            // $request->file('profile_image')->storeAs('public/profile_images', $filenametostore); //--Orginal Img Save
            //Resize image here
            $thumbnailpath = public_path('images/car-parts/'.$filenametostore); //--Get File Location
            // $thumbnailpath = public_path('storage/images/profile/'.$filenametostore);
            $img = Image::make($thumbnailpath)->resize(1200, 850, function($constraint) {
                $constraint->aspectRatio();
            }); 
            $img->save($thumbnailpath);
            $data->image = $filenametostore;
        }
        $data->box_code = $request->box_code;
        $data->gulf_code = $request->gulf_code;
        $data->part_no = $request->part_no;
        $data->description = $request->description;
        $data->box_qty = $request->box_qty;
        $data->price = $request->price;
        $data->warranty = $request->warranty;
        $data->unit_id = $request->unit_id;
        $data->mast_item_group_id = $request->mast_item_group_id;
        $data->user_id = Auth::user()->id;
        $data->save();
        $notification = array('messege' => 'Item update data save successfully.', 'alert-type' => 'success');
        return redirect()->route('mast_item_register.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Master\MastItemRegister  $mastItemRegister
     * @return \Illuminate\Http\Response
     */
    public function destroy(MastItemRegister $mastItemRegister)
    {
        //
    }
    
    public function getPartName(Request $request)
    {
        $getpartName = MastItemGroup::where('mast_item_category_id',$request->part_name)->get();
        return view('layouts.pages.master.item_register.load-part-name',compact('getpartName'));
    }
}
