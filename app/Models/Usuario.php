<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Usuario extends Model implements Authenticatable
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'usuarios';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    const DELETED_AT = 'deleted_at';

    const NOME = 'nome';
    const ID = 'id';
    const EMAIL = 'email';
    const SENHA = 'senha';


    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    public function getAuthIdentifier()
    {
        return $this->getAttribute($this->getAuthIdentifierName());
    }

    public function getAuthIdentifierName()
    {
        return self::EMAIL;
    }

    public function getAuthPassword()
    {
        return $this->getAttribute(self::SENHA);
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function getJWTIdentifier()
    {
        return $this->getAuthIdentifier();
    }

    public function getRememberToken()
    {
        return '';
    }

    public function getRememberTokenName()
    {
        return '';
    }

    public function setRememberToken($value)
    {
        //
    }
    public function getAuthPasswordName()
    {

    }
}
