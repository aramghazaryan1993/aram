<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;
use App\Http\Resources\MassageResource;
use App\Http\Resources\ServiceResource;
use Illuminate\Http\Request;
use App\Repositories\ServiceRepository;
use Illuminate\Http\Response;

/**
 * Class ServiceController
 * @package App\Http\Controllers\API
 * @param ServiceRequest $request
 * @param int $id
 */
class ServiceController extends BaseController
{
    /**
     * @var ServiceRepository
     */
    private ServiceRepository $serviceRepository;

    /**
     * @param ServiceRepository $serviceRepository
     */
    public function __construct(ServiceRepository $serviceRepository)
    {
        $this->serviceRepository = $serviceRepository;
    }

    /**
     * @param ServiceRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|Response|object|
     * POST:Functional for add service
     */
    public function addService(ServiceRequest $request)
    {
        $addService = $this->serviceRepository->addService($request->title, $request->image, $request->text, $request->text_header, $request->full_text, $request->menu_id);
                return $this->response(new ServiceResource($addService))->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * @param int $menuId
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|object
     * GET:Functional for get service
     */
    public function getService(int $menuId)
    {
        $getService = $this->serviceRepository->getService($menuId);
                return $this->response(new ServiceResource($getService))->setStatusCode(Response::HTTP_OK);
    }

    /**
     * @param ServiceRequest $request
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|Response|object
     * POST:Functional for update service
     */
    public function updateService(ServiceRequest $request, int $id)
    {
        $editService = $this->serviceRepository->updateService($request->title, $request->image, $request->text, $request->text_header, $request->menu_id, $request->full_text, $id);
                    return $this->response(new ServiceResource($editService))->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|Response|object
     * DELETE:Functional for delete service
     */
    public function deleteService(int $id)
    {
        $this->serviceRepository->deleteService($id);
                return $this->response(new MassageResource('Delete service successfully.'))->setStatusCode(Response::HTTP_GONE);
    }
}
