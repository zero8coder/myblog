<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Reply;
use Illuminate\Support\Facades\Storage;
use Auth;

class RepliesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function destroy(Reply $reply)
    {
        $reply->delete();
        if(request()->wantsJson()){
            return response([],204);
        }
        session()->flash('success', '删除成功');
        return back();
    }
}