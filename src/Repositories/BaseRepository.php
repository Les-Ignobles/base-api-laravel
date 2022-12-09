<?php
/**
 * Author: Theo Champion
 * Date: 09/12/2022
 * Time: 10:57
 */


namespace Lesignobles\BaseApiLaravel\Repositories;


use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{
    protected Model $model;

    public function __construct()
    {
        $this->model = resolve($this->getModelClass());
    }

    abstract protected function getModelClass(): string;

}
