<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\SettingsRequest;
use App\Models\Setting;
use App\Services\CSCService;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settgins = Setting::all();
        $shipment = $settgins->where('name', "shipment")->first();
        $map = $settgins->where('name', "map")->first();
        $currencies = CSCService::getCurrencies();

        // dd($currencies->first()->name_and_symbol, $currencies->toArray(), array_column($currencies->toArray(), 'code'));
        return view('settings.index', compact('shipment', "map", "currencies"));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SettingsRequest $request, $id)
    {
        $settgins = Setting::find($id);
        // dd($request->all());
        if($request->settgins_type == "shipmentSettings"){
            $settgins->data = [
                'price_per_miles' => $request->price_per_miles,
                'price_per_kilometer' => $request->price_per_kilometer,
                'currency_id' => $request->currency_id,
            ];
        }else if($request->settgins_type == "mapAPISettings"){
            $settgins->data = [
                'key' => $request->key,
            ];
        }
        $settgins->save();
        return redirect()->route('settings.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
