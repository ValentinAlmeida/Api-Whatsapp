<?php

namespace App\Core\Adapter;

use App\Core\DTO\RestaurarLogDTO as RestaurarDTO;
use App\Core\Entidades\Log as Entidade;
use App\Models\Log as Model;
use Carbon\Carbon;

final class LogAdapter
{
    public static function converter(Model $model): Entidade
    {
        $restoreDTO = new RestaurarDTO(
            $model->mensagem,
            $model->conta_id,
            Carbon::create($model->created_at),
        );

        return Entidade::restore(
            $restoreDTO,
            $model->id
        );
    }
}
