<?php

use MezzoLabs\Mezzo\Cockpit\Html\HtmlHelper;

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

if (!function_exists('cockpit_stylesheet')) {
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

if (!function_exists('cockpit_script')) {
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

if (!function_exists('cockpit_html')) {
    /**
     * Gives you a instance of the cockpit html helper class.
     *
     * @return HtmlHelper
     */
    function cockpit_html()
    {
        return new HtmlHelper();
    }
}
