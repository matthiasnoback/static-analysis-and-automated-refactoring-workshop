<?php

function tap($value, $callback) {
    $callback($value);
    return $value;
}
