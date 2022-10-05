<?php

declare(strict_types=1);

use NonExistingClass;

/**
 * @return bool|int
 */
function isBadFunction(array $whatIsInsideWeDoNotKnow, $thisHasNoType)
{
    if ($thisHasNoType) {
        return true;
    }

    $object = new NonExistingClass();
    if (count($object)) {
        return false;
    }

    return count($whatIsInsideWeDoNotKnow);
}
