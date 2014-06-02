<?php

namespace Test;

/**
 *
 * @package    Test
 * @author     Jaggy Gauran <jaggygauran@gmail.com>
 * @license    http://www.wtfpl.net/ Do What the Fuck You Want to Public License
 * @version    Release: 0.1.0
 * @link       http://github.com/jaggyspaghetti/slim-framework
 * @since      Class available since Release 0.1.5
 */
class ModelTestCase extends \PHPUnit_Framework_TestCase
{

/*
|--------------------------------------------------------------------------
| Custom Assertions without extending PHPUnit
|--------------------------------------------------------------------------
*/

    /**
     * Assert that the model has the error message given
     *
     * @access protected
     * @param  array  $array
     * @param  string $value
     * @return void
     */
    protected function assertArrayContains($array, $value){
        $this->assertTrue(in_array($value, $array));
    }
}