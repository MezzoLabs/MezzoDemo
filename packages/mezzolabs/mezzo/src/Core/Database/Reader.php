<?php


namespace MezzoLabs\Mezzo\Core\Database;


use Illuminate\Database\Connection;
use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Schema\Grammars\Grammar;
use MezzoLabs\Mezzo\Core\Database\Table;

class Reader {
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
       // $this->schemaManager = $this->connection->getDoctrineSchemaManager();
    }

    /**
     * Get the column listing for a given table.
     *
     * @param  string  $table
     * @return array
     */
    public function getColumns(Table $table)
    {
        //$columns = $this->schemaManager->listTableColumns($table->name());
        dd($columns);
    }
} 