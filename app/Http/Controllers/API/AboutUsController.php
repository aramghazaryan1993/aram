<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\AboutUsRequest;
use App\Http\Resources\AboutUsResource;
use Illuminate\Http\Request;
use App\Repositories\AboutUsRepository;
use Illuminate\Http\Response;

/**
 * class AboutUsController
 * @package App\Http\Controllers\API
 * @param AboutUsRequest $request
 */
class AboutUsController extends BaseController
{
    /**
     * @var AboutUsRepository
     */
    private AboutUsRepository $aboutUsRepository;

    /**
     * @param AboutUsRepository $aboutUsRepository
     */
    public function __construct(AboutUsRepository $aboutUsRepository)
    {
        $this->aboutUsRepository = $aboutUsRepository;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|Response|object
     * GET:Functional for get about us
     */
    public function getAboutUs()
    {
        $getAboutUs = $this->aboutUsRepository->getAboutUs();
                return $this->response(AboutUsResource::collection($getAboutUs))->setStatusCode(Response::HTTP_OK);
    }

    /**
     * @param AboutUsRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|Response|object
     * POST:Functional for update about us
     */
    public function updateAboutUs(AboutUsRequest $request)
    {
        $updateAboutUs = $this->aboutUsRepository->updateAboutUs($request->title, $request->mini_text, $request->image, $request->text);
                    return $this->response(new AboutUsResource($updateAboutUs))->setStatusCode(Response::HTTP_CREATED);
    }
}
