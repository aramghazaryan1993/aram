<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\PriceListResource;
use Illuminate\Http\Request;
use App\Http\Requests\PriceListRequest;
use App\Repositories\PriceListRepository;
use Illuminate\Http\Response;

/**
 * class PriceListController
 * @package App\Http\Controllers\API
 * @param \App\Http\Requests\PriceListRequest $request
 * @param int $id
 */
class PriceListController extends BaseController
{
    /**
     * @var \App\Repositories\PriceListRepository
     */
    private PriceListRepository $priceListRepository;

    /**
     * @param \App\Repositories\PriceListRepository $priceListRepository
     */
    public function __construct(PriceListRepository $priceListRepository)
    {
        $this->priceListRepository = $priceListRepository;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|object
     */
    public function getPriceList()
    {
        $getPriceList = $this->priceListRepository->getPriceList();
            return $this->response(PriceListResource::collection($getPriceList))->setStatusCode(Response::HTTP_OK);
    }

    /**
     * @param \App\Http\Requests\PriceListRequest $request
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|object
     */
    public function addPriceList(PriceListRequest $request)
    {
        $addPriceList = $this->priceListRepository->addPriceList($request->title, $request->price, $request->text);
        return $this->response(new PriceListResource($addPriceList))->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * @param \App\Http\Requests\PriceListRequest $request
     * @param int                                 $id
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|object
     */
    public function updatePriceList(PriceListRequest $request, int $id)
    {
        $editPriceList = $this->priceListRepository->editPriceList($request->title, $request->price, $request->text, $id);
        return $this->response(new PriceListResource($editPriceList))->setStatusCode(Response::HTTP_CREATED);
    }


}
