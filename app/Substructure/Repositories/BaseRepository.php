<?php


namespace App\Substructure\Repositories;

use Freelabois\LaravelQuickstart\Extendables\Repository;

class BaseRepository extends Repository
{
    public function setModel($model)
    {
        $this->model = $model;
        return $this;
    }

    public function dd(array $filters = [], array $with = [], $pagination = false)
    {
        $this->applyFilters($filters);
        $query = $this->newQuery();
        $query->with($with);
        if ($pagination === "false" || $pagination === false) {
            $pagination = 9223372036854775807;
        }
        if (!empty($this->filters)) {
            $this->applyCustomFilters();
            dump($this->filters);
            $this->injectFiltersOnQuery();
        }
        $this->group();
        $this->order();
        $query->dd();
    }

    public function get(array $filters = [], array $with = [])
    {
        $this->applyFilters($filters);
        $query = $this->newQuery();
        $query->with($with);
        if (!empty($this->filters)) {
            $this->applyCustomFilters();
            $this->injectFiltersOnQuery();
        }
        $this->group();
        $this->order();
        $this->returnable = $query->get();
        return $this->present(true);
    }

    public function list(array $filters = [], array $with = [], $pagination = 45)
    {
        return parent::list($filters, $with, $filters['perPage'] ?? $pagination ?? false);
    }

    public function delete($filters = []){
        $this->applyFilters($filters);
        $query = $this->newQuery();
        if (!empty($this->filters)) {
            $this->applyCustomFilters();
            $this->injectFiltersOnQuery();
        }
        $this->returnable = $query->delete();
        return $this->returnable;
    }

}