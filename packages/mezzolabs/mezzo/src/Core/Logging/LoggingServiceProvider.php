<?php


namespace MezzoLabs\Mezzo\Core\Logging;


use Illuminate\Support\ServiceProvider;
use Monolog\Handler\StreamHandler;

class LoggingServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->bindLogger();
    }

    protected function bindLogger()
    {
        $this->app->singleton(Logger::class, function () {
            $logger = new Logger('Mezzo Logger');
            $logger->pushHandler(new StreamHandler(storage_path('logs/mezzo.log'), Logger::INFO));
            return $logger;
        });
    }
}