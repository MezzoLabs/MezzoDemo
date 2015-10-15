<?php
use Illuminate\Support\Debug\Dumper;

/**
 * Get the Mezzo core directly
 *
 * @return \MezzoLabs\Mezzo\Core\Mezzo
 */
function mezzo()
{
    return app()->make('mezzo');
}

/**
 * The path of the mezzo folder (...vendor/mezzolabs/mezzo)
 *
 * @return string
 */
function mezzo_path()
{
    return realpath(__DIR__ . "/../../");
}

/**
 * The path of the mezzo folder (...vendor/mezzolabs/mezzo/src)
 *
 * @return string
 */
function mezzo_source_path()
{
    return mezzo_path() . '/src/';
}

if (!function_exists('mezzo_dump')) {
    /**
     * Dump the passed variables.
     *
     * @param $toDump
     * @param string $title
     * @internal param $mixed
     * @return void
     */
    function mezzo_dump($toDump, $title = "", $stepsBack = 0)
    {
        if (!empty($title))
            $title = "<b>$title</b> ";

        $title .= '<small>(' . debug_backtrace()[$stepsBack]['file'] . ':' . debug_backtrace()[0]['line'] . ')</small>';

        echo $title . ':<br/>';

        (new Dumper())->dump($toDump);
    }
}

if (!function_exists('mezzo_dd')) {
    /**
     * Dump the passed variables.
     *
     * @param $toDump
     * @param string $title
     * @internal param $mixed
     * @return void
     */
    function mezzo_dd($toDump)
    {
        mezzo_dump($toDump, "", 1);
        die();
    }
}

if (!function_exists('mezzo_textdump')) {
    /**
     * Dump the passed variables.
     *
     * @param $toDump
     * @param string $title
     * @internal param $mixed
     * @return void
     */
    function mezzo_textdump($toDump)
    {
        echo '<pre>';
        echo str_replace('<?php', 'OPENING', $toDump);
        echo '<pre>';

    }
}

if (!function_exists('mezzo_route')) {
    /**
     * @return \MezzoLabs\Mezzo\Core\Routing\Router
     */
    function mezzo_route()
    {
        return mezzo()->makeRouter();

    }
}