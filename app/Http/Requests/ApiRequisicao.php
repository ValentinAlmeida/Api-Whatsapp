<?php

namespace App\Http\Requests;

use App\Constantes\ValidationMessage;
use App\Core\Excecoes\ValidacaoError;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;

abstract class ApiRequisicao extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
    protected function failedValidation(Validator $validator)
    {
        throw ValidacaoError::validacaoRequisicao($validator);
    }

    public function messages()
    {
        return [
            "required" => ValidationMessage::REQUIRED,
            "min" => ValidationMessage::MIN,
            "max" => ValidationMessage::MAX,
            "between" => ValidationMessage::BETWEEN,
            "size" => ValidationMessage::SIZE,
            "string" => ValidationMessage::TYPE,
            "numeric" => ValidationMessage::TYPE,
            "boolean" => ValidationMEssage::TYPE,
            "email" => ValidationMessage::EMAIL,
            "uuid" => ValidationMessage::UUID,
            "mac_address" => ValidationMessage::MAC,
            "json" => ValidationMessage::TYPE,
            "date_format" => ValidationMessage::DATE_FORMAT,
            "filled" => ValidationMessage::FILLED,
            "digits" => ValidationMessage::SIZE,
            "array" => ValidationMessage::TYPE,
            "alpha_num" => ValidationMessage::CHARS,
            "alpha" => ValidationMessage::CHARS,
            "required_if" => ValidationMessage::REQUIRED,
            "digits_between" => ValidationMessage::BETWEEN,
            "regex" => ValidationMessage::REGEX,
            "in" => ValidationMessage::IN,
            "image" => ValidationMessage::TYPE,
            "dimensions" => ValidationMessage::DIMENSIONS,
            "base64file" => ValidationMessage::TYPE,
            "base64mimetypes" => ValidationMessage::MIMETYPE,
            "confirmed" => ValidationMessage::CONFIRMED,
            "present" => ValidationMessage::REQUIRED,
            "before_or_equal" => ValidationMessage::BEFORE,
            "before" => ValidationMessage::BEFORE,
            "after" => ValidationMessage::AFTER,
            "after_or_equal" => ValidationMessage::AFTER,
            "exists" => ValidationMessage::EXISTS,
            "gte" => ValidationMessage::MIN,
            "lte" => ValidationMessage::MAX
        ];
    }

    public function attributes()
    {
        return collect($this->rules())->keys()
            ->filter(function ($field) {
                return str($field)->contains('_');
            })->mapWithKeys(function ($field) {
                return [$field => $field];
            })->toArray();
    }

    protected function dotValidated(string $key, $default = null)
    {
        return Arr::get($this->validated(), $key, $default);
    }
}
