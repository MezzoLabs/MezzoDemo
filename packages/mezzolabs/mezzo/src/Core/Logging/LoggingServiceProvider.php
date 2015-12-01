<?php


namespace MezzoLabs\Mezzo\Core\Logging;


use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Monolog\Handler\SlackHandler;
use Monolog\Handler\StreamHandler;

class LoggingServiceProvider extends ServiceProvider
{
    protected $eloquentEventTypesToLog = [
        'creating', 'created',
        'updating', 'updated',
        'deleting', 'deleted'
    ];

    /**
     * @var DispatcherContract
     */
    protected $dispatcher;

    /**
     * @var Logger
     */
    protected $logger;


    /**
     * Register any other events for mezzo
     *
     * @param  DispatcherContract $dispatcher
     * @return void
     */
    public function boot(DispatcherContract $dispatcher, Logger $logger)
    {
        $this->dispatcher = $dispatcher;
        $this->logger = $logger;


        $this->dispatcher->listen('router.matched', function () {
            $this->logger->currentRequestInfo();
        });

        $this->listenForEloquentEvents();
    }

    protected function listenForEloquentEvents()
    {

        $this->dispatcher->listen('eloquent.*', function (Model $model) {
            $eventType = $this->getEloquentEventType($this->dispatcher->firing());

            if (!$this->logsEloquentEventType($eventType))
                return true;

            $this->logger->logEloquentEvent($eventType, $model);
        });
    }

    protected function getEloquentEventType($longEventName)
    {
        $parts = explode(':', $longEventName);
        $parts = explode('.', $parts[0]);

        return $parts[1];
    }

    /**
     * @param $eventName
     * @return bool
     */
    protected function logsEloquentEventType($eventName)
    {
        return in_array($eventName, $this->eloquentEventTypesToLog);
    }

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
            $logger->pushHandler(new StreamHandler(storage_path('logs/mezzo/'. date("Y-m-d") .'_mezzo.log'), Logger::INFO));
            $logger->pushHandler(new StreamHandler(storage_path('logs/mezzo.log'), Logger::INFO));

            if(env('SLACK_TOKEN')){
                $logger->pushHandler(new SlackHandler(env('SLACK_TOKEN'), 'mezzo'));
            }

            return $logger;
        });

    }
}