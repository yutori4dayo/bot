<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Scraping;

class PostController extends Controller
{
    public function getPost(Request $request)
    {
      try {
        if(!empty($request->post)){
          $post = new Post();;
          $post->contents = $request->post;
          $post->save();
          return redirect('post')->with('ok', '投稿成功');
        }else {
          return redirect('post')->with('error', '失敗');
        }
      } catch (\Exception $e) {
        return redirect('post')->with('error', '失敗');
      }
    }

    public function postList()
    {
      $posts = Post::paginate(25);
      return view('list',compact('posts'));
    }

    public function delete(Request $request)
    {
      if(Post::where('id',(int)$request->delete)->delete()){
        return redirect('list')->with('deleteok', '削除成功');
      }
      return redirect('list')->with('deleteerror', '削除失敗');
    }

    public function edit(Request $request)
    {
      $post = Post::find($request->id);
      return view('edit',compact('post'));
    }

    public function editPost(Request $request)
    {
      $get = Post::find($request->id);
      $get->contents = $request->post;
      $get->save();
        return redirect('list');
    }

    public function listItem(){
        $items = Scraping::all();
        return view('itemslist',compact('items'));
    }

    public function CreateItem(Request $request){
      $data = new Scraping();
      $data->content =  $request->content;
      $data->title = 'a';
      $data->save();
      return redirect('itemslist');
    }
}
