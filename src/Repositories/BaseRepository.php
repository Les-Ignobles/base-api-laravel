<?php
/**
 * Author: Theo Champion
 * Date: 09/12/2022
 * Time: 10:57
 */


namespace LesIgnobles\BaseApiLaravel\Repositories;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{
    protected Model $model;

    public function __construct()
    {
        $this->model = resolve($this->getModelClass());
    }

    abstract protected function getModelClass(): string;

    public function query(): Builder
    {
        return $this->model->newQuery();
    }

    public function create(array $attributes): Model
    {
        return $this->query()->create($attributes);
    }

    public function update(int $id, array $data): int
    {
        return $this->query()->where('id', $id)->update($data);
    }

    public static function getInstance(): static
    {
        /** @var static $instance */
        $instance = resolve(static::class);
        return $instance;
    }

}
