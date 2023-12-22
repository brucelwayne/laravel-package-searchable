<?php

namespace Brucelwayne\Searchable\Traits;

use Brucelwayne\Searchable\Observers\BigSearchableObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property Model big_searchable
 *
 * @method MorphOne big_searchable()
 */
trait HasBigSearchable
{
    public static function bootHasBigSearchable()
    {
        static::observe(new BigSearchableObserver);
    }

    function toBigSearchableArray(){
//        $keywords = method_exists($this,'toSearchableArray') ? $this->toSearchableArray() : $this->toArray();
//        $data = [
//            'big_searchable_type' => get_class($this),
//            'big_searchable_id' => $this->getKey(),
//            'payload' => implode(' ',$keywords),
//        ];
//        if ( static::hasSoftDelete()){
//            $data['__soft_deleted'] =  empty($this->deleted_at) ? 0 : 1;
//        }
//        return $data;
        return $this->toArray();
    }

    protected static function hasSoftDelete()
    {
        return in_array(SoftDeletes::class, class_uses_recursive(get_called_class()));
    }
}