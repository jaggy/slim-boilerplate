<?php

namespace Controller;

use Slim\Slim;

/**
 *
 * @package    Controller
 * @author     Jaggy Gauran <jaggygauran@gmail.com>
 * @license    http://www.wtfpl.net/ Do What the Fuck You Want to Public License
 * @version    Release: 0.1.4
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
     * View to render
     *
     * @access protected
     * @var    string
     */
    protected $render;

    /**
     * Application name
     *
     * @access protected
     * @var    string
     */
    protected $name;


    /* public __construct(Slim $slim) {{{ */
    /**
     * Initialize the controller
     *
     * @param Slim $slim
     * @access public
     * @return void
     */
    public function __construct(Slim $slim)
    {
        $this->slim = $slim;

        $namespace  = explode('\\', get_called_class());
        $class      = end($namespace);
        $this->name = str_replace('Controller', '', $class);
    }
    /* }}} */


    /* public __call($name, $arguments = []) {{{ */
    /**
     * Detect and render the view
     *
     * @param mixed $name
     * @param mixed $arguments
     * @access public
     * @return void
     */
    public function __call($name, $arguments = [])
    {

        if (!method_exists($this, $name)) {
            throw new \Exception("Action `{$name}` does not exist.");
        }

        call_user_func_array([$this, $name], $arguments);

        if (!$this->render) {
            $view = strtolower($this->name) . DS . $name . '.twig';
            $this->slim->render($view);
        }
    }
    /* }}} */
}
