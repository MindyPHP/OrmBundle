<?php

declare(strict_types=1);

/*
 * Studio 107 (c) 2018 Maxim Falaleev
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mindy\Bundle\OrmBundle\Tests;

use Mindy\Bundle\OrmBundle\DependencyInjection\OrmExtension;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class ExtensionTest extends TestCase
{
    public function testServices()
    {
        $parameters = [
            'orm.file.filesystem',
            'orm.connections',
        ];
        $container = $this->getContainer();
        foreach ($parameters as $id) {
            $this->assertTrue($container->hasParameter($id));
        }
    }

    private function getContainer(array $options = [])
    {
        $containerBuilder = new ContainerBuilder();
        $containerBuilder->setParameter('kernel.root_dir', 'kernel/root');
        $containerBuilder->setParameter('kernel.environment', 'test');

        (new OrmExtension())->load($options, $containerBuilder);

        $containerBuilder->compile();

        return $containerBuilder;
    }
}
