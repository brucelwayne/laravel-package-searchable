<?php

namespace Brucelwayne\Searchable\Observers;

use Brucelwayne\Searchable\Models\BigSearchableModel;
use Brucelwayne\Searchable\Traits\HasBigSearchable;
use Illuminate\Support\Facades\Config;

class BigSearchableObserver
{

    /**
     * Indicates if Scout will dispatch the observer's events after all database transactions have committed.
     *
     * @var bool
     */
    public $afterCommit;

    /**
     * Indicates if Scout will keep soft deleted records in the search indexes.
     *
     * @var bool
     */
    protected $usingSoftDeletes;

    public function __construct()
    {
        $this->afterCommit = Config::get('scout.after_commit', false);
        $this->usingSoftDeletes = Config::get('scout.soft_delete', false);
    }

    function getBigSearchableArray($model){
        $data['big_searchable_type'] = get_class($model);
        $data['big_searchable_id'] = $model->getKey();
        $data['payload'] = $model->toBigSearchableArray();
        if ( $model::hasSoftDelete()){
            $data['__soft_deleted'] =  empty($this->deleted_at) ? 0 : 1;
        }
        return $data;
    }

    /**
     * @param HasBigSearchable $model
     */
    public function saved($model)
    {
        $big_searchable = $model->big_searchable;
        if (empty($big_searchable)){
            return BigSearchableModel::create($this->getBigSearchableArray($model));
        }
        return $model->big_searchable->save($this->getBigSearchableArray($model));
    }

    /**
     * @param HasBigSearchable $model
     */
    public function updated($model){
        return $model->big_searchable->update($this->getBigSearchableArray($model));
    }

    /**
     * @param HasBigSearchable $model
     */
    public function deleted($model)
    {
        return $model->big_searchable->delete();
    }

    /**
     * @param HasBigSearchable $model
     */
    public function forceDeleted($model)
    {
        return $model->big_searchable->forceDelete();
    }

    /**
     * @param HasBigSearchable $model
     */
    public function restored($model)
    {
        return $model->big_searchable->restore();
    }

}