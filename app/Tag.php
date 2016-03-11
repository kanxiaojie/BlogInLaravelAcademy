<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed tag
 */
class Tag extends Model
{
    protected $fillable = [
        'tag', 'title', 'subtitle', 'page_image', 'meta_description',
        'reverse_direction',
    ];

    /**
     *定义文章与标签多对多关系
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function posts()
    {
        return $this->belongsToMany('App\Post', 'post_tag_pivot');
    }

    public static function addNeededTags(array $tags)
    {
        if(count($tags) === 0){
            return;
        }

        $found = static::whereIn('tag', $tags)->lists('tag')->all();

        foreach(array_diff($tags, $found) as $tag){
            static::create([
                'tag' => $tag,
                'title' => $tag,
                'subtitle' => 'Subtitle for '.$tag,
                'page_image' => '',
                'meta_description' => '',
                'reverse_direction' => false,
            ]);
        }
    }

    /**
     * Return the index layout to use for a tag
     *layout 方法用于返回 Tag 的布局，如果 tag 不存在或者没有布局，返回默认值。
     * @param string $tag
     * @param string $default
     * @return string
     */
    public static function layout($tag, $default = 'blog.layouts.index')
    {
        $layout = static::whereTag($tag)->pluck('layout');

        return $layout ?: $default;
    }
}























