<?php

namespace App\Constantes;

abstract class ValidationMessage
{
    private const ATTR = ':attribute';

    const REQUIRED = self::ATTR . '.isRequired';
    const MIN = self::ATTR . '.belowMin';
    const MAX = self::ATTR . '.aboveMax';
    const BETWEEN = self::ATTR . '.outOfRange';
    const TYPE = self::ATTR . '.invalidType';
    const FILLED = self::ATTR . '.isEmpty';
    const CHARS = self::ATTR . '.invalidChars';
    const DATE_FORMAT = self::ATTR . '.invalidDateFormat';
    const SIZE = self::ATTR . '.invalidSize';
    const UUID = self::ATTR . '.invalidUuid';
    const EMAIL = self::ATTR . '.invalidEmail';
    const MAC = self::ATTR . '.invalidMAC';
    const IN = self::ATTR . '.notIn';
    const REGEX = self::ATTR . '.doesntMatchPattern';
    const DIMENSIONS = self::ATTR . '.invalidDimensions';
    const EXISTS = self::ATTR . '.notExists';
    const MIMETYPE = self::ATTR . '.invalidMimeType';
    const CONFIRMED = self::ATTR . '.notConfirmed';
    const BEFORE = self::ATTR . '.afterLimit';
    const AFTER = self::ATTR . '.beforeLimit';
}
