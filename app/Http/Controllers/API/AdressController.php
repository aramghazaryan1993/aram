<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdressRequest;
use App\Http\Resources\AdressResource;
use App\Http\Resources\MassageResource;
use App\Repositories\AdressRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * class AdressMenuController
 * @package App\Http\Controllers\API
 * @param \App\Http\Requests\AdressRequest $request
 * @param int $adressMenuId
 */
class AdressController extends BaseController
{
    /**
     * @var \App\Repositories\AdressRepository
     */
    private AdressRepository $adressRepository;

    /**
     * @param \App\Repositories\AdressRepository $adressRepository
     */
    public function __construct(AdressRepository $adressRepository)
    {
        $this->adressRepository = $adressRepository;
    }

    /**
     * @param int $adressMenuId
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|object
     */
    public function getAdress(int $adressMenuId)
    {
        $getAdress = $this->adressRepository->getAdress($adressMenuId);
        return $this->response(AdressResource::collection($getAdress))->setStatusCode(Response::HTTP_OK);
    }

    /**
     * @param \App\Http\Requests\AdressRequest $request
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|object
     */
    public function addAdress(AdressRequest $request)
    {
        $addAdress = $this->adressRepository->addAdress($request->map, $request->text, $request->adress_menu_id);
        return $this->response(new AdressResource($addAdress))->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * @param \App\Http\Requests\AdressRequest $request
     * @param int                              $id
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|object
     */
    public function updateAdress(AdressRequest $request, int $id)
    {
        $updateAdress = $this->adressRepository->updateAdress($request->map, $request->text, $id);
            return $this->response(new AdressResource($updateAdress))->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * @param int $id
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|object
     */
    public function deleteAdress(int $id)
    {
        $this->adressRepository->deleteAdress($id);
            return $this->response(new MassageResource('Delete adress successfully.'))->setStatusCode(Response::HTTP_GONE);
    }
}
