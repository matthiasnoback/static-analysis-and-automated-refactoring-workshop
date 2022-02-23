<?php

declare(strict_types=1);

use App\Module7\ExistingClass;

function isBadFunction(array $whatIsInsideWeDoNotKnow, $thisHasNoType)
{
    if ($thisHasNoType) {
        return true;
    }

    $object = new ExistingClass();
    if (count($object)) {
        return false;
    }

    return count($whatIsInsideWeDoNotKnow);
}
