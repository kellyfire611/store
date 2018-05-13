<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StoreSystemConfig extends Model
{
    use SoftDeletes;

    protected $table = 'store_system_config';

    public function scopeNoneDelete()
    {
        return $this->where('deleted_at', null);
    }
}
