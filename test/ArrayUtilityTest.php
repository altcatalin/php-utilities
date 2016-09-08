<?php

namespace PhpUtilities\Test;

use PhpUtilities\ArrayUtility;

class ArrayUtilityTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @param $required
     * @param $provided
     * @dataProvider providerTestIsMinimumProvidedReturnFalseWhenMinimumNotProvided
     */
    public function testIsMinimumProvidedReturnFalseWhenMinimumNotProvided($required, $provided)
    {
        $result = ArrayUtility::isMinimumProvided($required, $provided);
        $this->assertFalse($result);
    }

    /**
     * @param $required
     * @param $provided
     * @dataProvider providerTestIsMinimumProvidedThrowErrorExceptionWhenParameterNotArray
     * @expectedException \ErrorException
     */
    public function testIsMinimumProvidedThrowErrorExceptionWhenParameterNotArray($required, $provided)
    {
        ArrayUtility::isMinimumProvided($required, $provided);
    }
    
    public function testIsMinimumProvidedReturnTrueWhenMinimumProvided()
    {
        $required = array(
            'Foo' => array(
                'Bar' => 'Something'
            )
        );

        $result = ArrayUtility::isMinimumProvided($required, $required);
        $this->assertTrue($result);
    }

    /**
     * @return array
     */
    public function providerTestIsMinimumProvidedReturnFalseWhenMinimumNotProvided()
    {
        $required = array(
            'Foo' => array(
                'Bar' => ''
            )
        );

        return array(
            array(
                $required,
                array(
                    'Foo' => ''
                )
            ),
            array(
                $required,
                array(
                    'Foo' => array()
                )
            ),
            array(
                $required,
                array(
                    'Foo' => array(
                        'FooBar' => ''
                    )
                )
            ),
            array(
                $required,
                array()
            ),
            array(
                $required,
                array(
                    'Bar' => array()
                )
            )
        );
    }

    /**
     * @return array
     */
    public function providerTestIsMinimumProvidedThrowErrorExceptionWhenParameterNotArray()
    {
        return array(
            array(
                array(),
                null
            ),
            array(
                0,
                ''
            ),
            array(
                array(),
                false
            ),
        );
    }
}
