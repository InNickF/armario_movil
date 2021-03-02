<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\PostDataTable;
use App\Helpers\JsonHelper;
use App\Http\Requests\Admin\CreatePostRequest;
use App\Http\Requests\Admin\UpdatePostRequest;
use App\Models\PostCategory;
use App\Repositories\Admin\PostRepository;
use Response;

class PostController extends \App\Http\Controllers\Controller
{
    /** @var PostRepository */
    private $postRepository;

    public function __construct(PostRepository $postRepo)
    {
        $this->postRepository = $postRepo;
    }

    /**
     * Display a listing of the Post.
     *
     * @return Response
     */
    public function index(PostDataTable $postDataTable)
    {
        return $postDataTable->render('admin.posts.index');
    }

    /**
     * Show the form for creating a new Post.
     *
     * @return Response
     */
    public function create()
    {
        $categories = PostCategory::all();

        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created Post in storage.
     *
     * @return Response
     */
    public function store(CreatePostRequest $request)
    {
        $input = $request->all();
        $input['user_id'] = auth()->user()->id;

        $post = $this->postRepository->create($input);

        if (isset($input['main_image'])) {
            $mainImage = JsonHelper::jsonOrEmpty($input['main_image']);
            if (!empty($mainImage)) {
                $post->saveMainImage($mainImage['path']);
            }
        }

        alert()->success('Post creado.');

        return redirect(route('admin.posts.index'));
    }

    /**
     * Display the specified Post.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $post = $this->postRepository->findWithoutFail($id);

        if (empty($post)) {
            alert()->error('Post not found');

            return redirect(route('admin.posts.index'));
        }

        return view('admin.posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified Post.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $post = $this->postRepository->findWithoutFail($id);

        if (empty($post)) {
            alert()->error('Post not found');

            return redirect(route('admin.posts.index'));
        }

        $categories = PostCategory::all();

        return view('admin.posts.edit')->with('post', $post)->withCategories($categories);
    }

    /**
     * Update the specified Post in storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function update($id, UpdatePostRequest $request)
    {
        $post = $this->postRepository->findWithoutFail($id);

        if (empty($post)) {
            alert()->error('Post not found');

            return redirect(route('admin.posts.index'));
        }

        $input = request()->all();
        $post = $this->postRepository->update($input, $id);

        $images = $post->media;

        if (isset($input['main_image'])) {
            $mainImage = JsonHelper::jsonOrEmpty($input['main_image']);
            // $mainImage = $mainImage[0] ?? null;

            if ($mainImage && !isset($mainImage['manuallyAdded']) || !$mainImage['manuallyAdded']) {
                foreach ($images as $key => $image) {
                    if ($image->hasCustomProperty('isMain')) {
                        $image->delete();
                    }
                }

                $post->saveMainImage($mainImage['path']);
            }
        }

        alert()->success('Post actualizado.');

        return back();
    }

    /**
     * Remove the specified Post from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $post = $this->postRepository->findWithoutFail($id);

        if (empty($post)) {
            alert()->error('Post not found');

            return redirect(route('admin.posts.index'));
        }

        $this->postRepository->delete($id);

        alert()->success('Post ha sido eliminado');

        return redirect(route('admin.posts.index'));
    }
}