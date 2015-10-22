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

if (!function_exists('cockpit_stylesheet')){
    /**
     * Create a link to a stylesheet for a specific asset.
     *
     * @param string $assetName
     * @return string
     */
    function cockpit_stylesheet($assetName)
    {
        return '<link rel="stylesheet" href="' . cockpit_asset($assetName) . '">';
    }
}

if (!function_exists('cockpit_script')){
    /**
     * Create a script tag for a specific asset.
     *
     * @param string $assetName
     * @return string
     */
    function cockpit_script($assetName)
    {
        return '<script src="' . cockpit_asset($assetName) . '"></script>';
    }
}
