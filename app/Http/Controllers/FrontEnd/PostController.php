<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function PostAdd(){
        return view('addPost');
    }

    public function savePost(Request $request){
        $this->validate($request,[
            'PostTitle' => 'required | min:10 | max:60',
            'postDescription' => 'required | min:30',
            'postPhoto' => 'required'
        ]);
        $photo = $request->file('postPhoto');
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

            return redirect()->route('addPost');
        }catch (Exception $e){
            session()->flash('message', $e->getMessage());
            session()->flash('type', 'danger');

            return redirect()->back();
        }
    }

    public function ShowAllPost(){
        $posts = DB::table('posts')->get();
        return view('allPost', compact('posts'));
    }

    public function editPost($id){
        $post = DB::table('posts')->where('id',$id)->first();

        return view('edit-post', compact('post'));
    }

    public function UpdatePost( Request $request){
        $data = [
            'title'=>$request->input('PostTitle'),
            'description'=>$request->input('postDescription')
        ];
         DB::table('posts')->where('id', $request->id)->update($data);

       return back()->with('post_update', 'post updated successfully');
    }
    public function PostDelete($id){

    }
}
