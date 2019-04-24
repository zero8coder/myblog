<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class PasswordController extends Controller
{
    public function edit()
    {
        return view('admin.password.create_and_edit');
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required|between:6,20',
            'password' => 'required|between:6,20|confirmed',

        ]);

        if ($request->old_password == $request->password) {
            return back()->withInput()->withErrors(['新旧密码不允许一样']);
        }

        $user = Auth::user();
        if (!\Hash::check($request->old_password, $user->password)) {
            return back()->withInput()->withErrors(['旧密码不正确']);
        }

        $user->password = bcrypt($request->password);
        $user->save();
        session()->flash('success', '修改成功');
        return back();

    }
}