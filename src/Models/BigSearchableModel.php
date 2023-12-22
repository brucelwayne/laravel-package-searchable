<?php

namespace Brucelwayne\Searchable\Models;

use Illuminate\Database\Eloquent\Relations\MorphTo;
use Laravel\Scout\Searchable;
use Mallria\Core\Models\BaseMysqlModel;
use Veelasky\LaravelHashId\Eloquent\HashableId;

class BigSearchableModel extends BaseMysqlModel
{
    use HashableId;
    use Searchable;

    protected $table = 'big_searchable';

    protected $hashKey = BigSearchableModel::class;

    function getRouteKeyName()
    {
        return 'hash';
    }

    protected $appends = [
        'hash',
    ];

    function searchable():MorphTo{
        return $this->morphTo();
    }
}