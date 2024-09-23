<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Conta extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'conta';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    const DELETED_AT = 'deleted_at';

    const TOKEN = 'token';
    const WA_ID = 'wa_id';
    const NOME = 'nome';

    protected $fillable = [
        self::TOKEN,
        self::WA_ID,
        self::NOME,
    ];
}
