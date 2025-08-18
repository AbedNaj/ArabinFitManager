<?php

namespace App\Livewire\Admin\Common;

use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;


class Table extends Component
{

    use WithPagination;

    public string $model;
    public array $columns = [];
    public array $with = [];
    protected array $filters = [];

    public array $relationFilters = [];
    public string $search = '', $searchField = 'name', $searchFieldWith;

    public string $orderBy = 'created_at';
    public string $title = 'Table';
    public string $detailsRouteName;

    public string $listener;
    public bool $allowSearch = true;




    protected function getListeners()
    {
        return [$this->listener => 'setFilters'];
    }

    public function setFilters(?array $data): void
    {


        $this->filters = $data;

        $this->resetPage();
    }
    public function getRowsProperty()
    {

        $query = ($this->model)::query();

        if ($this->with) {
            $query->with($this->with);
        }



        foreach ($this->filters as $field => $value) {
            if (filled($value)) {
                $query->where($field, '=', $value);
            }
        }

        foreach ($this->relationFilters as $relation => $withFilter) {
            if (!empty($withFilter['value'])) {
                $query->whereHas($relation, function (Builder $query) use ($withFilter) {
                    $query->where($withFilter['field'], $withFilter['operator'], $withFilter['value']);
                });
            }
        }

        $query->orderByDesc($this->orderBy);

        if ($this->search) {
            if (!isset($this->searchFieldWith)) {
                $query->where($this->searchField, 'like', '%' . $this->search . '%');
            } else {

                $query->whereHas($this->searchFieldWith, function ($query) {
                    $query->where($this->searchField, 'like', '%' . $this->search . '%');
                });
            }
        }

        return $query->paginate(7);
    }

    public function mount() {}
    public function render()
    {
        return view('livewire.admin.common.table', [
            'rows' => $this->rows,
            'columns' => $this->columns,
            'title' => $this->title,
        ]);
    }
}
