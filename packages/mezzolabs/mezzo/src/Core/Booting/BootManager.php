<?php


namespace MezzoLabs\Mezzo\Core\Booting;


use Illuminate\Contracts\Foundation\Application;
use MezzoLabs\Mezzo\Core\Booting\Bootstrappers\IncludeThirdParties;
use MezzoLabs\Mezzo\Core\Booting\Bootstrappers\PrepareConfiguration;

class BootManager
{


    protected $bootstrappers = [
        PrepareConfiguration::class,
        IncludeThirdParties::class,
    ];

    /**
     * The Laravel Application
     *
     * @var Application
     */
    protected $app;


    /**
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * Run the given array of bootstrap classes.
     *
     * @param  array $bootstrappers
     * @return void
     */
    public function run(array $bootstrappers)
    {
        foreach ($bootstrappers as $bootstrapper) {
            event('bootstrapping: ' . $bootstrapper, [$this]);

            $this->app->make($bootstrapper)->bootstrap($this);

            event('bootstrapped: ' . $bootstrapper, [$this]);
        }
    }

    /**
     * Return a BootManager instance
     *
     * @return BootManager
     */
    public static function make(){
        return app()->make(BootManager::class);
    }


} 