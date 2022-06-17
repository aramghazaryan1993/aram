<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceHeaderImageRequest;
use App\Http\Resources\MassageResource;
use App\Http\Resources\ServiceHeaderImageResource;
use Illuminate\Http\Request;
use App\Repositories\ServiceHeaderImageRepository;
use Illuminate\Http\Response;

/**
 * class ServiceHeaderImageController
 * @package App\Http\Controllers\API
 * @param ServiceHeaderImageRequest $request
 * @param int $id
 */
class ServiceHeaderImageController extends BaseController
{
    /**
     * @var ServiceHeaderImageRepository
     */
    private ServiceHeaderImageRepository $serviceHeaderImageRepository;

    /**
     * @param ServiceHeaderImageRepository $serviceHeaderImageRepository
     */
    public function __construct(ServiceHeaderImageRepository $serviceHeaderImageRepository)
    {
        return $this->serviceHeaderImageRepository = $serviceHeaderImageRepository;
    }

    /**
     * @param ServiceHeaderImageRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|Response|object
     * POST:Function for add service header image
     */
    public function addServiceHeaderImage(ServiceHeaderImageRequest $request)
    {
        $addServiceHomeImage = $this->serviceHeaderImageRepository->addServiceHomeImage($request->image, $request->menu_id);
                return $this->response(new ServiceHeaderImageResource($addServiceHomeImage))->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * @param int $menuId
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|Response|object
     * GET:Function for get service header image
     */
    public function getServiceHeaderImage(int $menuId)
    {
      $getServiceHeaderImage = $this->serviceHeaderImageRepository->getServiceHeaderImage($menuId);
               return $this->response(ServiceHeaderImageResource::collection($getServiceHeaderImage))->setStatusCode(Response::HTTP_OK);
    }

    /**
     * @param ServiceHeaderImageRequest $request
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|Response|object
     * POST:Functional for update service header image
     */
    public function updateServiceHeaderImage(ServiceHeaderImageRequest $request, int $id)
    {
        $editServiceHeaderImage = $this->serviceHeaderImageRepository->updateServiceHeaderImage($request->image, $request->menu_id, $id);
                return $this->response(new ServiceHeaderImageResource($editServiceHeaderImage))->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|Response|object
     * DELETE:Functional for delete service header image
     */
    public function deleteServiceHeaderImage(int $id)
    {
        $this->serviceHeaderImageRepository->deleteServiceHeaderImage($id);
                return $this->response(new MassageResource('Delete header image successfully.'))->setStatusCode(Response::HTTP_GONE);
    }
}
