<?php

namespace Metrique\Building\Support;

final class InputType
{
    const HIDDEN = 0;
    const TEXT = 1;
    const NUMBER = 2;
    const EMAIL = 3;
    const IMAGE = 4;
    const FILE = 5;
    const DATE = 6;
    const DATETIME = 7;
    const TIME = 8;
    const TEXTAREA = 9;
    const CHECKBOX = 10;

    public static function type(int $enum)
    {
        $types = [
            'hidden',
            'text',
            'number',
            'email',
            'text',
            'file',
            'date-local',
            'datetime-local',
            'time-local',
            'textarea',
            'checkbox',
        ];

        return $types[$enum];
    }
}