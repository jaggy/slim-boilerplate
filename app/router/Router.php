<?php
namespace router;

use Slim\Slim;

/**
 *
 * @package    router
 * @author     Jaggy Gauran <jaggygauran@gmail.com>
 * @license    http://www.wtfpl.net/ Do What the Fuck You Want to Public License
 * @version    Release: 0.2.0
 * @link       http://github.com/jaggyspaghetti/slim-boilerplate
 * @since      Class available since Release 0.1.0
 */
class Router
{

    /**
     * Controller Namespace
     *
     */
    const CONTROLLER = '\\controller\\';

    /**
     * Allowed HTTP requests
     *
     * @access protected
     * @var    array
     */
    protected $methods = ['get', 'post', 'put', 'patch', 'delete'];

    /**
     * Slim Object
     *
     * @var    Slim\Slim
     * @access protected
     */
    protected $slim;

    /**
     * Dependency Inject Container
     *
     * @var    Pimple\Container
     * @access protected
     */
    protected $container;

    /**
     * session
     *
     * @var    blueprint\SessionAdapter
     * @access protected
     */
    protected $session;


    /* public __construct(Slim $slim) {{{ */
    /**
     * Set the slim object
     *
     * @param  Slim\Slim $slim
     * @access public
     * @return void
     */
    public function __construct(Slim $slim)
    {
        $this->slim = $slim;
    }
    /* }}} */


    /* protected dispatch($method, $url, $reference) {{{ */
    /**
     * Dispatch the URL
     *
     * @param  string $method
     * @param  string $url
     * @param  string $reference
     * @access protected
     * @return void
     */
    protected function dispatch($method, $url, $reference)
    {
        list($name, $action) = explode('@', $reference);

        $controller = self::CONTROLLER . "{$name}Controller";
        $reflection = new \ReflectionClass($controller);

        $instance = $reflection->newInstance($this->slim, $this->container, $this->session);

        $callback = [$instance, $action];
        call_user_func_array([$this->slim, $method], [$url, $callback]);
    }
    /* }}} */


    /* public setContainer(\Pimple\Container $container) {{{ */
    /**
     * Set the dependency injection container
     *
     * @param  Pimple\Container $container
     * @access public
     * @return void
     */
    public function setContainer(\Pimple\Container $container)
    {
        $this->container = $container;
    }
    /* }}} */


    /* public setSession(\blueprint\SessionAdapter $session) {{{ */
    /**
     * Set the session handler
     *
     * @param  blueprint\SessionAdapter $session
     * @access public
     * @return void
     */
    public function setSession(\blueprint\SessionAdapter $session)
    {
        $this->session = $session;
    }
    /* }}} */


    /* public __call($name, $arguments = []) {{{ */
    /**
     * Magical method for making things happen
     *
     * @param  string $name
     * @param  array  $arguments
     * @access public
     * @return void
     */
    public function __call($name, $arguments = [])
    {
        if (!in_array($name, $this->methods)) {
            throw new \Exception("Method '{$name}' does not exist.");
        }

        list($url, $reference) = $arguments;

        return call_user_func_array([$this, 'dispatch'], [$name, $url, $reference]);
    }
    /* }}} */
}
