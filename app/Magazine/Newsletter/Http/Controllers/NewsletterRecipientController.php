<?php

namespace App\Magazine\Newsletter\Http\Controllers;


use App\Magazine\Newsletter\Http\Pages\NewsletterRecipient\CreateNewsletterRecipientPage;
use App\Magazine\Newsletter\Http\Pages\NewsletterRecipient\EditNewsletterRecipientPage;
use App\Magazine\Newsletter\Http\Pages\NewsletterRecipient\IndexNewsletterRecipientPage;
use MezzoLabs\Mezzo\Http\Controllers\CockpitResourceController;
use MezzoLabs\Mezzo\Http\Requests\Resource\CreateResourceRequest;
use MezzoLabs\Mezzo\Http\Requests\Resource\EditResourceRequest;
use MezzoLabs\Mezzo\Http\Requests\Resource\IndexResourceRequest;
use MezzoLabs\Mezzo\Http\Requests\Resource\ShowResourceRequest;
use MezzoLabs\Mezzo\Http\Responses\ModuleResponse;

class NewsletterRecipientController extends CockpitResourceController
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexResourceRequest $request
     * @return ModuleResponse
     */
    public function index(IndexResourceRequest $request)
    {
        return $this->page(IndexNewsletterRecipientPage::class);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param CreateResourceRequest $request
     * @return ModuleResponse
     */
    public function create(CreateResourceRequest $request)
    {
        return $this->page(CreateNewsletterRecipientPage::class);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @param ShowResourceRequest $request
     * @return ModuleResponse
     */
    public function show(ShowResourceRequest $request, $id)
    {
        // TODO: Implement show() method.
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param EditResourceRequest $request
     * @param  int $id
     * @return ModuleResponse
     */
    public function edit(EditResourceRequest $request, $id = 0)
    {
        return $this->page(EditNewsletterRecipientPage::class);
    }
}