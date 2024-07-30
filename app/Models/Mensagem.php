<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mensagem extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'mensagem';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    const DELETED_AT = 'deleted_at';

    const TELEFONE = 'telefone';
    const MENSAGEM = 'mensagem';
    const TIPO = 'tipo';
    const CONTATO_ID = 'contato_id';
    const DATA_ENVIO = 'data_envio';

    protected $fillable = [
        self::TELEFONE,
        self::MENSAGEM,
        self::TIPO,
        self::CONTATO_ID,
        self::DATA_ENVIO,
    ];
}
