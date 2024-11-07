<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\Country;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function index()
    {
        $category = Category::select('id', 'title')->get();
        $country = Country::select('id','name')->get();
        $post = Post::select('posts.*', 'categories.title as category','countries.name as country')
                    ->leftJoin('categories', 'posts.category_id', 'categories.id')
                    ->leftJoin('countries', 'posts.country_id', 'countries.id')
                    // ->get();
                    ->orderBy('posts.created_at', 'desc')
                    ->paginate(5);
        // $post->appends(request()->all());
        return view('admin.post.index', compact('category', 'post','country'));
    }
    // Create
    public function create(Request $request)
    {
        $validator = $this->validateData($request);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = $this->requestData($request);

        //For Image
        if (!empty($request->postImage)) {
            $file = $request->file('postImage');
            $fileName = uniqid() . '_' . $file->getClientOriginalName();
            $file->move(public_path() . '/postImage', $fileName);
            // $file->move(storage_path())
            $data['image'] = $fileName;
        } else {
            $data['image'] = null;
        }

        // For Video
        if (!empty($request->postVideo)) {
            $fileVd = $request->file('postVideo');
            $fileVdName = uniqid() . '_' . $fileVd->getClientOriginalName();
            $fileVd->move(public_path() . '/postVideo', $fileVdName);

            $data['video'] = $fileVdName;
        } else {
            $data['video'] = null;
        }

        Post::create($data);

        return back()->with(['createdSuccess' => 'Post created success...']);
    }
    // View
    public function view($id)
    {
        // dd($id);
        $post = Post::select('posts.*', 'categories.title as c_name')
            ->leftJoin('categories', 'posts.category_id', 'categories.id')
            ->where('posts.id', $id)
            ->first();
        return view('admin.post.view', compact('post'));
    }

    // Search
    public function postSearch(Request $request){
        $category = Category::select('id', 'title')->get();
        $country = Country::select('id','name')->get();
        $post = Post::where('title','Like','%'. $request->search .'%')
                        ->orderBy('posts.created_at', 'desc')
                        ->paginate(5);
        return view('admin.post.index',compact('post','country','category'));
    }
    // Delete
    public function delete($id)
    {
        $postData = Post::where('id', $id)->first();
        $dbImage = $postData['image'];
        $dbVideo = $postData['video'];

        Post::where('id', $id)->delete();

        // Delete Image from public folder
        if (File::exists(public_path() . '/postImage/' . $dbImage)) {
            File::delete(public_path() . '/postImage/' . $dbImage);
        }

        // Delete Video from public folder
        if (File::exists(public_path() . '/postVideo/' . $dbVideo)) {
            File::delete(public_path() . '/postVideo/' . $dbVideo);
            // dd("Have");
        }
        return redirect()->route('admin#post')->with(['deleteSuccess' => 'Post deleted success...']);
    }
    // Edit
    public function edit($id)
    {
        $postDetail = Post::where('id', $id)->first();
        $post = Post::get();
        $category = Category::get();
        $country = Country::get();
        return view('admin.post.edit', compact('post', 'postDetail', 'category','country'));
    }
    // Update
    public function update($id, Request $request)
    {
        $validator = $this->validateData($request);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $updateData = $this->requestUpdateData($request);

        if (isset($request->postImage)) //if choose vd & img in update form
        {
            //For Image
            $file = $request->file('postImage');
            $fileName = uniqid() . '_' . $file->getClientOriginalName();
            $updateData['image'] = $fileName;

            // get image name from database
            $postData = Post::where('id', $id)->first();
            $dbImage = $postData['image'];
            // dd($dbImage);

            // Delete Image from public folder
            if (File::exists(public_path() . '/postImage/' . $dbImage)) {
                File::delete(public_path() . '/postImage/' . $dbImage);
            }

            // Store new Image name
            $file->move(public_path() . '/postImage', $fileName);

            Post::where('id', $id)->update($updateData);

        } else {
            Post::where('id', $id)->update($updateData);
        }
        if (isset($request->postVideo)) //if choose vd & img in update form
        {
            // For Video
            $fileVd = $request->file('postVideo');
            $fileVdName = uniqid() . '_' . $fileVd->getClientOriginalName();
            $updateData['video'] = $fileVdName;

            // get image name from database
            $postData = Post::where('id', $id)->first();
            $dbVideo = $postData['video'];

            // Delete Video from public folder
            if (File::exists(public_path() . '/postVideo/' . $dbVideo)) {
                File::delete(public_path() . '/postVideo/' . $dbVideo);
                // dd("Have");
            }
            // Store new Video name
            $fileVd->move(public_path() . '/postVideo', $fileVdName);

            Post::where('id', $id)->update($updateData);

        } else {
            Post::where('id', $id)->update($updateData);
        }

        return redirect()->route('admin#post')->with(['updateSuccess' => 'Update Success']);
    }
    //Request data from update
    private function requestUpdateData($request)
    {
        return [
            'title' => $request->postName,
            'description' => $request->description,
            'country_id' => $request->countryName,
            'category_id' => $request->categoryName,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }

    // RequestData
    private function requestData($request)
    {
        return [
            'title' => $request->postName,
            'description' => $request->description,
            'country_id' => $request->countryName,
            'image' => $request->postImage,
            'video' => $request->postVideo,
            'category_id' => $request->categoryName,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
    // Validation
    private function validateData($request)
    {
        return Validator::make($request->all(), [
            'postName' => 'required',
            'description' => 'required|min:10',
            'countryName' => 'required',
            'categoryName' => 'required',
            'postImage' => 'nullable|mimes:png,jpg,webp,svg,gif,jpeg|file',
            'postVideo' => 'nullable|mimes:video,mp4,mkv,x-m4v,video/mp4|file',
        ]);
    }
}
