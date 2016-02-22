<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>{{ $campaign->title }}</title>
    <style type="text/css">
    </style>
</head>
<body yahoofix>

@include('modules.newsletter::emails.campaigns.default.content', ['content' => $campaign->content])

@include('modules.newsletter::emails.campaigns.default.featured_posts', ['featured_posts' => ])

</body>
</html>