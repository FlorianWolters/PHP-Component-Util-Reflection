<?php
namespace FlorianWolters\Component\Util;

use \ReflectionClass;
use \ReflectionMethod;

/**
 * Test class for {@see ReflectionUtils}.
 *
 * @author    Florian Wolters <wolters.fl@gmail.com>
 * @copyright 2011-2013 Florian Wolters
 * @license   http://gnu.org/licenses/lgpl.txt LGPL-3.0+
 * @link      http://github.com/FlorianWolters/PHP-Component-Util-Reflection
 * @since     Class available since Release 0.1.0
 *
 * @covers    FlorianWolters\Component\Util\ReflectionUtils
 */
class ReflectionUtilsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * The qualified class name of the class under test.
     *
     * @var string
     */
    private static $classNameUnderTest;

    /**
     * @return void
     */
    public static function setUpBeforeClass()
    {
        self::$classNameUnderTest = __NAMESPACE__ . '\ReflectionUtils';
    }

    /**
     * @return void
     *
     * @coversDefaultClass createNewInstanceWithoutConstructor
     * @test
     */
    public function testCreateNewInstanceWithoutConstructor()
    {
        $expected = self::$classNameUnderTest;
        $actual = ReflectionUtils::createNewInstanceWithoutConstructor(
            self::$classNameUnderTest
        );

        $this->assertInstanceOf($expected, $actual);
    }

    /**
     * @return void
     *
     * @coversDefaultClass reflectClassUnderTest
     * @test
     */
    public function testReflectClassUnderTest()
    {
        $expected = new ReflectionClass(self::$classNameUnderTest);
        $actual = ReflectionUtils::reflectClassUnderTest();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @return void
     *
     * @coversDefaultClass reflectMethodUnderTest
     * @test
     */
    public function testReflectMethodUnderTest()
    {
        $className = self::$classNameUnderTest;
        $methodName = 'reflectMethodUnderTest';

        $expected = new ReflectionMethod($className, $methodName);
        $actual = ReflectionUtils::reflectMethodUnderTest();

        $this->assertEquals($expected, $actual);
    }
}
