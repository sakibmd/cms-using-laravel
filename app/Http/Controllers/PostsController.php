<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\Posts\CreatePostsRequest;
use App\Http\Requests\Posts\UpdatePostsRequest;
use App\Notifications\NewPostNotify;
use App\Post;
use App\Subscriber;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class PostsController extends Controller
{

    public function __construct()
    {
        $this->middleware('verifyCategoriesCount')->only(['create', 'store']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (Auth::id() == 1) {
            $posts = Post::where('is_approved', 'yes')->latest()->get();
        } else {
            $posts = Post::where('user_id', Auth::id())->where('is_approved', 'yes')->latest()->get();
        }
        return view('posts.index', compact('posts'));

    }

    public function pending()
    {
        $posts = Post::where('is_approved', 'no')->latest()->get();
        return view('posts.pending', compact('posts'));
    }

    public function pendingPosTForUser()
    {
        $posts = Post::where('user_id', Auth::id())->where('is_approved', 'no')->latest()->get();
        return view('posts.pendingPostforUser', compact('posts'));
    }

    public function pendingApprove($id)
    {
        $post = Post::find($id);
        $post->is_approved = 'yes';
        $post->save();

        $subscribers = Subscriber::all();
        foreach ($subscribers as $subscriber) {
            Notification::route('mail', $subscriber->email)
                ->notify(new NewPostNotify($post));
        }

        session()->flash('success', 'Pending Post Approved Successfully');
        return redirect()->back();
    }

    public function pendingRemove($id)
    {
        Post::find($id)->delete();

        session()->flash('success', 'Pending Post Removed Successfully');
        return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create')->with('categories', Category::all())->with('tags', Tag::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trashed()
    {
        //$trashed = Post::withTrashed()->get();

        if (Auth::id() == 1) {
            $posts = Post::onlyTrashed()->get(); //shudu trashed post show korbe
            $trash = "trash";
            return view('posts.index', compact('posts', 'trash'));
        } else {
            $posts = Post::where('user_id', Auth::id())->onlyTrashed()->get(); //shudu trashed post show korbe
            $trash = "trash";
            return view('posts.index', compact('posts', 'trash'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostsRequest $request)
    {

        //dd($request->all());
        $image = $request->image->store('posts');

        $approve = 'idk';
        if (Auth::id() == 1) {
            $approve = 'yes';
        } else {
            $approve = 'no';
        }

        $post = new Post();
        $post->title = $request->title;
        $post->description = $request->description;
        $post->content = $request->content;
        $post->category_id = $request->category;
        $post->published_at = $request->published_at;
        $post->image = $image;
        $post->is_approved = $approve;
        $post->user_id = Auth::id();
        $post->save();

        if ($post->is_approved == 'yes') {
            $subscribers = Subscriber::all();
            foreach ($subscribers as $subscriber) {
                Notification::route('mail', $subscriber->email)
                    ->notify(new NewPostNotify($post));
            }
        }

        if ($request->tags) {
            $post->tags()->attach($request->tags);
        }

        session()->flash('success', 'Post Inserted Successfully');
        return redirect(route('posts.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function restore($id)
    {
        $post = Post::withTrashed()->where('id', $id)->firstOrFail();
        $post->restore();
        session()->flash('success', 'Post Restore Successfully');
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.create')->with('post', $post)->with('categories', Category::all())->with('tags', Tag::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostsRequest $request, Post $post)
    {
        $data = $request->only(['title', 'name', 'description', 'content', 'published_at']);
        if ($request->hasFile('image')) {
            $image = $request->image->store('posts');
            $post->deleteImage();
            $data['image'] = $image;
        }
        $post->update($data);
        $post->tags()->sync($request->tags);
        session()->flash('success', 'Post Updated Successfully');
        return redirect(route('posts.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::withTrashed()->where('id', $id)->firstOrFail();
        if ($post->trashed()) {
            $post->deleteImage();
            $post->forceDelete();

        } else {
            $post->delete();
        }
        $post->tags()->detach();
        session()->flash('success', 'Post Deleted Successfully');
        return redirect(route('posts.index'));

    }

}
