<?php

if (!function_exists('cockpit_asset')){
    /**
     * Get the URI to a specific asset (Css/Js/Image..).
     *
     * @param string $assetName
     * @return string
     */
    function cockpit_asset($assetName)
    {
        return '/mezzolabs/mezzo/cockpit' . $assetName;
    }
}

