<?php


namespace MezzoLabs\Mezzo\Core\Booting;


use Illuminate\Contracts\Foundation\Application;
use MezzoLabs\Mezzo\Core\Booting\Bootstrappers\Bootstrapper;
use MezzoLabs\Mezzo\Core\Booting\Bootstrappers\IncludeRouting;
use MezzoLabs\Mezzo\Core\Booting\Bootstrappers\PrepareConfiguration;
use MezzoLabs\Mezzo\Core\Mezzo;

class BootManager
{

    const RegisterPhase = "registerPhase";
    const BootPhase = "bootPhase";

    /**
     * Bootstrappers split into the different phases of the MezzoServiceProvider.
     *
     * @var string[]
     */
    protected $bootstrappers = [
        "registerPhase" => [
            PrepareConfiguration::class,
            IncludeRouting::class,
        ],
        "bootPhase" => [

        ]
    ];


    /**
     * The Laravel Application
     *
     * @var Application
     */
    protected $app;

    /**
     * The mezzo instance.
     *
     * @var Application
     */
    protected $mezzo;


    /**
     * @param Mezzo $mezzo
     * @internal param Application $app
     */
    public function __construct(Mezzo $mezzo)
    {
        $this->mezzo = $mezzo;
        $this->app = $mezzo->app();
    }

    /**
     * Run the bootstrappers for the current phase
     *
     * @param string $phase
     */
    public function bootForPhase($phase = BootManager::RegisterPhase){
        $bootstrappers = $this->bootstrappers[$phase];
        $this->run($bootstrappers);
    }

    /**
     * Run the bootstrappers that are needed during the "register" phase
     */
    public function registerPhase()
    {
        $this->bootForPhase(BootManager::RegisterPhase);
    }


    /**
     * Run the bootstrappers that are needed during the "boot" phase
     */
    public function bootPhase()
    {
        $this->bootForPhase(BootManager::BootPhase);
    }

    /**
     * Run the given array of bootstrap classes.
     *
     * @param  string[] $bootstrappers
     * @return void
     */
    protected function run(array $bootstrappers)
    {
        foreach ($bootstrappers as $bootstrapper) {
            event('bootstrapping: ' . $bootstrapper, [$this->app]);

            $this->app->make($bootstrapper)->bootstrap($this->mezzo);

            event('bootstrapped: ' . $bootstrapper, [$this->app]);
        }
    }

    /**
     * Return a BootManager instance
     *
     * @return BootManager
     */
    public static function make($mezzo)
    {
        return new BootManager($mezzo);
    }


} 