<?php
namespace core;

/**
 *
 * @package    core
 * @author     Jaggy Gauran <jaggygauran@gmail.com>
 * @license    http://www.wtfpl.net/ Do What the Fuck You Want to Public License
 * @version    Release: 0.1.0
 * @link       http://github.com/jaggyspaghetti/slim-boilerplate
 * @since      Class available since Release 0.2.0
 */
class Dependency
{

    /**
     * Pimple container
     *
     * @var    Pimple\Container
     * @access protected
     */
    protected $container;


    /* public __construct(\Pimple\Container $container) {{{ */
    /**
     * Inject
     *
     * @param  Pimple\Container $container
     * @access public
     * @return void
     */
    public function __construct(\Pimple\Container $container)
    {
        $this->container = $container;
    }
    /* }}} */


/*
|--------------------------------------------------------------------------
| Dependencies
| - Here is where you'll list all the dependencies you need to inject
| e.g.
|
| protected function user()
| {
|     return new User;
| }
|--------------------------------------------------------------------------
*/


/*
|--------------------------------------------------------------------------
| Accessible Functions
|--------------------------------------------------------------------------
*/
    /* public inject($function) {{{ */
    /**
     * Load a given function dependency
     *
     * @param  string $function
     * @access public
     * @return Closure
     */
    public function inject($function)
    {
        $self = $this;
        $callback = function () use ($self, $function) {
            return call_user_func_array([$self, $function], []);
        };

        return $callback;
    }
    /* }}} */


    /* public __call($name, $arguments = []) {{{ */
    /**
     * Dynamically call a protected function
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
        return call_user_func_array([$this, $name], $arguments);
    }
    /* }}} */
}
