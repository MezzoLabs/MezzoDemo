<?php


namespace MezzoLabs\Mezzo\Core\Booting;


use Illuminate\Contracts\Foundation\Application;
use MezzoLabs\Mezzo\Core\Booting\Bootstrappers\Bootstrapper;
use MezzoLabs\Mezzo\Core\Booting\Bootstrappers\CreateImportantBindings;
use MezzoLabs\Mezzo\Core\Booting\Bootstrappers\MakeModuleProvidersReady;
use MezzoLabs\Mezzo\Core\Booting\Bootstrappers\IncludeMezzoRouting;
use MezzoLabs\Mezzo\Core\Booting\Bootstrappers\IncludeThirdParties;
use MezzoLabs\Mezzo\Core\Booting\Bootstrappers\LoadConfiguration;
use MezzoLabs\Mezzo\Core\Booting\Bootstrappers\RegisterConfiguredModuleProviders;
use MezzoLabs\Mezzo\Core\Booting\Bootstrappers\RunModelReflection;
use MezzoLabs\Mezzo\Core\Booting\Bootstrappers\RunThirdPartyWrappers;
use MezzoLabs\Mezzo\Core\Booting\Bootstrappers\RegisterMezzoProviders;
use MezzoLabs\Mezzo\Core\Mezzo;

class BootManager
{

    const RegisterPhase = "registerPhase";
    const BootPhase = "bootPhase";
    const BootedPhase = "bootedPhase";

    /**
     * If true this will output the boot order
     *
     * @var bool
     */
    protected $debug = false;

    /**
     * Bootstrappers split into the different phases of the MezzoServiceProvider.
     *
     * @var string[]
     */
    protected $bootstrappers = [
        "registerPhase" => [
            CreateImportantBindings::class,
            LoadConfiguration::class,
            RegisterMezzoProviders::class,
            RegisterConfiguredModuleProviders::class,
            IncludeThirdParties::class
        ],
        "bootPhase" => [
        ],
        "bootedPhase" => [
            RunThirdPartyWrappers::class,
            RunModelReflection::class,
            MakeModuleProvidersReady::class,
            IncludeMezzoRouting::class
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
    public function runRegisterPhase()
    {
        $this->bootForPhase(BootManager::RegisterPhase);
    }


    /**
     * Run the bootstrappers that are needed during the "boot" phase
     */
    public function runBootPhase()
    {
        $this->bootForPhase(BootManager::BootPhase);
    }

    /**
     * Run the bootstrappers that are needed last.
     */
    public function bootedPhase()
    {
        $this->bootForPhase(BootManager::BootedPhase);
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

            if($this->debug) echo 'bootstrapping: ' . $bootstrapper . '<br/>';

            $this->app->make($bootstrapper)->bootstrap($this->mezzo);

            if($this->debug) echo 'bootstrapped<br/>';

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