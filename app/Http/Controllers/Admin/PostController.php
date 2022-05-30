<?php

namespace App\Http\Controllers\Admin;

use App\Tag;
use App\Post;
use App\User;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class PostController extends Controller
{
    use \App\Traits\searchFilters;

    private function getValidators($model) {
        return [
            // 'user_id'   => 'required|exists:App\User,id',
            'title'         => 'required|max:100',
            'slug'          => [
                'required',
                Rule::unique('posts')->ignore($model),
                'max:100'
            ],
            'category_id'   => 'required|exists:App\Category,id',
            'content'       => 'required',
            'tags'          => 'exists:App\Tag,id',
            'post_image'    => 'nullable|image'
        ];
    }

    public function myindex() {
        $posts = Post::where('user_id', Auth::user()->id)->paginate(50);

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $posts = $this->composeQuery($request);

        $posts = $posts->paginate(20);

        $queries = $request->query();
        unset($queries['page']);
        $posts->withPath('?' . http_build_query($queries, '', '&'));

/*
        $posts = Post::when($request->s, function ($query, $request){
            return $query->where(function($query) use ($request) {
                $query->where('title', 'LIKE', "%$request->s%")
                    ->orWhere('content', 'LIKE', "%$request->s%");
            });
        })
        ->when($request->category, function ($query, $request){
            return $query->where('category_id', $request->category);
        })
        ->when($request->author, function ($query, $request){
            return $query->where('user_id', $request->author);
        })
        ->paginate(20);
*/

        $categories = Category::all();
        $users = User::all();

        return view('admin.posts.index', [
            'posts'         => $posts,
            'categories'    => $categories,
            'users'         => $users,
            'request'       => $request
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.create', [
            'categories'    => $categories,
            'tags'          => $tags
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate($this->getValidators(null));

        $data = $request->all();

        $img_path = Storage::put('uploads', $data['post_image']);

        $formData = [
            'user_id'       => Auth::user()->id,
            'post_image'    => $img_path
        ] + $data;

        //dd($formData);

        //preg_match_all('/#([0-9a-zA-Z]*)/', $formData['content'], $tags_from_content);
        preg_match_all('/#(\S*)\b/', $formData['content'], $tags_from_content);

        // TODO: gestire i tag già presenti nel database (evitare doppioni)
        $tagIds = [];
        foreach($tags_from_content[1] as $tag) {
            $newTag = Tag::create([
                'name'  => $tag,
                //'slug'  => Str::slug($tag)
                'slug'  => $tag
            ]);

            $tagIds[] = $newTag->id;
        }

        $formData['tags'] = $tagIds;

        //dd($tags_from_content);


        $post = Post::create($formData);
        $post->tags()->attach($formData['tags']);

        return redirect()->route('admin.posts.show', $post->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if (Auth::user()->id !== $post->user_id) abort(403);
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.edit', [
            'post'          => $post,
            'categories'    => $categories,
            'tags'          => $tags
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        if (Auth::user()->id !== $post->user_id) abort(403);

        $request->validate($this->getValidators($post));
        $formData = $request->all();

        if (array_key_exists('post_image', $formData)) {
            Storage::delete($post->post_image);
            $img_path = Storage::put('uploads', $formData['post_image']);
            $formData = [
                'post_image'    => $img_path
            ] + $formData;
        }

        $post->update($formData);
        if (array_key_exists('tags', $formData)) $post->tags()->sync($formData['tags']);

        return redirect()->route('admin.posts.show', $post->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if (Auth::user()->id !== $post->user_id) abort(403);

        $post->tags()->detach();
        // $post->tags()->sync([]);
        $post->delete();

        if (url()->previous() === route('admin.posts.edit', $post->slug)) {
            return redirect()->route('admin.home')->with('status', "Post $post->title deleted");
        }
        return redirect(url()->previous())->with('status', "Post $post->title deleted");
    }
}
