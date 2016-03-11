<?php

namespace App\Http\Controllers\Admin;

use App\Tag;
use Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\TagCreateRequest;
use App\Http\Requests\TagUpdateRequest;

class TagController extends Controller
{
    protected $fields = [
        'tag' => '',
        'title' => '',
        'subtitle' => '',
        'meta_description' => '',
        'page_image' => '',
        'layout' => 'blog.layouts.index',
        'reverse_direction' => 0,
    ];

    public function index()
    {
        $tags = Tag::all();//获取数据
        return view('admin.tag.index')->withTags($tags);
    }

    /**
     *Show form for creating new tag
     */
    public function create()
    {
        $data = [];
        foreach($this->fields as $field => $default){
            $data[$field] = old($field, $default);
        }

        return view('admin.tag.create', $data);
    }

    /**
     * 存储标签
     * @param TagCreateRequest $request
     */
    public function store(TagCreateRequest $request)
    {
        $tag = new Tag();
        foreach (array_keys($this->fields) as $field) {
            $tag->$field = $request->get($field);
        }
        $tag->save();

        return redirect('/admin/tag')
            ->withSuccess("The tag '$tag->tag' was created.");
    }

    /**
     * 修改
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $tag = Tag::findOrFail($id);
        $data = ['id' => $id];
        foreach(array_keys($this->fields) as $field){
            $data[$field] = old($field, $tag->$field);
        }

        return view('admin.tag.edit', $data);
    }

    /**
     * 更新操作
     * @param TagUpdateRequest $request
     * @param $id
     */
    public function update(TagUpdateRequest $request, $id)
    {
        $tag = Tag::findOrFail($id);

        foreach(array_keys(array_except($this->fields, ['tag'])) as $field){
            $tag->$field = $request->get($field);
        }
        $tag->save();

        return redirect('/admin/tag/$id/edit')
            ->withSuccess('Changes saved.');
    }

    /**
     * 删除操作
     * @param $id
     */
    public function destroy($id)
    {
        $tag = Tag::findOrFail($id);
        $tag->delete();

        return redirect('/admin/tag')
                        ->withSuccess("The '$tag->tag' tag has been deleted.");
    }
}
