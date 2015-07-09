<?php

Route::group(array('prefix' => 'mezzo'), function()
{

    Route::get('/', function()
    {
        return "welcome";
    });

});