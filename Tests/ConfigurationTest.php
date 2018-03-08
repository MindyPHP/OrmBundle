<?php

declare(strict_types=1);

/*
 * Studio 107 (c) 2018 Maxim Falaleev
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mindy\Bundle\OrmBundle\Tests;

use Mindy\Bundle\OrmBundle\DependencyInjection\Configuration;
use PHPUnit\Framework\TestCase;

class ConfigurationTest extends TestCase
{
    public function testConfiguration()
    {
        $configuration = new Configuration();

        $node = $configuration->getConfigTreeBuilder()->buildTree();

        $this->assertEquals(
            [
                'default_connection' => 'default',
                'connections' => [
                    'default' => [
                        'url' => 'sqlite://:memory:',
                    ],
                ],
            ],
            $node->finalize($node->normalize([
                'default_connection' => 'default',
                'connections' => [
                    'default' => 'sqlite://:memory:',
                ],
            ]))
        );

        $this->assertEquals(
            [
                'default_connection' => 'default',
                'connections' => [
                    'default' => [
                        'dbname' => 'test',
                        'user' => 'user',
                        'password' => 'password',
                        'port' => '123',
                        'driver' => 'pdo_mysql',
                        'host' => 'localhost',
                    ],
                ],
            ],
            $node->finalize($node->normalize([
                'default_connection' => 'default',
                'connections' => [
                    'default' => [
                        'dbname' => 'test',
                        'user' => 'user',
                        'password' => 'password',
                        'port' => '123',
                        'driver' => 'pdo_mysql',
                        'host' => 'localhost',
                    ],
                ],
            ]))
        );
    }
}
