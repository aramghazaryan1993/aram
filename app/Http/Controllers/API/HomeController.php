<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\HomeRepository;
use App\Http\Resources\HomeResource;
use App\Http\Requests\HomeRequest;
use Illuminate\Http\Response;

class HomeController extends BaseController
{
    /**
     * @var \App\Repositories\HomeRepository|\App\Http\Controllers\API\HomeRepository
     */
    private HomeRepository $homeRepository;

    /**
     * @param \App\Repositories\HomeRepository $homeRepository
     */
    public function __construct(HomeRepository $homeRepository)
    {
        $this->homeRepository = $homeRepository;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|object
     * GET:Function for get home data
     */
    public function getHome()
    {
        $getHome= $this->homeRepository->getHome();
        return $this->response(HomeResource::collection($getHome))->setStatusCode(Response::HTTP_OK);
    }

    /**
     * @param \App\Http\Requests\HomeRequest $request
     * @param                                $id
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|object
     * POST:Function for update home
     */
    public function update(HomeRequest $request,$id)
    {
        $home = $this->homeRepository->update($request->title_one,$request->title_two,$id);
        return $this->response(new HomeResource($home))->setStatusCode(Response::HTTP_CREATED);

    }
}
