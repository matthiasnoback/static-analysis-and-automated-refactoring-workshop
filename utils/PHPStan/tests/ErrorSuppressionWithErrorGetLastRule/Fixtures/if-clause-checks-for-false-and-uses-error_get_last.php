<?php

$fh = @fopen('file.txt', 'r');

if (!is_resource($fh)) {
    throw new RuntimeException('error: ' . error_get_last());
}

$byte = fread($fh, 1);
