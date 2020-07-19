<?php

namespace App\Http\Controllers\Backend\Website;

use App\Models\Website\Website;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Http\Responses\Backend\Website\CreateResponse;
use App\Http\Responses\Backend\Website\EditResponse;
use App\Repositories\Backend\Website\WebsiteRepository;
use App\Http\Requests\Backend\Website\ManageWebsiteRequest;
use App\Http\Requests\Backend\Website\CreateWebsiteRequest;
use App\Http\Requests\Backend\Website\StoreWebsiteRequest;
use App\Http\Requests\Backend\Website\EditWebsiteRequest;
use App\Http\Requests\Backend\Website\UpdateWebsiteRequest;
use App\Http\Requests\Backend\Website\DeleteWebsiteRequest;
use Countries;
/**
 * WebsitesController
 */
class WebsitesController extends Controller
{
    /**
     * variable to store the repository object
     * @var WebsiteRepository
     */
    protected $repository;

    /**
     * contructor to initialize repository object
     * @param WebsiteRepository $repository;
     */
    public function __construct(WebsiteRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  App\Http\Requests\Backend\Website\ManageWebsiteRequest  $request
     * @return \App\Http\Responses\ViewResponse
     */
    public function index(ManageWebsiteRequest $request)
    {
        return new ViewResponse('backend.websites.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @param  CreateWebsiteRequestNamespace  $request
     * @return \App\Http\Responses\Backend\Website\CreateResponse
     */
    public function create(CreateWebsiteRequest $request)
    {
        $countries = new Countries();
        $counntryall = Countries::getList('en');
        return new CreateResponse($counntryall);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreWebsiteRequestNamespace  $request
     * @return \App\Http\Responses\RedirectResponse
     */
    public function store(StoreWebsiteRequest $request)
    {
        //Input received from the request
        $input = $request->except(['_token']);
        //Create the model using repository create method
        $this->repository->create($input);
        //return with successfull message
        return new RedirectResponse(route('admin.websites.index'), ['flash_success' => trans('alerts.backend.websites.created')]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Models\Website\Website  $website
     * @param  EditWebsiteRequestNamespace  $request
     * @return \App\Http\Responses\Backend\Website\EditResponse
     */
    public function edit(Website $website, EditWebsiteRequest $request)
    {
        return new EditResponse($website);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateWebsiteRequestNamespace  $request
     * @param  App\Models\Website\Website  $website
     * @return \App\Http\Responses\RedirectResponse
     */
    public function update(UpdateWebsiteRequest $request, Website $website)
    {
        //Input received from the request
        $input = $request->except(['_token']);
        //Update the model using repository update method
        $this->repository->update( $website, $input );
        //return with successfull message
        return new RedirectResponse(route('admin.websites.index'), ['flash_success' => trans('alerts.backend.websites.updated')]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  DeleteWebsiteRequestNamespace  $request
     * @param  App\Models\Website\Website  $website
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy(Website $website, DeleteWebsiteRequest $request)
    {
        //Calling the delete method on repository
        $this->repository->delete($website);
        //returning with successfull message
        return new RedirectResponse(route('admin.websites.index'), ['flash_success' => trans('alerts.backend.websites.deleted')]);
    }

}
