<?php

namespace App\Core\Adapter;

use App\Core\DTO\RestaurarContaDTO as RestaurarDTO;
use App\Core\Entidades\Conta as Entidade;
use App\Models\Conta as Model;

final class ContaAdapter
{
    public static function converter(Model $model): Entidade
    {
        $restoreDTO = new RestaurarDTO(
            $model->nome,
            $model->token,
            $model->wa_id,
        );

        return Entidade::restore(
            $restoreDTO,
            $model->id
        );
    }
}
