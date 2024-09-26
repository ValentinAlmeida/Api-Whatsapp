<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Log extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'logConta';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    const DELETED_AT = 'deleted_at';

    const MENSAGEM = 'mensagem';
    const CONTA_ID = 'conta_id';
    const CONTA = 'conta';

    protected $fillable = [
        self::MENSAGEM,
        self::CONTA_ID,
    ];
    protected $with = [
        self::CONTA,
    ];

    public function conta()
    {
        return $this->belongsTo(Conta::class, foreignKey: self::CONTA_ID);
    }
}
