<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\AdressMenuRepository;
use App\Http\Resources\AdressMenuResource;
use App\Http\Resources\MassageResource;
use App\Http\Requests\AdressMenuRequest;
use App\Models\AdressMenu;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\Response;
use InvalidArgumentException;

/**
 * class AdressMenuController
 * @package App\Http\Controllers\API
 * @param AdressMenuRepository $request
 * @param int $id
 */
class AdressMenuController extends BaseController
{
    /**
     * 
     *  @var \App\Repositories\AdressMenuRepository
     */
    private AdressMenuRepository $adressMenuRepository;

    /**
     * 
     * @param AdressMenuRepository $adressMenuRepository 
     * @return void 
     */
    public function __construct(AdressMenuRepository $adressMenuRepository)
    {
        $this->adressMenuRepository = $adressMenuRepository;
    }

    /**
     * 
     * @param int $int 
     * @return Application|ResponseFactory|Response 
     * @throws BindingResolutionException 
     * @throws InvalidArgumentException 
     */
    public function getAdressMenu(int $id)
    {
        $getAdressMenu = $this->adressMenuRepository->getAdressMenu($id);
        return $this->response(AdressMenuResource::collection($getAdressMenu))->setStatusCode(Response::HTTP_OK);
    }

    /**
     * 
     * @param AdressMenuRequest $request 
     * @return Application|ResponseFactory|Response 
     * @throws BindingResolutionException 
     * @throws InvalidArgumentException 
     */
    public function addAdressMenu(AdressMenuRequest $request)
    {
        $addAdressMenu = $this->adressMenuRepository->addAdressMenu($request->name, $request->menu_id);
        return $this->response(new AdressMenuResource($addAdressMenu))->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * 
     * @param AdressMenuRequest $request 
     * @param int $id 
     * @return Application|ResponseFactory|Response 
     * @throws BindingResolutionException 
     * @throws InvalidArgumentException 
     */
    public function updateAdressMenu(AdressMenuRequest $request, int $id)
    {
        $editAdressMenu = $this->adressMenuRepository->updateAdressMenu($request->name, $request->menu_id, $id);
        return $this->response(new AdressMenuResource($editAdressMenu))->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * 
     * @param int $id 
     * @return Application|ResponseFactory|Response 
     * @throws BindingResolutionException 
     * @throws InvalidArgumentException 
     */
    public function deleteAdressMenu(int $id)
    {
        $this->adressMenuRepository->deleteAdressMenu($id);
        return $this->response(new MassageResource('Delete adress menu successfully.'))->setStatusCode(Response::HTTP_GONE);
    }
}
