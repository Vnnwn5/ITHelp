<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\UploadImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Technician\EditRequest;
use App\Http\Requests\Technician\CreateRequest;

class TechnicianController extends Controller
{
    use UploadImage;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $technicians = User::techniciansFilter($request->tech_data);
        return view('Technicians.index', compact('technicians'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('Technicians.create_or_edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        $technician = new User();

            $file = $request->file('avatar');
        if (!$this->upload($file, rand())){
            $request->session()->flash('file_error', $this->error_message);
            return redirect()->route('tecnicos.create')->withInput();
        }

        $technician->type= 2 ;
        $technician->avatar= $this->new_name;
        $technician->password= Hash::make($request->password);
        $technician->fill($request->all()) ;
        $technician->save() ;

        $request->session()->flash('message','Tecnico agregado corectamente');

        return redirect()->route('tecnicos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $technician = User::find($id);
        if(is_null($technician)){
            return redirect()->route('tecnicos.index');
        }
        return view('Technicians.info')->with('technician',$technician);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $technician = User::find($id);

        if (is_null($technician)) {
            return redirect()->route('tecnicos.index');
        }

        return view('Technicians.create_or_edit')->with('technician', $technician);
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
        $technician = User::find($id);
        if(is_null($technician)) {
            return redirect()->route('tecnicos.index');
        }
        //Uploading image
        if ($request->has('avatar')){
            $file = $request->file('avatar');
            $new_name = uniqid(rand(), true).'.'.strtolower($file->getClientOriginalExtension());
            $result = Storage::disk('public')->put('avatars/'. $new_name, File::get($file));
            if(!$result){
                $request->session()->flash('file_error', 'Ha ocurrido un error al subir la imagen');
                return redirect()->route('tecnicos.index')->withInput();
        }
    }
        //Uploading tech
        if(!empty($result)){
            if(Storage::disk('public')->exists('avatars/'.$technician->avatar)){
               Storage::disk('public')->delete('avatars/'.$technician->avatar);
            }
            $technician->avatar= $new_name;
        }
        if (!empty($request->password)){
            $technician->password= Hash::make($request->password);
        }

        $technician->fill($request->all()) ;
        $technician->save() ;

        $request->session()->flash('message','Tecnico ha sido actualizado correctamente');

        return redirect()->route('tecnicos.index');
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
