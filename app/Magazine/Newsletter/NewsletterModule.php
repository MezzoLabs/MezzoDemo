<?php


namespace App\Magazine\Newsletter;


use MezzoLabs\Mezzo\Core\Modularisation\ModuleProvider;

class NewsletterModule extends ModuleProvider
{
    protected $models = [
        \App\Campaign::class,
        \App\NewsletterRecipient::class
    ];

    protected $options = [
        'icon' => 'ion-ios-paper'
    ];

    /**
     * Called when module is ready, model reflections are loaded.
     *
     * @return mixed
     */
    public function ready()
    {
        $this->loadViews();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->optionRegistry()->register([
            'newsletter::footer:unsubscribe' => [
                'title' => 'Footer ',
                'rules' => 'required',
                'inputType' => RichTextArea::class
            ],
            'magazine::social-media_youtube' => [
                'title' => 'Social media: Youtube',
                'rules' => 'required|url',
                'inputType' => UrlInput::class
            ],
            'magazine::social-media_facebook' => [
                'title' => 'Social media: Facebook',
                'rules' => 'required|url',
                'inputType' => UrlInput::class
            ],
            'magazine::social-media_twitter' => [
                'title' => 'Social media: Twitter',
                'rules' => 'required|url',
                'inputType' => UrlInput::class
            ],
            'magazine::social-media_gplus' => [
                'title' => 'Social media: Google plus',
                'rules' => 'required|url',
                'inputType' => UrlInput::class
            ]
        ]);

    }


}