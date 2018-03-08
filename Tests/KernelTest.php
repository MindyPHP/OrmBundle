<?php

declare(strict_types=1);

/*
 * Studio 107 (c) 2018 Maxim Falaleev
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mindy\Bundle\OrmBundle\Tests;

use Doctrine\DBAL\Connection;
use Mindy\Orm\ConnectionManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Filesystem\Filesystem;

class KernelTest extends KernelTestCase
{
    protected function tearDown()
    {
        (new Filesystem())->remove(__DIR__.'/var');
    }

    protected static function createKernel(array $options = [])
    {
        return new Kernel('dev', true);
    }

    public function testConnectionManager()
    {
        $kernel = $this->createKernel();
        $kernel->boot();

        $container = $kernel->getContainer();

        $manager = $container->get(ConnectionManager::class);
        $this->assertInstanceOf(ConnectionManager::class, $manager);

        $this->assertNull($manager->getConnection());
        $this->assertInstanceOf(Connection::class, $manager->getConnection('sqlite'));
    }
}
