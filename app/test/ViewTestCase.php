<?php
namespace Test;

/**
 *
 * @package    Test
 * @author     Jaggy Gauran <jaggygauran@gmail.com>
 * @license    http://www.wtfpl.net/ Do What the Fuck You Want to Public License
 * @version    Release: 0.1.3
 * @link       http://github.com/jaggyspaghetti/slim-framework
 * @since      Class available since Release 0.1.3
 */
class View extends \PHPUnit_Extensions_Selenium2TestCase
{

    /**
     * Selenium host
     *
     * @access protected
     * @var    string
     */
    protected $host = 'localhost';

    /**
     * Selenium port
     *
     * @access protected
     * @var    integer
     */
    protected $port = 4444;

    /**
     * URL to open in the browser
     *
     * @access protected
     * @var    string
     */
    protected $url  = 'http://dev:1234/';


    /**
     * Capture a screenshot
     *
     * @access protected
     * @return void
     */
    protected function capture()
    {
        $now = strtotime(date('Ymd His'));
        $destination = APP_ROOT . DS . 'screenshots' . DS . "{$now}.png";

        echo "\nScreenshot: {$destination}\n";
        file_put_contents($destination, $this->currentScreenshot());
    }


    /**
     * Run on test failure
     *
     * @access protected
     * @return void
     */
    public function onNotSuccessfulTest(\Exception $e)
    {
        $this->capture();
        throw $e;
    }


/*
|--------------------------------------------------------------------------
| Set and Tear down methods
|--------------------------------------------------------------------------
*/

    /**
     * Setup selenium
     *
     * @access public
     * @return void
     */
    public function setUp()
    {
        $this->setHost($this->host);
        $this->setPort($this->port);

        $this->setBrowser('firefox');
        $this->setBrowserUrl('http://dev:1234/');
    }
}