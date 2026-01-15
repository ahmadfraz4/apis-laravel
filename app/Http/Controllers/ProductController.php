<?php

namespace App\Http\Controllers;

use App\Models\User;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class ProductController extends Controller
{
    public function createUser(Request $req)
    {
        $user = new User();
        $rules = [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:product'
        ];

        $is_validate = FacadesValidator::make($req->all, $rules);
        if ($is_validate->fails()) {
            return redirect('/index')->withInput()->withErrors($is_validate);
        }

        $user->name = $req->name;
        $user->email = $req->email;
        $user->image = $req->image;
        if ($req->image != '') {
            $name = $req->image->getClientOrignalName();
            $ext = $req->image->getClientOrignalExtension();
            $req->image->move(public_path('uploads/users'), $name);
        }

        $req->save();
    }
}
