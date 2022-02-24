<?php
declare(strict_types=1);

use TYPO3\CMS\Extbase\Object\ObjectManager;

class Foo
{

}

$manager = new ObjectManager();
$manager->get(Foo::class);
