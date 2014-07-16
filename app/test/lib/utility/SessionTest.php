<?php
namespace test\lib\utility;

use lib\utility\Session;

/**
 *
 * @package    test\lib\utility
 * @author     Jaggy Gauran <jaggygauran@gmail.com>
 * @license    http://www.wtfpl.net/ Do What the Fuck You Want to Public License
 * @version    Release: 0.1.0
 * @link       http://github.com/jaggyspaghetti/slim-boilerplate
 * @since      Class available since Release 0.2.0
 */
class SessionTest extends \PHPUnit_Framework_TestCase
{
    public $session;

    /* public setUp() {{{ */
    /**
     * Setup factory
     *
     * @access public
     * @return void
     */
    public function setUp()
    {
        $this->session = new Session;

        $_SESSION = [];
    }
    /* }}} */


    /* public tearDown() {{{ */
    /**
     * tearDown
     *
     * @access public
     * @return void
     */
    public function tearDown()
    {
        unset($_SESSION);
    }
    /* }}} */


    /* public testIsInitializable() {{{ */
    /**
     * it is initializable
     *
     * @access public
     * @return void
     */
    public function testIsInitializable()
    {
        $this->assertNotNull($this->session);
    }
    /* }}} */


    /* public testExtendsFromABlueprint() {{{ */
    /**
     * testExtendsFromABlueprint
     *
     * @access public
     * @return void
     */
    public function testExtendsFromABlueprint()
    {
        $this->assertInstanceOf('\blueprint\SessionAdapter', $this->session);
    }
    /* }}} */


    /* public testGivenAKeyAndAValueShouldWriteTheValueToTheGlobalSession() {{{ */
    /**
     * @context given a key and a value
     * @expectation write the value to the global session
     *
     * @access public
     * @return void
     */
    public function testGivenAKeyAndAValueShouldWriteTheValueToTheGlobalSession()
    {
        $someKey   = 'someKey';
        $someValue = 'someValue';

        $this->session->write($someKey, $someValue);
        $this->assertEquals('someValue', $_SESSION['someKey']);
    }
    /* }}} */


    /* public testGivenAKeyShouldReturnTheValue() {{{ */
    /**
     * @context given a key
     * @expectationa should return the value
     *
     * @access public
     * @return void
     */
    public function testGivenAKeyShouldReturnTheValue()
    {
        $_SESSION['someKey'] = 'someValue';

        $result = $this->session->read('someKey');
        $this->assertEquals('someValue', $result);
    }
    /* }}} */


    /* public testGivenANonExistingKeyShouldReturnNull() {{{ */
    /**
     * @context given a non existing key
     * @expectation return null
     *
     * @access public
     * @return void
     */
    public function testGivenANonExistingKeyShouldReturnNull()
    {
        $nonExistingKey = 'some.random.key';

        $this->assertNull($this->session->read($nonExistingKey));
    }
    /* }}} */

    /* public testGivenAnExistingSessionValueShouldBeDeletedOnceFunctionIsExecuted() {{{ */
    /**
     * @context given an existing value
     * @expectation be deleted once function is executed
     *
     * @access public
     * @return void
     */
    public function testGivenAnExistingSessionValueShouldBeDeletedOnceFunctionIsExecuted()
    {
        $this->session->write('someKey', 'someValue');
        $this->assertEquals('someValue', $this->session->read('someKey'));

        $this->session->delete('someKey');

        $result = $this->session->read('someKey');
        $this->assertNull($result);
    }
    /* }}} */
}
