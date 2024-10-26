<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreComment;
use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Http\Request;

class UserCommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['store']);
    }

    public function store(User $user, StoreComment $request)
    {
        $user->commentsOn()->create([
            'content' => $request->input('content'),
            'user_id' => $request->user()->id,
        ]);
       // session()->flash('status','The comment was created');
        return redirect()->back()
            ->withStatus('The comment was created');
    }
}
