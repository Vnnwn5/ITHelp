<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\Device;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use App\Http\Requests\Device\CreateRequest;
use App\Http\Requests\Device\updateRequest;

class DeviceController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin')->only('destroy');
    }

    public function index(Request $request)
    {
        $devices = Device::devicesFilter($request->status,$request->entry_date_from,$request->entry_date_to);
        return view('Devices.index')->with('devices', $devices);
    }

    public function create()
    {
        return view('Devices.create_or_edit');
    }

    public function store(CreateRequest $request)
    {
        $data = [
            'customer_id' => $request->customer_id,
            'user_id' =>  (auth()->user()->isAdmin()) ? $request->user_id : auth()->user()->id,
            'description' => $request->description,
            'status' => 'Recibido',
            'entry_date' => Carbon::now(),
        ];
        $device = Device::create($data);
        $device->maintenances()->attach($request->maintenances);

        $request->session()->flash('message', 'Dispositivo almacenado correctamente.');

        return redirect()->route('dispositivos.index');
    }

    public function show($id)
    {
        try {
            $device = Device::find($id);

            if (is_null($device)) {
                return redirect()->route('dispositivos.index');
            }
        } catch (Exception $exception) {
            report($exception);
        }

        return view('Devices.info')->with('device', $device);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $device = Device::find($id);

        if(is_null($device)){
            return redirect()->route('dispositivos.index');
        }
        return view('Devices.create_or_edit')->with('device',$device);
    }

    public function update(updateRequest $request, $id)
    {
        $device = Device::find($id);

        if (is_null($device)) {
            return redirect()->route('dispositivos.index');
        }

        $device->fill($request->all());

        if ($request->status == 'Entregado') {
            $device->departure_date = Carbon::now();
        }

        $device->save();

        $device->maintenances()->sync($request->maintenances);

        $request->session()->flash('message', 'Dispositivo actualizado correctamente.');

        return redirect()->route('dispositivos.index');
    }


    public function destroy(Request $request, $id)
    {
        if($request->ajax()){
            $device = Device::find($id);
            if(is_null($device)){
                return response()->json([
                    'error'=>true,
                    'message'=>'Ha ocurrido un error, intente de nuevo mas tarde .'
            ]);
        }

           $device->delete();
            return response()->json([
                'error'=>false,
                'message'=>'Registro eliminado correctamente. '
            ], 200);
        }
    }
}
