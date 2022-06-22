<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogRequest;
use App\Http\Resources\BlogResource;
use App\Http\Resources\MassageResource;
use Illuminate\Http\Request;
use App\Repositories\BlogRepository;
use Illuminate\Http\Response;

/**
 * class BlogController
 * @package App\Http\Controllers\API
 * @param BlogRequest $request
 * @param BlogRequest $request
 * @param int $id
 */
class BlogController extends BaseController
{
    /**
     * @var BlogRepository
     */
    private BlogRepository $blogRepository;

    /**
     * @param BlogRepository $blogRepository
     */
    public function __construct(BlogRepository $blogRepository)
    {
        $this->blogRepository = $blogRepository;
    }

    /**
     * @param BlogRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|Response|object
     * POST:Functional for add blog
     */
    public function addBlog(BlogRequest $request)
    {
        $addBlog = $this->blogRepository->addBlog($request->title, $request->image, $request->text);
                return $this->response(new BlogResource($addBlog))->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|Response|object
     * GET:Functional for get blog
     */
    public function getBlog()
    {
        $getBlog = $this->blogRepository->getBlog();
            return $this->response(BlogResource::collection($getBlog))->setStatusCode(Response::HTTP_OK);
    }

    /**
     * @param int $id
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|object
     */
    public function getBlogId(int $id)
    {
        $getBlogId = $this->blogRepository->getBlogId($id);
            return $this->response(BlogResource::collection($getBlogId))->setStatusCode(Response::HTTP_OK);
    }

    /**
     * @param BlogRequest $request
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|Response|object
     * POST:Functional for update blog
     */
    public function updateBlog(BlogRequest $request, int $id)
    {
        $editBlog = $this->blogRepository->updateBlog($request->title, $request->image, $request->text, $id);
            return $this->response(new BlogResource($editBlog))->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|Response|object
     * DELETE:Functional for delete blog
     */
    public function deleteBlog(int $id)
    {
        $this->blogRepository->deleteBlog($id);
            return $this->response(new MassageResource('Delete blog successfully.'))->setStatusCode(Response::HTTP_GONE);
    }
}
