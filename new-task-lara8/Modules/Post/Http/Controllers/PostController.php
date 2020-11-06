<?php

namespace Modules\Post\Http\Controllers;

use App\Models\Post;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Post\Http\Requests\PostRequest;
use Modules\Post\Interfaces\PostInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PostController extends Controller
{
    use AuthorizesRequests;
    protected $postInterface;
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(PostInterface $postInterface)
    {
        $this->middleware('auth');
        $this->postInterface = $postInterface;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        
        $data['posts']= $this->postInterface->index();
        return view('post::index',$data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $this->authorize('create',Post::class);
        return view('post::addPost');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(PostRequest $request)
    {
        $this->postInterface->store($request);
        return redirect()->route('post.index')->with('success', 'post create successfully');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(Request $request)
    {
        $result = $this->postInterface->show($request->all());
        return response()->json([
            'status' => 'success',
            'result' => $result,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($slug)
    {
        $this->authorize('edit',Post::class);
        $data['post']= $this->postInterface->edit($slug);
        return view('post::addPost',$data);
       
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request)
    {
        
        $this->postInterface->update($request);
        return redirect()->route('post.index')->with('success', 'post update successfully');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Request $request)
    {
        $this->authorize('delete',Post::class);
        $this->postInterface->destroy($request);
        // return response()->json([
        //     'status' => 'success',
        // ]);
        
        
    }
}
