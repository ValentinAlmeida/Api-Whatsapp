<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contato extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'contatos';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    const DELETED_AT = 'deleted_at';

    const NOME = 'nome';
    const TELEFONE = 'telefone';

    protected $fillable = [
        self::NOME,
        self::TELEFONE,
    ];
}
