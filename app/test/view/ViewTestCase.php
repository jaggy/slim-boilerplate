<?php
namespace test\view;

use RemoteWebDriver;
use DesiredCapabilities;

/**
 *
 * @package    test
 * @author     Jaggy Gauran <jaggygauran@gmail.com>
 * @license    http://www.wtfpl.net/ Do What the Fuck You Want to Public License
 * @version    Release: 0.2.0
 * @link       http://github.com/jaggyspaghetti/slim-framework
 * @since      Class available since Release 0.1.3
 */
class ViewTestCase extends \PHPUnit_Framework_TestCase
{

    /**
     * url
     *
     * @var bool
     * @access protected
     */
    protected $url = 'http://dev:1234';

    /**
     * Remotewebdriver
     *
     * @var mixed
     * @access protected
     */
    protected $driver;


    /* public capture() {{{ */
    /**
     * capture
     *
     * @access public
     * @return void
     */
    public function capture()
    {
        $now = strtotime(date('Ymd His'));
        $destination = APP_ROOT . "/screenies/{$now}";

        $this->driver->takeScreenshot($destination);
    }
    /* }}} */
/*
|--------------------------------------------------------------------------
| Set and Tear down methods
|--------------------------------------------------------------------------
*/

    /* public setUp() {{{ */
    /**
     * setUp
     *
     * @access public
     * @return void
     */
    public function setUp()
    {
        $url = "http://localhost:9515";

        $capabilities = [\WebDriverCapabilityType::BROWSER_NAME => 'chrome'];
        $this->driver = RemoteWebDriver::create($url, $capabilities);
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
        $this->driver->close();
    }
    /* }}} */
}
