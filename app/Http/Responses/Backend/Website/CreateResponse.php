<?php

namespace App\Http\Responses\Backend\Website;

use Illuminate\Contracts\Support\Responsable;

class CreateResponse implements Responsable
{
    public $countryall;

    public function __construct($country)
    {
        $this->countryall = $country;
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
        return view('backend.websites.create')->with(
            [
                'countryall' => $this->countryall
            ]
        );
    }
}