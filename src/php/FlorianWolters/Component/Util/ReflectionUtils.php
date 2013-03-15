<?php
namespace FlorianWolters\Component\Util;

use \ReflectionClass;
use \ReflectionMethod;
use \ReflectionObject;

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
     * ReflectionUtils::invokeMethodOnObject($obj, '__toString');
     * \---
     */
    protected function __construct()
    {
    }

    // @codeCoverageIgnoreEnd

    /**
     * Creates a new instance of the class with the specified class name
     * without invoking its constructor.
     *
     * The constructor is set accessible if it is not declared with `public`
     * visibility.
     *
     * The method `createNewInstanceWithoutConstructor` accepts a variable
     * number of arguments which are passed to the constructor of the class.
     *
     * @param string  $className The name of the class to reflect.
     * @param mixed[] $arguments The optional arguments to be passed to the
     *                           constructor.
     *
     * @return object A new instance of the class to reflect.
     *
     * @throw ReflectionException If the class with the specified class name
     *                            does not exist.
     */
    public static function createNewInstanceWithoutConstructor(
        $className,
        array $arguments = []
    ) {
        $reflectedClass = new ReflectionClass($className);
        $newInstance = $reflectedClass->newInstanceWithoutConstructor();
        $reflectedConstructor = $reflectedClass->getConstructor();

        if (null !== $reflectedConstructor) {
            $reflectedConstructor->setAccessible(true);
            $reflectedConstructor->invokeArgs($newInstance, $arguments);
        }

        return $newInstance;
    }

    /**
     * Invokes the specified method on the specified object.
     *
     * The method `invokeMethod` accepts a variable number of arguments which
     * are passed to the method of the object.
     *
     * @param object  $object     The object on which to invoke the method.
     * @param strin   $methodName The name of the method to invoke.
     * @param mixed[] $arguments  The optional arguments to be passed to the
     *                            method.
     *
     * @return void
     */
    public static function invokeMethod(
        $object,
        $methodName,
        array $arguments = []
    ) {
        $reflectedObject = new ReflectionObject($object);
        $reflectedMethod = $reflectedObject->getMethod($methodName);
        $reflectedMethod->setAccessible(true);
        $reflectedMethod->invokeArgs($object, $arguments);
    }

    /**
     * Returns all {@see ReflectionMethod} objects (excluding methods inherited
     * from superclasses) for the specified class name.
     *
     * The `$filter` argument uses a logical AND to filter the methods.
     *
     * @param string    $className The name of the class to check.
     * @param integer[] $filters   Any combination of
     *                             `ReflectionMethod::IS_STATIC`,
     *                             `ReflectionMethod::IS_PUBLIC`,
     *                             `ReflectionMethod::IS_PROTECTED`,
     *                             `ReflectionMethod::IS_PRIVATE`,
     *                             `ReflectionMethod::IS_ABSTRACT`,
     *                             `ReflectionMethod::IS_FINAL`.
     *
     * @return ReflectionMethod[] The {@see ReflectionMethod} objects reflecting
     *                            each method.
     *
     * @throw ReflectionException If the class with the specified class name
     *                            does not exist.
     */
    public static function methodsForClassWithoutInheritedMethods(
        $className,
        array $filters = []
    ) {
        $result = [];

        $methods = self::methodsForClass(
            $className,
            $filters
        );

        /* @var $method ReflectionMethod */
        foreach ($methods as $method) {
            if ($method->class === $className) {
                $result[] = $method;
            }
        }

        return $result;
    }

    /**
     * Returns all {@see ReflectionMethod} objects (inclduign methods inherited
     * from superclasses) for the specified class name.
     *
     * The `$filter` argument uses a logical AND to filter the methods.
     *
     * @param string    $className The name of the class to check.
     * @param integer[] $filters   Any combination of
     *                             `ReflectionMethod::IS_STATIC`,
     *                             `ReflectionMethod::IS_PUBLIC`,
     *                             `ReflectionMethod::IS_PROTECTED`,
     *                             `ReflectionMethod::IS_PRIVATE`,
     *                             `ReflectionMethod::IS_ABSTRACT`,
     *                             `ReflectionMethod::IS_FINAL`.
     * @return ReflectionMethod[] The {@see ReflectionMethod} objects reflecting
     *                            each method.
     *
     * @throw ReflectionException If the class with the specified class name
     *                            does not exist.
     */
    public static function methodsForClass(
        $className,
        array $filters = []
    ) {
        $result = [];
        $reflectedClass = new ReflectionClass($className);

        if (true === empty($filters)) {
            $result = $reflectedClass->getMethods();
        } else {
            $result = $reflectedClass->getMethods($filters[0]);

            for ($i = 1; $i < count($filters); ++$i) {
                $result = \array_intersect(
                    $result,
                    $reflectedClass->getMethods($filters[$i])
                );
            }
        }

        return $result;
    }

    /**
     * Returns all {@see ReflectionClass} objects for the parent classes of the
     * specified class name.
     *
     * @param string $className The name of the class to check.
     *
     * @return ReflectionClass[] The {@see ReflectionClass} objects reflecting
     *                           each parent class.
     *
     * @throw ReflectionException If the class with the specified class name
     *                            does not exist.
     */
    public static function parentClassesForClass($className)
    {
        $result = [];
        $reflectedClass = new ReflectionClass($className);

        while ($parent = $reflectedClass->getParentClass()) {
            $result[] = $parent;
            $reflectedClass = $parent;
        }

        return $result;
    }

    /**
     * Returns the class under test via Reflection.
     *
     * This method is meant to be used in a class which extends
     * `PHPUnit_Framework_TestCase`.
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
     * `PHPUnit_Framework_TestCase`.
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
