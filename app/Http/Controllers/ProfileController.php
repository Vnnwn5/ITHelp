<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Requests\Profile\EditPersonalData;

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
        return 'ok';
    }

    public function editPassword()
    {
        return view('Profile.edit_password');
    }
}
