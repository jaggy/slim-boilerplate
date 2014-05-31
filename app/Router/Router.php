<?php

namespace Router;

use Slim\Slim;

/**
 *
 * @package    Router
 * @author     Jaggy Gauran <jaggygauran@gmail.com>
 * @license    http://www.wtfpl.net/ Do What the Fuck You Want to Public License
 * @version    Release: 0.1.3
 * @link       http://github.com/jaggyspaghetti/slim-boilerplate
 * @since      Class available since Release 0.1.0
 */
class Router
{

    /**
     * Controller Namespace
     *
     */
    const CONTROLLER = '\\Controller\\';

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
     * @access protected
     * @var    \Slim\Slim
     */
    protected $slim;

    /**
     * Set the slim object
     *
     * @access protected
     * @param  \Slim\Slim $slim
     */
    public function __construct(Slim $slim)
    {
        $this->slim = $slim;
    }



    /**
     * Dispatch the URL
     *
     * @access protected
     * @param  string $method
     * @param  string $url
     * @param  array  $options
     * @return void
     */
    protected function dispatch($method, $url, $options = [])
    {
        list($name, $action) = explode('@', $options['uses']);

        $controller = self::CONTROLLER . "{$name}Controller";
        $reflection = new \ReflectionClass($controller);

        $instance = $reflection->newInstance($this->slim);

        $callback = [$instance, $action];
        call_user_func_array([$this->slim, $method], [$url, $callback]);
    }



    /**
     * Magical method for making things happen
     *
     * @access public
     * @param  string $name
     * @param  array  $arguments
     * @return mixed
     */
    public function __call($name, $arguments = [])
    {
        if (!in_array($name, $this->methods)) {
            throw new \Exception("Method '{$name}' does not exist.");
        }

        list($url, $options) = $arguments;

        return call_user_func_array([$this, 'dispatch'], [$name, $url, $options]);
    }
}