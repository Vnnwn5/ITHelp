<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use App\Http\Requests\Customer\EditRequest;
use App\Http\Requests\Customer\CreateRequest;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $customers = Customer::customersFilter($request->client_data);
        return view('Customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Customers.create_or_edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        Customer::create($request->all());
        $request->session()->flash('message','Cliente ha sido agregado corectamente');
        return redirect()->route('clientes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $customer = Customer::find($id);
        if(is_null($customer)){
            return redirect()->route('clientes.index');
        }
        return view('Customers.info')->with('customer',$customer);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = Customer::find($id);

        if (is_null($customer)) {
            return redirect()->route('clientes.index');
        }

        return view('Customers.create_or_edit')->with('customer', $customer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditRequest $request, $id)
    {
        $customer = Customer::find($id);
        if(is_null($customer)) {
            return redirect()->route('clientes.index');
        }
        $customer->update($request->all());
        $request->session()->flash('message','Cliente ha sido actualizado correctamente');
        return redirect()->route('clientes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if($request->ajax()){
            $customer= Customer::find($id);

            if(is_null($customer)){
                return response()->json([
                    'error'=>true,
                    'message'=>'Ha ocurrido un error, intente de nuevo mas tarde .'
                ]);
            }

            $customer->delete();
            return response()->json([
                'error'=>false,
                'message'=>'Cliente eliminado correctamente. '
            ], 200);
        }
    }
}
