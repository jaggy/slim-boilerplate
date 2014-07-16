<?php
namespace controller;

/**
 *
 * @package    controller
 * @author     Jaggy Gauran <jaggygauran@gmail.com>
 * @license    http://www.wtfpl.net/ Do What the Fuck You Want to Public License
 * @version    Release: 0.2.0
 * @link       http://github.com/jaggyspaghetti/slim-boilerplate
 * @since      Class available since Release 0.1.0
 */
class Controller
{
    /**
     * Slim Object
     *
     * @access protected
     * @var    Slim\Slim
     */
    protected $slim;

    /**
     * Dependency Injection container
     *
     * @var    Pimple\Container
     * @access protected
     */
    protected $container;

    /**
     * Session
     *
     * @var    blueprint\SessionAdapter
     * @access protected
     */
    protected $session;

    /**
     * View to render
     *
     * @var    string
     * @access protected
     */
    protected $render;

    /**
     * Application name
     *
     * @var    string
     * @access protected
     */
    protected $name;

    /**
     * view variables
     *
     * @var    array
     * @access protected
     */
    protected $variables = [];


    /* public __construct(\Slim\Slim $slim, \Pimple\Container $container, \blueprint\SessionAdapter $session) {{{ */
    /**
     * __construct
     *
     * @param  Slim\Slim                 $slim
     * @param  Pimple\Container          $container
     * @param  \blueprint\SessionAdapter $slim
     * @access public
     * @return void
     */
    public function __construct(\Slim\Slim $slim, \Pimple\Container $container, \blueprint\SessionAdapter $session)
    {
        $this->slim      = $slim;
        $this->container = $container;
        $this->session   = $session;

        $namespace  = explode('\\', get_called_class());
        $class      = end($namespace);
        $this->name = str_replace('Controller', '', $class);
    }
    /* }}} */


    /* public set(array $array) {{{ */
    /**
     * set
     *
     * @param mixed $array
     * @access public
     * @return void
     */
    public function set(array $array)
    {
        $this->variables = $array;
    }
    /* }}} */


    /* public __call($name, array $arguments = []) {{{ */
    /**
     * __call
     *
     * @param  string $name
     * @param  array  $arguments
     * @access public
     * @return void
     */
    public function __call($name, array $arguments = [])
    {

        if (!method_exists($this, $name)) {
            throw new \Exception("Action `{$name}` does not exist.");
        }

        call_user_func_array([$this, $name], $arguments);

        if (!$this->render) {
            $view = strtolower($this->name) . DS . $name . '.twig';
            $this->slim->render($view, $this->variables);

            $this->variables = [];
        }
    }
    /* }}} */
}
