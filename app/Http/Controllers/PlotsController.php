<?php

namespace App\Http\Controllers;

use App\Models\Plots;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use GuzzleHttp\Client;

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
        $id = $request->id;
        $data = []; 
        try {
            $client = new \GuzzleHttp\Client();
            $response = $client->get('https://server.blueworldcity.com/api/downtown/search-data', [
                'headers' => [
                    'last_login_token' => 'bd12321',
                    'Accept' => 'application/json',
                ],
                'query' => [
                    'data' => $id,
                ],
                'verify' => false,
                'timeout' => 60, 
            ]);

            $apiResponse = json_decode($response->getBody(), true);
            dd($apiResponse);
            $data['qr_data'] = $apiResponse['data'];
        } catch (\Exception $e) {
            $data['apiError'] = $e->getMessage();
        }
        return view('plots/qrdata', $data);
    }
}
