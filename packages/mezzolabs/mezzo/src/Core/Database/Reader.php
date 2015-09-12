<?php


namespace MezzoLabs\Mezzo\Core\Database;


use Illuminate\Database\Connection;
use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Schema\Grammars\Grammar;
use Illuminate\Support\Facades\Cache;
use MezzoLabs\Mezzo\Core\Cache\Singleton;
use MezzoLabs\Mezzo\Core\Database\Table;
use MezzoLabs\Mezzo\Core\Traits\IsShared;

class Reader
{
    use IsShared;

    /**
     * @var DatabaseManager
     */
    private $manager;

    /**
     * @var Connection
     */
    private $connection;

    /**
     * @var Grammar
     */
    private $grammar;

    /**
     * @var \Doctrine\DBAL\Schema\AbstractSchemaManager
     */
    private $schemaManager;


    /**
     * Create a new database reader to analyse the database schema.
     *
     * @param DatabaseManager $manager
     * @internal param Connection $connection
     */
    public function __construct(DatabaseManager $manager)
    {
        $this->manager = $manager;
        $this->connection = $manager->connection();
        $this->schemaManager = $this->connection->getDoctrineSchemaManager();


    }

    /**
     * Get the column listing for a given table.
     *
     * @param  string $table
     * @return array
     */
    public function getColumns(Table $table)
    {
        $columns = Singleton::get(
            'database.columns.' . $table->name(),
            function () use ($table) {
                return $this->schemaManager->listTableColumns($table->name());
            });

        dd($columns);

    }
} 