<?php

declare(strict_types=1);

namespace StudioMitte\SolrEnhancement\Tests\Unit\ContextMenu;

use Prophecy\Argument;
use StudioMitte\SolrEnhancement\ContextMenu\AccessCheck;
use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\TestingFramework\Core\BaseTestCase;

class AccessCheckTest extends BaseTestCase
{


    /**
     * @dataProvider accessCheckTableProvider
     * @test
     */
    public function accessCheckTable(string $tableList, $expected)
    {
        $extensionConfiguration = $this->prophesize(ExtensionConfiguration::class);
        $config = ['tables' => $tableList];
        $extensionConfiguration->get(Argument::cetera())->willReturn($config);
        $accessCheck = new AccessCheck($extensionConfiguration->reveal());
        self::assertEquals($expected, $accessCheck->tableIsValid('pages'));
    }

    public function accessCheckTableProvider()
    {
        return [
            'empty list' => ['', false],
            'one valid item' => ['pages', true],
            'one invalid item' => ['fo', false],
            'valid list' => ['pages,news,bla', true],
            'invalid list' => ['paxges,news,bla', false],
        ];
    }
}
