<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function postAdd(Request $request){

        return view('addPost');
    }

    public function savePost(Request $request){
        $this->validate($request,[
            'PostTitle' => 'required',
            'postDescription' => 'required',
            'postPhoto' => 'required | image | mimes:jpg,bmp,png'
        ]);

        $NewImageName = time().'_'.$request->file('postPhoto')->getClientOriginalName();
        $request->file('postPhoto')->move(public_path('uploads'),$NewImageName);

        $user = Auth::id();
        $data = [
            'user_id'=>$user,
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

    public function showUserPost(){
        $user = Auth::user();
        $posts = Post::where('user_id',$user->id)->orderBy('id','desc')->get();

        return view('allPost', compact('posts', 'user'));
    }

    public function editPost($id){

        $post = DB::table('posts')->where('id',$id)->first();

        return view('edit-post', compact('post'));
    }

    public function updatePost( Request $request){
        $this->validate($request,[
            'PostTitle' => ' min:10 | max:60',
            'postDescription' => '  min:30',
            'postPhoto' => 'required | image'
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

    public function postDelete($id){
        DB::table('posts')->where('id',$id)->delete();
        return back()->with('post_deleted', 'post deleted successfully');
    }

    public function singlePost($id){
        $posts = DB::table('posts')->where('id', $id)->get();
        return view('single', compact('posts'));
    }

    public function showAllPost(){
        $posts = Post::paginate(2);
        return view('dashboard', compact('posts'));
    }

    public function postSearch( Request $request){
        $search = isset($_GET['search']) ? $_GET['search'] : null;
        $posts = DB::table('posts');
        if ($search != null){
            $posts->where('title', 'like', '%'.$search.'%')
            ->orWhere('description', 'like', '%'.$search.'%');
        }
        $posts = $posts->get();
        return view('search', ['posts'=> $posts]);
    }
}
