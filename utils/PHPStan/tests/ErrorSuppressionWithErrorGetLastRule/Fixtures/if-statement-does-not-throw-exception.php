<?php

$fh = @fopen('file.txt', 'r');

if (!is_resource($fh)) {
    echo 'error';
}

$byte = fread($fh, 1);
