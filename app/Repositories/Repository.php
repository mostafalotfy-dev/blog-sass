<?php

namespace App\Repositories;

use DB;
use Illuminate\Database\Query\Builder;

abstract class Repository
{
    abstract public function tableName(): string;

    protected function table(): Builder
    {
        return DB::table($this->tableName());
    }

    public function __call($name, $args)
    {
        return $this->table()->$name(...$args);
    }

    public function exists($keyName, $key, $operator = 'LIKE'): bool
    {
        return $this->where($keyName, $operator, "%$key%")->count() > 0;
    }

    public function transaction(\Closure $cb)
    {
        DB::beginTransaction();
        $result = $cb($this->table());

        $this->commitIf($result);
        $this->rollbackIf($result);
    }

    public function commitIf($a): void
    {
        if ($a === true) {
            DB::commit();
        }
    }

    public function rollbackIf($a): void
    {
        if ($a === false) {
            \DB::rollBack();
        }
    }

    public function find($id): Builder
    {
        return $this->where('id', $id);
    }

    public function create($input): bool
    {
        $input = array_merge($input, [
            'created_at' => now(),
        ]);

        return $this->insert($input);
    }

    public function updateFields($input, $id): bool
    {
        $input = array_merge($input, [
            'updated_at' => now(),
        ]);

        return $this->find($id)->update($input);
    }

    public function search($keyword = null): Builder|self
    {
        $result = $this;
        if (is_null($keyword)) {
            return $result;
        }
        foreach ($this->searchableFields as $searchableField) {

            $result = $result->orWhere($this->tableName().'.'.$searchableField, 'LIKE', "%{$keyword}%");
        }

        return $result;
    }
}
