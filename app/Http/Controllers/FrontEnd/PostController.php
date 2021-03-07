<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function PostAdd(){
        return view('addpost');
    }

    public function savePost(Request $request){
        $this->validate($request,[
            'PostTitle' => 'required | min:10 | max:60',
            'postDescription' => 'required | min:30',
            'postPhoto' => 'required'
        ]);
        $photo = $request->file('photo');
        $file_name = uniqid('photo_'.true).Str::random(10).'.'.$photo->getClientOriginalExtension();
        if ( $photo->isValid() ) {
            $photo->storeAs('images', $file_name);
        }

        $data = [
            'title'=>$request->input('PostTitle'),
            'description'=>$request->input('postDescription'),
            'photo'=>$request->input('postPhoto')
        ];

        try {
            Post::insert($data);
            session()->flash('message', 'Post created successful');
            session()->flash('type', 'success');

            return redirect()->route('addpost');
        }catch (Exception $e){
            session()->flash('message', $e->getMessage());
            session()->flash('type', 'danger');

            return redirect()->back();
        }
    }

    public function ShowAllPost(){
        return view('allpost');
    }
}
