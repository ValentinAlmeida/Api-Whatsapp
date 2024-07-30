<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Webhook extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'webhooks';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    const DELETED_AT = 'deleted_at';

    const WEBHOOK = 'webhook';
    const TYPE = 'type';

    protected $fillable = [
        self::WEBHOOK,
        self::TYPE,
    ];
}
