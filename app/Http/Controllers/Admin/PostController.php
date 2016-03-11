<?php

namespace App\Http\Controllers\Admin;
use App\Post;
use App\Http\Requests;
use App\Jobs\PostFormFields;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostCreateRequest;
use App\Http\Requests\PostUpdateRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the posts.
     */
    public function index()
    {
        return view('admin.post.index')->withPosts(Post::all());
    }

    /**
     * Show the new post form
     */
    public function create()
    {
        $data = $this->dispatch(new PostFormFields());

        return view('admin.post.create', $data);
    }

    /**
     * 保存
     * @param PostCreateRequest $request
     */
    public function store(PostCreateRequest $request)
    {
        $post = Post::create($request->postFillData());
        $post -> sysnTags($request->get('tags', []));

        return redirect()
            ->route('admin.post.index')
            ->withSuccess('New Post Successfully Created.');
    }

    /**
     * 修改
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id){
        $data = $this->dispatch(new PostFormFields($id));

        return view('admin.post.edit', $data);
    }

    /**
     * 更新
     * @param PostUpdateRequest $request
     * @param $id
     */
    public function update(PostUpdateRequest $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->fill($request->postFillData());
        $post->save();
        $post->syncTags($request->get('tags', []));

        if($request->action === 'continue'){
            return redirect()
                ->back()
                ->withSuccess('Post saved');
        }

        return redirect()
            ->route('admin.post.index')
            ->withSuccess('Post saved.');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->tags()->detach();
        $post->delete();

        return redirect()
            ->route('admin.post.index')
            ->withSuccess('Post deleted.');
    }
}



















