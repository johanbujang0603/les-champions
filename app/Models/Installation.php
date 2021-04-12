<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Installation extends Model
{
    use HasUuid;

    protected $fillable = [
        'uuid',
        'app_id',
        'app_version',
        'device_type',
        'locale',
        'timezone',
        'os_version',
        'device_brand',
    ];
    
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function setLocaleAttribute(String $value) : void
    {
        $this->attributes['locale'] = strtolower($value);
    }
}
