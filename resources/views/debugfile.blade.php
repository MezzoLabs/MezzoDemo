
<form method="POST" action="/test/file" enctype="multipart/form-data">
    {!! csrf_field() !!}
    <input type="file" name="file"/>
    <input name="filename" value="photo_1445251836269_d158eaa028a6_2.jpeg"/>
    <input name="folder" value="default" />

    <input type="submit"/>
</form>