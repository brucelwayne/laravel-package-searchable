<?php

namespace Brucelwayne\Searchable\Models;

use Illuminate\Database\Eloquent\Relations\MorphTo;
use Laravel\Scout\Searchable;
use Mallria\Core\Models\BaseMysqlModel;
use MongoDB\Laravel\Eloquent\SoftDeletes;
use Veelasky\LaravelHashId\Eloquent\HashableId;

/**
 * @property string big_searchable_type
 * @property integer big_searchable_id
 * @property array payload
 *
 */
class BigSearchableModel extends BaseMysqlModel
{
    use HashableId;
    use Searchable;
    use SoftDeletes;

    protected $table = 'big_searchable';

    protected $hashKey = BigSearchableModel::class;

    function getRouteKeyName()
    {
        return 'hash';
    }

    protected $appends = [
        'hash',
    ];

    protected $fillable = [
        'big_searchable_type',
        'big_searchable_id',
        'payload',
    ];

    protected $casts = [
    ];

    protected $hidden = [
        'big_searchable_type',
        'big_searchable_id',
    ];

    function big_searchable():MorphTo{
        return $this->morphTo();
    }

    public function toSearchableArray()
    {
        return array(
            'id' => strval($this->getKey()),
            'big_searchable_type' => $this->big_searchable_type,
            'big_searchable_id' => $this->big_searchable_id,
            'payload' => $this->payload,
            '__soft_deleted' => empty($this->deleted_at) ? 0 : 1,
        );
    }
}