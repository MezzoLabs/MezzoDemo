<?php


namespace App\Http\Controllers;


use App\Magazine\Newsletter\Domain\Services\NewsletterService;

class NewsletterController extends Controller
{
    /**
     * @var NewsletterService
     */
    private $newsletterService;

    public function __construct(NewsletterService $newsletterService)
    {
        $this->newsletterService = $newsletterService;
    }

    public function getConfirm($code)
    {
        $this->newsletterService->confirmRecipient($code);
        return \Redirect::home()->with('message', 'Newsletter confirmed.');
    }

    public function getReject($code)
    {
        $this->newsletterService->rejectRecipient($code);
        return \Redirect::home()->with('message', 'Newsletter rejected.');
    }
}