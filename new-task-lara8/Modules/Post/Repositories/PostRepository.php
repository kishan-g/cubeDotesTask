<?php

namespace Modules\Post\Repositories;

use App\Models\Post;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Modules\Post\Interfaces\PostInterface;

class PostRepository implements PostInterface
{
    protected $post;
    public function __construct(Post $post)
    {
        $this->post = $post;
    }
    public function index()
    {
        return $this->post->orderBy('id', 'desc')->simplePaginate(6);
    }
    public function store($request)
    {

        $slug = SlugService::createSlug(Post::class, 'slug', $request->title);
        $post = $this->post->create([
            'title' => $request->title,
            'slug' => $slug,
            'description' => $request->desc,
        ]);

        if ($request->hasFile('thumbnail')) {

            $ext = $request->file('thumbnail')->getClientOriginalExtension();
            $name = basename($request->file('thumbnail')->getClientOriginalName(), "." . $ext);
            $fileName = $name . date('YmdHis') . "." . $ext;
            $dir_path = 'storage/thumbnail/' . date("Y-m-d") . '/' . $post->id;
            $public_path = public_path($dir_path);
            $request->file('thumbnail')->move($public_path, $fileName);
            $post->update(['featured_image' => $dir_path . '/' . $fileName]);
        }
        $post->users()->attach(auth()->user()->id);
    }
    public function show($data)
    {
        $desc = $this->post->select('description')->where('slug', $data['slug'])->get();
        return $desc;
    }
    public function edit($slug)
    {
        return $this->post->where('slug', $slug)->get();
    }
    public function update($data)
    {
        $slug = SlugService::createSlug(Post::class, 'slug', $data->title);
        if ($data->hasFile('thumbnail')) {
            $ext = $data->file('thumbnail')->getClientOriginalExtension();
            $name = basename($data->file('thumbnail')->getClientOriginalName(), "." . $ext);
            $fileName = $name . date('YmdHis') . "." . $ext;
            $dir_path = 'storage/thumbnail/' . date("Y-m-d") . '/' . $data->post_id;
            $public_path = public_path($dir_path);
            $data->file('thumbnail')->move($public_path, $fileName);

            $data = $data->all();
            $postThumbnail = $this->post->select("featured_image")->where('id', $data['post_id'])->get();

            if ($postThumbnail[0]->thumbnail ?? '' and file_exists(public_path($postThumbnail[0]->thumbnail))) {
                unlink(public_path($postThumbnail[0]->thumbnail));
            }

            $this->post->where('id', $data['post_id'])->update([
                'title' => $data['title'],
                'description' => $data['desc'],
                'slug'=>$slug,
                'featured_image' => $dir_path . '/' . $fileName,
            ]);
        } else {
            $data = $data->all();
            $this->post->where('id', $data['post_id'])->update([
                'title' => $data['title'],
                'description' => $data['desc'],
                'slug'=>$slug,
            ]);
        }
        return;
    }
    public function destroy($data)
    {
    
       $post= $this->post->where('slug', $data->slug)->with('users')->get();
     
        if (file_exists(public_path($post[0]['featured_image']))) {
            unlink(public_path($post[0]['featured_image']));
        }
        
       
        $post[0]->users()->detach(auth()->user()->id);
        
       $this->post->where('slug', $data['slug'])->delete();
    }
}
