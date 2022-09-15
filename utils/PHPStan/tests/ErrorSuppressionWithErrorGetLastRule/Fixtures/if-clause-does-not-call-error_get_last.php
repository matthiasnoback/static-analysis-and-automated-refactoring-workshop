<?php

$fh = @fopen('file.txt', 'r');

if (!is_resource($fh)) {
    throw new RuntimeException('error');
}

$byte = fread($fh, 1);
