<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Country;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
//get all post
    public function getAllPost()
    {
        $post = Post::select('posts.*', 'countries.name as country', 'categories.title as cTitle', 'categories.description as cDesc')
            ->leftJoin('categories', 'posts.category_id', 'categories.id')
            ->leftJoin('countries', 'posts.country_id', 'countries.id')
            ->get();

        return response()->json([
            'status' => 'Success',
            'post' => $post,
        ]);
    }

// Get category
    public function categoryList()
    {
        $category = Category::select('id', 'title', 'description')->get();
        return response()->json([
            'status' => "Fine",
            'getCategory' => $category,
        ]);
    }

// Get Country
    public function countryList()
    {
        $country = Country::select('id', 'name')->get();
        return response()->json([
            'status' => "Fine",
            'getCountry' => $country,
        ]);
    }

// Search Post
    public function searchTitle(Request $request)
    {
        // logger($request->all());
        $searchCategory = Post::select('posts.*', 'countries.name as country', 'categories.title as cTitle', 'categories.description as cDesc')
            ->leftJoin('categories', 'posts.category_id', 'categories.id')
            ->leftJoin('countries', 'posts.country_id', 'countries.id')
            ->where('posts.title', 'like', '%' . $request->searchValue . '%')
            ->get();
        return response()->json([
            'searchTitle' => $searchCategory,
        ]);
    }

// Category barSearch
    public function barSearch(Request $request)
    {
        // logger($request->all());
        $category = Post::select('posts.*', 'countries.name as country', 'categories.title as cTitle', 'categories.description as cDesc')
            ->join('categories', 'posts.category_id', 'categories.id')
            ->join('countries', 'posts.country_id', 'countries.id')
            ->where('categories.id', 'like', '%' . $request->key . '%')
            ->get();
        return response()->json([
            'barSearch' => $category,
        ]);
    }

    //Post Detail
    public function detail(Request $request)
    {
        $id = $request->postId;
        $post = Post::where('id', $id)->first();
        return response()->json([
            'post' => $post,
        ]);
    }
}
