<?php


namespace MezzoLabs\Mezzo\Core\Modularisation\Domain\Repositories;


use MezzoLabs\Mezzo\Core\Cache\ResourceExistsCache;

abstract class EloquentRepository
{
    /**
     * @return \Illuminate\Database\MySqlConnection
     */
    protected function mysqlConnection()
    {
        return app('db');
    }

    /**
     * @param $table
     * @return \Illuminate\Database\Query\Builder
     */
    protected function table($table)
    {
        return $this->mysqlConnection()->table($table);
    }

    /**
     * Check if a row with the given id exists on a certain table.
     *
     * @param $id
     * @param $table
     * @return mixed
     */
    public function exists($id, $table)
    {
        return ResourceExistsCache::checkExistence($table, $id, function () use ($table, $id) {
            return $this->table($table)->where('id', '=', $id)->count() == 1;
        });
    }
}