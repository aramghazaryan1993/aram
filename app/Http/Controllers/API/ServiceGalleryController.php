<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\MassageResource;
use Illuminate\Http\Request;
use App\Repositories\ServiceGalleryRepository;
use App\Http\Requests\ServiceGalleryRequest;
use App\Http\Resources\ServiceGalleryResource;
use Illuminate\Http\Response;

/**
 * class ServiceGalleryController
 * @package App\Http\Controllers\API
 * @param ServiceGalleryRequest $request
 * @param int $id
 */
class ServiceGalleryController extends BaseController
{
    /**
     * @var ServiceGalleryRepository
     */
    private ServiceGalleryRepository $serviceGalleryRepository;

    /**
     * @param ServiceGalleryRepository $serviceGalleryRepository
     */
    public function __construct(ServiceGalleryRepository $serviceGalleryRepository)
    {
        $this->serviceGalleryRepository = $serviceGalleryRepository;
    }

    /**
     * @param int $menuId
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|Response|object
     * GET:Function for get service gallery
     */
    public function getServiceGallery(int $menuId)
    {
        $getServiceGallery = $this->serviceGalleryRepository->getServiceGallery($menuId);
            return $this->response(ServiceGalleryResource::collection($getServiceGallery))->setStatusCode(Response::HTTP_OK);
    }

    /**
     * @param ServiceGalleryRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|Response|object
     * GET:Function for add service gallery
     */
    public function addServiceGallery(ServiceGalleryRequest $request)
    {
      $addServiceGallery = $this->serviceGalleryRepository->addServiceGallery($request->image, $request->menu_id);
        return $this->response(new ServiceGalleryResource($addServiceGallery))->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * @param ServiceGalleryRequest $request
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|Response|object
     * GET:Function for update service gallery
     */
    public function updateServiceGallery(ServiceGalleryRequest $request, int $id)
    {
        $editServiceGallery = $this->serviceGalleryRepository->updateServiceGallery($request->image, $request->menu_id, $id);
            return $this->response(new ServiceGalleryResource($editServiceGallery))->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|Response|object
     * DELETE:Function for delete service gallery
     */
    public function deleteServiceGallery(int $id)
    {
        $this->serviceGalleryRepository->deleteServiceGallery($id);
            return $this->response(new MassageResource('Delete home gallery successfully.'))->setStatusCode(Response::HTTP_CREATED);
    }
}
