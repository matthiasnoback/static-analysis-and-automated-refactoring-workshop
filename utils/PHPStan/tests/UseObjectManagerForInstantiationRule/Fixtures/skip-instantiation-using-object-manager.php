<?php
declare(strict_types=1);

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;

class Foo
{

}

class Bar {
    /**
     * @var ObjectManager
     * @inject
     */
    private ObjectManager $manager;

    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

    public function baz()
    {
        $foo = GeneralUtility::makeInstance(Foo::class);
        $foo = $this->manager->get(Foo::class);
    }
}

