<?php

$fh = @fopen('file.txt', 'r');

if (empty(is_resource($fh))) {
    throw new RuntimeException(error_get_last());
}

$byte = fread($fh, 1);
