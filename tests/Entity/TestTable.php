<?php
/**
 * Created by PhpStorm.
 *
 * doctrine-bundle
 * (c) 2019 Craig Rayner <craig@craigrayner.com>
 *
 * User: craig
 * Date: 22/03/2019
 * Time: 16:23
 */
namespace Crayner\Doctrine\tests\Entity;

/**
 * Class TestTable
 * @package Crayner\Doctrine\tests\Entity
 */
class TestTable
{
    /**
     * @var string
     */
    private $testField;

    /**
     * @return string
     */
    public function getTestField(): string
    {
        return $this->testField;
    }

    /**
     * @param string $testField
     * @return TestTable
     */
    public function setTestField(string $testField): TestTable
    {
        $this->testField = $testField;
        return $this;
    }
}