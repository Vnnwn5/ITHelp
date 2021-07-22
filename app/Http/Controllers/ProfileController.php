<?php

namespace App\Http\Controllers;


use App\Http\Requests\Profile\EditPassword;
use Illuminate\Http\Request;
use App\Http\Requests\Profile\EditPersonalData;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        return view('Profile.index');
    }

    public function editPersonalData()
    {
        return view('Profile.edit_personal_data');
    }

    public function updatePersonalData(EditPersonalData $request)
    {
        //Uploading image
        if ($request->has('avatar')){
            $file = $request->file('avatar');
            $new_name = uniqid(rand(), true).'.'.strtolower($file->getClientOriginalExtension());
            $result = Storage::disk('public')->put('avatars/'. $new_name, File::get($file));

            if(!$result){
                $request->session()->flash('file_error', 'Ha ocurrido un error al subir la imagen');
                return redirect()->route('profile.edit_personal_data');
            }

            if(Storage::disk('public')->exists('avatars/'.auth()->user()->avatar)){
                Storage::disk('public')->delete('avatars/'.auth()->user()->avatar);
            }
            auth()->user()->avatar= $new_name;
        }
        //Uploading user data
        auth()->user()->fill($request->all()) ;
        auth()->user()->save() ;

        $request->session()->flash('message','Datos actualizados correctamente');

        return redirect()->route('profile.index');
    }

    public function editPassword()
    {
        return view('Profile.edit_password');
    }

    public function updatePassword (EditPassword $request)
    {
        //Uploading password
        auth()->user()->fill($request->all()) ;
        auth()->user()->save() ;

        $request->session()->flash('message','Contrasenia actualizada correctamente');

        return redirect()->route('profile.index');
    }
}
