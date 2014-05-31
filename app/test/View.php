<?php
namespace Test;

/**
 *
 * @package    Model
 * @author     Jaggy Gauran <jaggygauran@gmail.com>
 * @license    http://www.wtfpl.net/ Do What the Fuck You Want to Public License
 * @version    Release: 0.1.0
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