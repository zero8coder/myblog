<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class SessionsController extends Controller
{
    public function create()
    {
        return view('admin.sessions.create');
    }

    public function store(Request $request)
    {
        $credentials = $this->validate($request, [
            'email' => 'required|email|max:255',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials, $request->has('remember'))) {
            session()->flash('success', '登录成功');
            return redirect()->route('admin.index');
        } else {
            session()->flash('danger', '很抱歉，您的邮箱和密码不匹配');
            return redirect()->back();
        }

        return;
    }

    public function destroy()
    {
        Auth::logout();
        session()->flash('success', '您已成功退出！');
        return redirect()->route('login');
    }
}
