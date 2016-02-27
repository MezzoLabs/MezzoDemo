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

    /**
     * @param Campaign $campaign
     * @param $email
     * @param array $mergeData
     * @return string
     * @throws \Exception
     */
    public function render(Campaign $campaign, $email, $mergeData = []) : string
    {
        $user = $this->users->findByEmail($email);

        $data = [
            'user' => $user,
            'email' => $email,
            'campaign' => $campaign,
            'featured_posts' => $this->posts->all()
        ];

        $data = array_merge($data, $mergeData);

        return view('modules.newsletter::emails.campaigns.default', $data)->render();

    }
}