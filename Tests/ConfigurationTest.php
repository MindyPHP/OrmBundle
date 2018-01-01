<?php

declare(strict_types=1);

/*
 * This file is part of Mindy Framework.
 * (c) 2017 Maxim Falaleev
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
                        'url' => 'sqlite://:memory:'
                    ]
                ],
            ],
            $node->finalize($node->normalize([
                'default_connection' => 'default',
                'connections' => [
                    'default' => 'sqlite://:memory:'
                ],
            ]))
        );
    }
}
