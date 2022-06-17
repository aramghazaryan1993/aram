<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\AdressMenuRepository;
use App\Http\Resources\AdressMenuResource;
use App\Http\Resources\MassageResource;
use App\Http\Requests\AdressMenuRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

/**
 * class AdressMenuController
 * @package App\Http\Controllers\API
 * @param AdressMenuRequest $request
 * @param int $id
 */
class AdressMenuController extends BaseController
{
    /**
     * @var AdressMenuRepository
     */
    private AdressMenuRepository $adressMenuRepository;

    /**
     * @param AdressMenuRepository $adressMenuRepository
     */
    public function __construct(AdressMenuRepository $adressMenuRepository)
    {
        $this->adressMenuRepository = $adressMenuRepository;
    }

    /**
     * @param int $id
     * @return Application|ResponseFactory|Response|object
     * GET:Functional for get adress menu
     */
    public function getAdressMenu(int $id)
    {
        $getAdressMenu = $this->adressMenuRepository->getAdressMenu($id);
        return $this->response(AdressMenuResource::collection($getAdressMenu))->setStatusCode(Response::HTTP_OK);
    }

    /**
     * @param AdressMenuRequest $request
     * @return Application|ResponseFactory|Response|object
     * POST:Functional for add adress menu
     */
    public function addAdressMenu(AdressMenuRequest $request)
    {
        $addAdressMenu = $this->adressMenuRepository->addAdressMenu($request->name, $request->menu_id);
        return $this->response(new AdressMenuResource($addAdressMenu))->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * @param AdressMenuRequest $request
     * @param int $id
     * @return Application|ResponseFactory|Response|object
     * POST:Functional for update adress menu
     */
    public function updateAdressMenu(AdressMenuRequest $request, int $id)
    {
        $editAdressMenu = $this->adressMenuRepository->updateAdressMenu($request->name, $request->menu_id, $id);
        return $this->response(new AdressMenuResource($editAdressMenu))->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * @param int $id
     * @return Application|ResponseFactory|Response|object
     * DELETE:Function for delete adress menu
     */
    public function deleteAdressMenu(int $id)
    {
        $this->adressMenuRepository->deleteAdressMenu($id);
        return $this->response(new MassageResource('Delete adress menu successfully.'))->setStatusCode(Response::HTTP_GONE);
    }
}
