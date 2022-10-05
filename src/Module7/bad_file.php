<?php

declare(strict_types=1);

use NonExistingClass;

function isBadFunction(array $whatIsInsideWeDoNotKnow, $thisHasNoType): bool|int
{
    if ($thisHasNoType) {
        return true;
    }

    $object = new NonExistingClass();
    if (is_countable($object) ? count($object) : 0) {
        return false;
    }

    return count($whatIsInsideWeDoNotKnow);
}
