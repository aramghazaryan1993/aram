<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\HomeRepository;
use App\Repositories\HomeGalleryRepository;
use App\Http\Resources\HomeResource;
use App\Http\Resources\HomeGalleryResource;
use App\Http\Resources\MassageResource;
use App\Http\Requests\HomeRequest;
use App\Http\Requests\HomeGalleryRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\Response;
use InvalidArgumentException;

/**
 * class HomeController
 * @package App\Http\Controllers\API
 * @param HomeRepository $request
 * @param HomeGalleryRepository $request
 * @param int $id
 */
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
     * 
     * @param HomeRequest $request 
     * @return void 
     * POST:Function for add home title text
     */
    public function addHome(HomeRequest $request)
    {
        $add = $this->homeRepository->addHome($request->title_one, $request->title_two);
        return $this->response(new HomeResource($add))->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * @param \App\Http\Requests\HomeRequest $request
     * @param                                $id
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|object
     * POST:Function for update home title text
     */
    public function update(HomeRequest $request, $id)
    {
        $home = $this->homeRepository->update($request->title_one, $request->title_two, $id);
        return $this->response(new HomeResource($home))->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * 
     * @param int $id 
     * @return Application|ResponseFactory|Response 
     * @throws BindingResolutionException 
     * @throws InvalidArgumentException 
     * DELETE:Function for home title text
     */
    public function delete(int $id)
    {
        $this->homeRepository->delete($id);
        return $this->response(new MassageResource('Delete home text successfully.'))->setStatusCode(Response::HTTP_GONE);
    }


    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|object
     * GET: function for get home gallery
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
     * POST: function for add home gallery
     */
    public function addHomeGallery(HomeGalleryRequest $request)
    {
        $addHomeGallery = $this->homeGalleryRepository->addHomeGallery($request->image);
        return $this->response(new HomeGalleryResource($addHomeGallery))->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * @param \App\Http\Requests\HomeGalleryRequest $request
     * @param                                       $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|object
     * POST: function for update home gallery
     */
    public function updateHomeGallery(HomeGalleryRequest $request, int $id)
    {
        $editHomeGallery = $this->homeGalleryRepository->updateHomeGallery($request->image, $id);
        return $this->response(new HomeGalleryResource($editHomeGallery))->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * @param int $id
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|object
     * DELETE: function for delete home gallery
     */
    public function deleteHomeGallery(int $id)
    {
        $this->homeGalleryRepository->deleteHomeGallery($id);
        return $this->response(new MassageResource('Delete home gallery successfully.'))->setStatusCode(Response::HTTP_GONE);
    }
}
