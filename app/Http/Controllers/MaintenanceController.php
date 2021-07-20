<?php

namespace App\Http\Controllers;

use App\Models\Maintenance;
use Illuminate\Http\Request;
use App\Http\Requests\Maintenance\EditRequest;
use App\Http\Requests\Maintenance\CreateRequest;
class MaintenanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin')->except('getIndex');
    }

    public function getIndex(Request $request)
    {

        $maintenances = Maintenance::maintenancesFilter($request->maintenance_name);
        return view('Maintenances.index')->with('maintenances', $maintenances);
    }
    public function getCreate()
    {
        return view('Maintenances.create_or_edit');
    }
    public function postStore(CreateRequest $request)
    {
        Maintenance::create($request->all());
        $request->session()->flash('message','Tipo de Mantenimiento ha sido creado corectamente');
        return redirect()->route('mantenimientos.index');
    }
    public function getEdit($id)
    {
        $maintenance = Maintenance::find($id);

        if (is_null($maintenance)) {
            return redirect()->route('mantenimientos.index');
        }

        return view('Maintenances.create_or_edit')->with('maintenance', $maintenance);
    }
    public function putUpdate(EditRequest $request, $id)
    {
        $maintenance = Maintenance::find($id);
        if(is_null($maintenance)) {
            return redirect()->route('mantenimientos.index');
        }
        $maintenance->update($request->all());
        $request->session()->flash('message',' El mantenimiento ha sido actualizado correctamente');
        return redirect()->route('mantenimientos.index');
    }
    public function deleteDestroy(Request $request, $id)
    {
        if($request->ajax()){
            $maintenance= Maintenance::find($id);

            if(is_null( $maintenance )){
                return response()->json([
                    'error'=>true,
                    'message'=>'Ha ocurrido un error, intente de nuevo mas tarde .'
                ]);
            }

            $maintenance->delete();
            return response()->json([
                'error'=>false,
                'message'=>'Tipo de mantenimiento eliminado correctamente. '
            ], 200);
        }
    }
}

