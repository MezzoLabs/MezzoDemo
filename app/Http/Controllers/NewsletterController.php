<?php


namespace App\Http\Controllers;


use App\Http\Requests\NewsletterSignupRequest;
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
        $this->middleware('guest', ['only' => ['getSignup', 'postSignup']]);

    }

    public function getSignup()
    {
        return view('magazine.newsletter_signup');
    }

    public function postSignup(NewsletterSignupRequest $request)
    {
        $this->newsletterService->signupEmail($request->get('email'));
        return \Redirect::home()->with('message', 'Please check your mail.');
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