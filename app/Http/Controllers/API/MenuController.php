<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\MenuResource;
use Illuminate\Http\Request;
use App\Repositories\MenuRepository;
use App\Repositories\SubMenuRepository;
use App\Repositories\ChildeMenuRepository;
use App\Http\Resources\MenuResourceResource;
use App\Http\Resources\SubMenuResource;
use App\Http\Resources\ChildeMenuResource;
use App\Http\Requests\MenuRequestRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class MenuController extends BaseController
{
    /**
     * @var \App\Repositories\MenuRepository
     * @var \App\Repositories\SubMenuRepository
     * @var \App\Repositories\ChildeMenuRepository
     */
    private MenuRepository $menuRepository;
    private SubMenuRepository $subMenuRepository;
    private ChildeMenuRepository $childeMenuRepository;

    /**
     * @param \App\Repositories\MenuRepository       $menuRepository
     * @param \App\Repositories\SubMenuRepository    $subMenuRepository
     * @param \App\Repositories\ChildeMenuRepository $childeMenuRepository
     */
    public function __construct(MenuRepository $menuRepository, SubMenuRepository $subMenuRepository, ChildeMenuRepository $childeMenuRepository)
    {
        $this->menuRepository = $menuRepository;
        $this->subMenuRepository = $subMenuRepository;
        $this->childeMenuRepository = $childeMenuRepository;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|object
     */
    public function getMenu()
    {
        $getMenu = $this->menuRepository->getMenu();
        return $this->response(MenuResource::collection($getMenu))->setStatusCode(Response::HTTP_OK);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|object
     */
    public function getSubMenu()
    {
        $getSubMenu = $this->subMenuRepository->getSubMenu();
        return $this->response(SubMenuResource::collection($getSubMenu))->setStatusCode(Response::HTTP_OK);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|object
     */
    public function getChildeMenu()
    {
        $getChildeMenu = $this->childeMenuRepository->getChildeMenu();
        return $this->response(ChildeMenuResource::collection($getChildeMenu))->setStatusCode(Response::HTTP_OK);
    }

}
