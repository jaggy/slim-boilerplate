<?php

namespace Controller;

use Slim\Slim;

/**
 *
 * @package    Controller
 * @author     Jaggy Gauran <jaggygauran@gmail.com>
 * @license    http://www.wtfpl.net/ Do What the Fuck You Want to Public License
 * @version    Release: 0.1.0
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

    /**
     * Initialize the controller
     *
     * @access public
     * @param  Slim\Slim $slim
     */
    public function __construct(Slim $slim)
    {
        $this->slim = $slim;

        $this->name = str_replace('Controller', '', get_called_class());
    }

    public function __call($name, $arguments = [])
    {
        call_user_func_array([$this, $name], $arguments);

        if (!$this->render) {
            $view = strtolower($this->name) . DS . $name . '.twig';
            $this->slim->render($view);
        }
    }
}