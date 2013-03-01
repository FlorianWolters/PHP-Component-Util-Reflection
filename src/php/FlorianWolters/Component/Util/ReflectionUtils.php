<?php
namespace FlorianWolters\Component\Util;

use \ReflectionClass;
use \ReflectionMethod;

use FlorianWolters\Component\Core\StringUtils;

/**
 * The static class {@see ReflectionUtils} provides methods which simplify the
 * usage of the {@link http://php.net/book.reflection PHP reflection
 * Application Programming Interface (API)}.
 *
 * @author    Florian Wolters <wolters.fl@gmail.com>
 * @copyright 2011-2013 Florian Wolters
 * @license   http://gnu.org/licenses/lgpl.txt LGPL-3.0+
 * @link      http://github.com/FlorianWolters/PHP-Component-Util-Reflection
 * @since     Class available since Release 0.1.0
 */
class ReflectionUtils
{
    // @codeCoverageIgnoreStart

    /**
     * {@see ReflectionUtils} instances can **NOT** be constructed in standard
     * programming.
     *
     * Instead, the class should be used as:
     * /---code php
     * $reflectedClass = ReflectionUtils::reflectClassUnderTest();
     * \---
     */
    protected function __construct()
    {
    }

    // @codeCoverageIgnoreEnd

    /**
     * Creates a new instance for the specified class name without invoking the
     * constructor.
     *
     * The constructor of the class is set accessible if it is not declared with
     * `public` visibility.
     *
     * The method {@see createNewInstanceWithoutConstructor} accepts a variable
     * number of parameters which are passed to the constructor of the class.
     *
     * @param string  $className  The name of the class to reflect.
     * @param mixed[] $parameters Zero or more parameters to be passed to the
     *                            constructor.
     *
     * @return object A new instance of the class to reflect.
     *
     * @throw ReflectionException If the class with the specified class name
     *                            does not exist.
     */
    public static function createNewInstanceWithoutConstructor(
        $className,
        array $parameters = array()
    ) {
        $reflectedClass = new ReflectionClass($className);
        $newInstance = $reflectedClass->newInstanceWithoutConstructor();
        $reflectedConstructor = $reflectedClass->getConstructor();

        if (null !== $reflectedConstructor) {
            $reflectedConstructor->setAccessible(true);
            $reflectedConstructor->invokeArgs($newInstance, $parameters);
        }

        return $newInstance;
    }

    /**
     * Returns the class under test via Reflection.
     *
     * This method is meant to be used in a class which extends
     * `\PHPUnit_Framework_TestCase`.
     *
     * @param string $classSuffix The sufix of the class name, the convention
     *                            is `Test`.
     *
     * @return ReflectionClass The reflected class.
     */
    public static function reflectClassUnderTest($classSuffix = 'Test')
    {
        $className = \get_called_class();

        return new ReflectionClass(
            self::retrieveNameForClassUnderTest($className, $classSuffix)
        );
    }

    /**
     * Returns the method under test via Reflection.
     *
     * The method is set accessible if it is not declared with `public`
     * visibility.
     *
     * This method is meant to be used in a class which extends
     * `\PHPUnit_Framework_TestCase`.
     *
     * @param string $methodPrefix The prefix of the method name, the convention
     *                             is `test`.
     * @param string $classSuffix  The suffix of the class name, the convention
     *                             is `Test`.
     *
     * @return ReflectionMethod The reflected method.
     */
    public static function reflectMethodUnderTest(
        $methodPrefix = 'test',
        $classSuffix = 'Test'
    ) {
        $backtrace = \debug_backtrace(
            \DEBUG_BACKTRACE_IGNORE_ARGS,
            2
        );
        $className = $backtrace[1]['class'];
        $methodName = $backtrace[1]['function'];

        $result = new ReflectionMethod(
            self::retrieveNameForClassUnderTest($className, $classSuffix),
            self::retrieveNameForMethodUnderTest($methodName, $methodPrefix)
        );
        $result->setAccessible(true);

        return $result;
    }

    /**
     * Removes the suffix `Test` from the specified class name.
     *
     * @param string $className   The name of the class.
     * @param string $classSuffix The suffix of the class name, the convention
     *                            is `Test`.
     *
     * @return string The name of the class under test.
     */
    private static function retrieveNameForClassUnderTest(
        $className,
        $classSuffix = 'Test'
    ) {
        return StringUtils::removeEnd($className, $classSuffix);
    }

    /**
     * Removes the namespace and the prefix `test` from the specified method
     * name.
     *
     * @param string $methodName   The name of the method.
     * @param string $methodPrefix The prefix of the method name, the convention
     *                             is `test`.
     *
     * @return string The name of the method under test.
     */
    private static function retrieveNameForMethodUnderTest(
        $methodName,
        $methodPrefix = 'test'
    ) {
        return StringUtils::removeStart($methodName, $methodPrefix);
    }
}
