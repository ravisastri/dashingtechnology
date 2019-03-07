<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DB;
use App\Item;
//use Maatwebsite\Excel\Excel;

use App\Http\Requests;
use Input;
use Session;
use Excel;
use PDF;

class ItemController extends Controller
{
   public function importExport()
    {
        return view('importExport');
    }
    public function downloadExcel($type)
    {
        $data = Item::get()->toArray();
            
        return Excel::create('exportexample', function($excel) use ($data) {
            $excel->sheet('mySheet', function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });
        })->download($type);
    }
    public function importExcel(Request $request)
    {
        $request->validate([
            'import_file' => 'required'
        ]);
        $path = $request->file('import_file')->getRealPath();
        $data = Excel::load($path)->get();
        if($data->count()){
         /* for excel records */
            foreach ($data[0] as $key=> $value) {
            $arr[] = ['title'=>$value->title,'description'=>
            $value->description];
            }
           view()->share('items',$arr);
            $pdf = PDF::loadView('pdfview');
            $dynamicfilename = Str::random(10).'.pdf';
            $pdf->save(storage_path($dynamicfilename));
            
        }
       return back()->with('success', 'download pdf success');
        
    }
    
    
}
