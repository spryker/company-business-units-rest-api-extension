<?php

namespace Unit\Spryker\Zed\Development\Business\CodeStyleFixer;

use Spryker\Zed\Development\Business\CodeStyleFixer\NoWhitespaceBeforeSemicolonFixer;

/**
 * @group Spryker
 * @group Zed
 * @group Development
 * @group Business
 * @group CodeStyleFixer
 */
class NoWhitespaceBeforeSemicolonFixerTest extends \PHPUnit_Framework_TestCase
{

    const FIXER_NAME = 'NoWhitespaceBeforeSemicolonFixer';

    /**
     * @var \Spryker\Zed\Development\Business\CodeStyleFixer\NoWhitespaceBeforeSemicolonFixer
     */
    protected $fixer;

    /**
     * @return void
     */
    protected function setUp()
    {
        parent::setUp();
        $this->fixer = new NoWhitespaceBeforeSemicolonFixer();
    }

    /**
     * @dataProvider provideFixCases
     *
     * @param string $expected
     * @param string $input
     *
     * @return void
     */
    public function testFix($expected, $input = null)
    {
        $fileInfo = new \SplFileInfo(__FILE__);
        $this->assertSame($expected, $this->fixer->fix($fileInfo, $input));
    }

    /**
     * @return array
     */
    public function provideFixCases()
    {
        $fixturePath = __DIR__ . '/Fixtures/' . self::FIXER_NAME . '/';

        return [
            [
                file_get_contents($fixturePath . 'Expected/TestClass1Expected.php'),
                file_get_contents($fixturePath . 'Input/TestClass1Input.php'),
            ],
        ];
    }

}