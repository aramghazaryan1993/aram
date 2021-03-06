<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\SelectHomeServiceRequest;
use App\Http\Resources\SelectHomeServiceResource;
use App\Repositories\SelectHomeServiceRepository;
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
use Illuminate\Http\Response;

/**
 * class HomeController
 * @package App\Http\Controllers\API
 * @param HomeRequest $request
 * @param HomeGalleryRequest $request
 * @param int $id
 */
class HomeController extends BaseController
{
    /**
     * @var \App\Repositories\HomeRepository
     */
    private HomeRepository $homeRepository;

    /**
     * @var \App\Repositories\SelectHomeServiceRepository
     */
    private SelectHomeServiceRepository $selectHomeServiceRepository;

    /**
     * @var \App\Repositories\HomeGalleryRepository
     */
    private HomeGalleryRepository $homeGalleryRepository;

    /**
     * @param HomeRepository $homeRepository
     * @param HomeGalleryRepository $homeGalleryRepository
     */
    public function __construct(HomeRepository $homeRepository, HomeGalleryRepository $homeGalleryRepository, SelectHomeServiceRepository $selectHomeServiceRepository)
    {
        $this->homeRepository = $homeRepository;
        $this->homeGalleryRepository = $homeGalleryRepository;
        $this->selectHomeServiceRepository = $selectHomeServiceRepository;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|object
     * GET:Function for get home
     */
    public function getHome()
    {
        $getHome = $this->homeRepository->getHome();
        return $this->response(HomeResource::collection($getHome))->setStatusCode(Response::HTTP_OK);
    }

    /**
     * @param HomeRequest $request
     * @return Application|ResponseFactory|Response|object
     * POST:Function for add home title text
     */
    public function addHome(HomeRequest $request)
    {
        $add = $this->homeRepository->addHome($request->title_one, $request->title_two);
        return $this->response(new HomeResource($add))->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * @param HomeRequest $request
     * @param $id
     * @return Application|ResponseFactory|Response|object
     * POST:Function for update home title text
     */
    public function updateHome(HomeRequest $request, $id)
    {
        $home = $this->homeRepository->updateHome($request->title_one, $request->title_two, $id);
        return $this->response(new HomeResource($home))->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * @param int $id
     * @return Application|ResponseFactory|Response|object
     * DELETE:Function for home title text
     */
    public function deleteHome(int $id)
    {
        $this->homeRepository->deleteHome($id);
        return $this->response(new MassageResource('Delete home text title successfully.'))->setStatusCode(Response::HTTP_GONE);
    }

    /**
     * @return Application|ResponseFactory|Response|object
     * GET: function for get home gallery
     */
    public function getHomeGallery()
    {
        $getHomeGallery = $this->homeGalleryRepository->getHomeGallery();
        return $this->response(HomeGalleryResource::collection($getHomeGallery))->setStatusCode(Response::HTTP_OK);
    }

    /**
     * @param HomeGalleryRequest $request
     * @return Application|ResponseFactory|Response|object
     * POST:Function for add home gallery
     */
    public function addHomeGallery(HomeGalleryRequest $request)
    {
        $addHomeGallery = $this->homeGalleryRepository->addHomeGallery($request->image);
        return $this->response(new HomeGalleryResource($addHomeGallery))->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * @param HomeGalleryRequest $request
     * @param int $id
     * @return Application|ResponseFactory|Response|object
     * POST:Function for update home gallery
     */
    public function updateHomeGallery(HomeGalleryRequest $request, int $id)
    {
        $editHomeGallery = $this->homeGalleryRepository->updateHomeGallery($request->image, $id);
        return $this->response(new HomeGalleryResource($editHomeGallery))->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * @param int $id
     * @return Application|ResponseFactory|Response|object
     * DELETE:Function for delete home gallery
     */
    public function deleteHomeGallery(int $id)
    {
        $this->homeGalleryRepository->deleteHomeGallery($id);
        return $this->response(new MassageResource('Delete home gallery successfully.'))->setStatusCode(Response::HTTP_GONE);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|object
     */
    public function getHomeService()
    {
        $getSelectHomeService = $this->selectHomeServiceRepository->getSelectHomeService();
        return $this->response(SelectHomeServiceResource::collection($getSelectHomeService))->setStatusCode(Response::HTTP_OK);
    }


    public function updateSelectHomeService(SelectHomeServiceRequest $request, int $id)
    {
        $editHomeSelectHomeService = $this->selectHomeServiceRepository->updateSelectHomeService($request->menu_id, $id);
        return $this->response(new SelectHomeServiceResource($editHomeSelectHomeService))->setStatusCode(Response::HTTP_CREATED);
    }
}
