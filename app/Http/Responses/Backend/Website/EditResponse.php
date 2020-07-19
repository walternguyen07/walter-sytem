<?php

namespace App\Http\Responses\Backend\Website;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    /**
     * @var App\Models\Website\Website
     */
    protected $websites;

    /**
     * @param App\Models\Website\Website $websites
     */
    public function __construct($websites)
    {
        $this->websites = $websites;
    }

    /**
     * To Response
     *
     * @param \App\Http\Requests\Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function toResponse($request)
    {
        return view('backend.websites.edit')->with([
            'websites' => $this->websites
        ]);
    }
}