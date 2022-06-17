<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\ContactRepository;
use App\Http\Resources\ContactResource;
use App\Http\Requests\ContactRequest;
use Illuminate\Http\Response;

/**
 * class ContactController
 * @package App\Http\Controllers\API
 * @param ContactRequest $request
 */
class ContactController extends BaseController
{
    /**
     * @var \App\Repositories\ContactRepository
     */
    private ContactRepository $contactRepository;

    /**
     * @param \App\Repositories\ContactRepository $contactRepository
     */
    public function __construct(ContactRepository $contactRepository)
    {
        $this->contactRepository = $contactRepository;
    }

    /**
     * @param ContactRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|object
     * POST:Function for update contacts
     */
    public function update(ContactRequest $request)
    {
        $contact = $this->contactRepository->update($request->phone, $request->email, $request->working, $request->text_header, $request->text_footer, $request->facebook, $request->instagram, $request->logo, $request->image);
        return $this->response(new ContactResource($contact))->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|object
     * GET:Function for get contact
     */
    public function getContact()
    {
        $getContact = $this->contactRepository->getContact();
        return $this->response(ContactResource::collection($getContact))->setStatusCode(Response::HTTP_OK);
    }
}
