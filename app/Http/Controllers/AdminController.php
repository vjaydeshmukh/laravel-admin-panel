<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Validator;
use Auth;
use Session;

class AdminController extends Controller {

    public function adminLoginForm() {

        return view("admin.views.login_form");
    }

    public function checkUserLogin(Request $request) {

        $validator = Validator::make(array(
                    "email" => $request->email,
                    "password" => $request->password
                        ), array(
                    "email" => "required",
                    "password" => "required"
        ));

        if ($validator->fails()) {

            return redirect("login")->withErrors($validator)->withInput();
        } else {

            $user_info = array(
                "email" => $request->email,
                "password" => $request->password
            );

            if (auth()->guard("admin")->attempt($user_info)) {

                $logged_user_details = auth()->guard("admin")->user();
                session(["is_active" => 1]);
                session(["user_details" => $logged_user_details]);
            } else {

                $error_message = "Invalid credentials";
                return redirect()->back()->withErrors($error_message);
            }
        }
    }

}
