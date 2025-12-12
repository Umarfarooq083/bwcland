<?php

namespace App\Http\Controllers;

use App\Models\Plots;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class PlotsController extends Controller
{
    public function plotsList()
    {
        return view('plots/view', ['plots' => Plots::all()]);
    }
    
    public function plotsShow(Request $request)
    {
        $encryptedId = Crypt::encrypt($request->id);
        $data['encryptedId'] = $encryptedId;
        $PlotsData = Plots::where('id',$request->id)->first();
        $data['PlotsData'] = $PlotsData;
        return view('plots/show',$data);
    }

    public function plotsQRCode(Request $request)
    {
        $id = Crypt::decrypt($request->id);
        $PlotsData = Plots::where('id',$id)->first();
        $data['PlotsData'] = $PlotsData;
        return view('plots/qrdata',$data);
    }
}
