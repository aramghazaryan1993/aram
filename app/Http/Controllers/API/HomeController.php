<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\HomeRepository;
use App\Repositories\HomeGalleryRepository;
use App\Http\Resources\HomeResource;
use App\Http\Resources\HomeGalleryResource;
use App\Http\Requests\HomeRequest;
use App\Http\Requests\HomeGalleryRequest;
use Illuminate\Http\Response;

class HomeController extends BaseController
{
    /**
     * @var \App\Repositories\HomeRepository
     */
    private HomeRepository $homeRepository;

    /**
     * @var \App\Repositories\HomeGalleryRepository
     */
    private HomeGalleryRepository $homeGalleryRepository;

    /**
     * @param \App\Repositories\HomeRepository        $homeRepository
     * @param \App\Repositories\HomeGalleryRepository $homeGalleryRepository
     */
    public function __construct(HomeRepository $homeRepository, HomeGalleryRepository $homeGalleryRepository)
    {
        $this->homeRepository = $homeRepository;
        $this->homeGalleryRepository = $homeGalleryRepository;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|object
     * GET:Function for get home data
     */
    public function getHome()
    {
        $getHome = $this->homeRepository->getHome();

        return $this->response(HomeResource::collection($getHome))->setStatusCode(Response::HTTP_OK);
    }

    /**
     * @param \App\Http\Requests\HomeRequest $request
     * @param                                $id
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|object
     * POST:Function for update home
     */
    public function update(HomeRequest $request, $id)
    {
        $home = $this->homeRepository->update($request->title_one, $request->title_two, $id);
        return $this->response(new HomeResource($home))->setStatusCode(Response::HTTP_CREATED);
    }


    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|object
     * GET: function get home gallery
     */
    public function getHomeGallery()
    {
        $getHomeGallery = $this->homeGalleryRepository->getHomeGallery();
        return $this->response(HomeGalleryResource::collection($getHomeGallery))->setStatusCode(Response::HTTP_OK);
    }


    /**
     * @param \App\Http\Requests\HomeGalleryRequest $request
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|object
     * POST: function add home gallery
     */
    public function addHomeGallery(HomeGalleryRequest $request)
    {
        $addHomeGallery = $this->homeGalleryRepository->addHomeGallery($request->image);
        return $this->response(new HomeGalleryResource($addHomeGallery))->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * @param \App\Http\Requests\HomeGalleryRequest $request
     * @param                                       $id
     * POST: function update home gallery
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|object
     */
    public function updateHomeGallery(HomeGalleryRequest $request, $id)
    {
        $editHomeGallery = $this->homeGalleryRepository->updateHomeGallery($request->image, $id);
        return $this->response(new HomeGalleryResource($editHomeGallery))->setStatusCode(Response::HTTP_CREATED);
    }
}
