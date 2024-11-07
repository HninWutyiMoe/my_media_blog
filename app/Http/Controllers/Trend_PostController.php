<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Trend_PostController extends Controller
{
    public function index(){
        $data = Post::select('posts.*','action_logs.post_id as postId',DB::raw('COUNT(action_logs.post_id) as view_count'))
                    ->leftJoin('action_logs','action_logs.post_id','posts.id')
                    ->groupBy('action_logs.post_id',
                    'posts.id','posts.title','posts.description','posts.image',
                    'posts.video','posts.country_id','posts.category_id','posts.created_at','posts.updated_at')
                    ->orderBy('view_count','desc')
                    ->paginate(5);
        // dd($data->toArray());

        return view('admin.trend-post.index',compact('data'));
    }

    // Search
    public function search(Request $request){
        $data = Post::select('posts.*','action_logs.post_id as postId',DB::raw('COUNT(action_logs.post_id) as view_count'))
                    ->leftJoin('action_logs','action_logs.post_id','posts.id')
                    ->groupBy('action_logs.post_id',
                    'posts.id','posts.title','posts.description','posts.image',
                    'posts.video','posts.country_id','posts.category_id','posts.created_at','posts.updated_at')
                    ->where('title','Like','%'. $request->search .'%')
                    ->orderBy('view_count','desc')
                    ->paginate(5);
        return view('admin.trend-post.index',compact('data'));
    }

    public function view($id){
        $post =  Post::select('posts.*', 'categories.title as c_name')
                        ->leftJoin('categories', 'posts.category_id', 'categories.id')
                        ->where('posts.id', $id)->first();
        return view('admin.trend-post.view',compact('post'));
    }
}
