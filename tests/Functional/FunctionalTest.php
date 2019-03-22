<?php
/**
 * Created by PhpStorm.
 *
 * doctrine-bundle
 * (c) 2019 Craig Rayner <craig@craigrayner.com>
 *
 * User: craig
 * Date: 22/03/2019
 * Time: 16:07
 */

namespace Crayner\Doctrine\Tests\Functional;

use Doctrine\DBAL\Connection;
use Symfony\Component\HttpKernel\KernelInterface;
use PHPUnit\Framework\TestCase;

/**
 * Class FunctionalTest
 * @package Crayner\Doctrine\Tests\Functional
 */
class FunctionalTest extends TestCase
{
    /**
     * @var KernelInterface
     */
    private $kernel;

    /**
     * @var Connection
     */
    private $connection;

    /**
     * @var Doctrine
     */
    private $doctrine;

    protected function setUp(): void
    {
        $this->kernel = new AppKernel('test', true);
        $this->kernel->boot();
        $this->connection = $this->kernel->getContainer()->get('doctrine.dbal.default_connection');
        $this->doctrine = $this->kernel->getContainer()->get('doctrine');
    }
    protected function tearDown(): void
    {
        $this->kernel->shutdown();
    }
    private function assertRowCount($count)
    {
        $this->assertEquals($count, $this->connection->fetchColumn('SELECT COUNT(*) FROM test'));
    }
    private function insertRow()
    {
        $this->connection->insert('test', [
            'test' => 'foo',
        ]);
    }
    public function testTablePrefix()
    {
        var_dump($this->doctrine->getManager('default')->getClassMetaData('testTable'));
        $this->assertRowCount(0);
        $this->insertRow();
        $this->assertRowCount(1);
    }

    public function testChangeDbState()
    {
        $this->assertRowCount(0);
        $this->insertRow();
        $this->assertRowCount(1);
    }
    public function testPreviousChangesAreRolledBack()
    {
        $this->assertRowCount(0);
    }
    public function testChangeDbStateWithinTransaction()
    {
        $this->assertRowCount(0);
        $this->connection->beginTransaction();
        $this->insertRow();
        $this->assertRowCount(1);
        $this->connection->rollBack();
        $this->assertRowCount(0);
        $this->connection->beginTransaction();
        $this->insertRow();
        $this->connection->commit();
        $this->assertRowCount(1);
    }
    public function testPreviousChangesAreRolledBackAfterTransaction()
    {
        $this->assertRowCount(0);
    }
    public function testChangeDbStateWithSavePoint()
    {
        $this->assertRowCount(0);
        $this->connection->createSavepoint('foo');
        $this->insertRow();
        $this->assertRowCount(1);
        $this->connection->rollbackSavepoint('foo');
        $this->assertRowCount(0);
        $this->insertRow();
    }
    public function testPreviousChangesAreRolledBackAfterUsingSavePoint()
    {
        $this->assertRowCount(0);
    }
}
