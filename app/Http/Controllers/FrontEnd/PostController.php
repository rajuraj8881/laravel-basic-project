<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function PostAdd(){
        return view('addPost');
    }

    public function savePost(Request $request){
        $this->validate($request,[
            'PostTitle' => 'required | min:10 | max:60',
            'postDescription' => 'required | min:30',
            'postPhoto' => 'required | mimes:jpg,bmp,png'
        ]);

        $NewImageName = time().'_'.$request->file('postPhoto')->getClientOriginalName();
        $request->file('postPhoto')->move(public_path('uploads'),$NewImageName);

        $data = [
            'title'=>$request->input('PostTitle'),
            'description'=>$request->input('postDescription'),
            'photo'=> $NewImageName
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
        $this->validate($request,[
            'PostTitle' => 'required | min:10 | max:60',
            'postDescription' => 'required | min:30',
            'postPhoto' => 'required '
        ]);

        $NewImageName = time().'_'.$request->file('postPhoto')->getClientOriginalName();
        $request->file('postPhoto')->move(public_path('uploads'),$NewImageName);
        $data = [
            'title'=>$request->input('PostTitle'),
            'description'=>$request->input('postDescription'),
            'photo'=>$NewImageName
        ];

         DB::table('posts')->where('id', $request->id)->update($data);

       return back()->with('post_update', 'post updated successfully');
    }

    public function PostDelete($id){
        DB::table('posts')->where('id',$id)->delete();
        return back()->with('post_deleted', 'post deleted successfully');
    }

    public function singlePost($id){
        $posts = DB::table('posts')->where('id', $id)->get();
        return view('single', compact('posts'));
    }
}
