<?php


namespace App\Magazine\Newsletter\Campaigns\Templates;


use App\Magazine\Newsletter\Domain\Models\Campaign;
use App\Repositories\UserRepository;
use App\User;
use MezzoLabs\Mezzo\Modules\Posts\Domain\Repositories\PostRepository;

class DefaultTemplate extends CampaignTemplate
{
    /**
     * @var PostRepository
     */
    private $posts;
    /**
     * @var UserRepository
     */
    private $users;

    /**
     * DefaultTemplate constructor.
     * @param PostRepository $posts
     * @param UserRepository $users
     */
    public function __construct(PostRepository $posts, UserRepository $users)
    {

        $this->posts = $posts;
        $this->users = $users;
    }

    public function render(Campaign $campaign, $email)
    {
        $user = $this->users->findByEmail($email);

        return view('modules.newsletter.emails.campaigns.default', ['user' => $user, 'campaign' => $campaign, 'featured_posts' => $this->posts->all()])->render();

    }
}