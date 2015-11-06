<form method="POST" action="/test/file/38" enctype="multipart/form-data">
    {!! csrf_field() !!}
    <input name="filename" value="photo_1445251836269_d158eaa028a6_2.jpeg"/>
    <input name="folder" value="default" />

    <input type="submit"/>
</form>