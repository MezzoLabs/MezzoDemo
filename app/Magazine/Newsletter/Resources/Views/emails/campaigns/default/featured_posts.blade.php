@foreach($featured_posts as $post)
    @include('modules.newsletter::emails.campaigns.default.post', ['mode' => 'preview', 'post' => $post ])
@endforeach