<?php
namespace blueprint;

/**
 *
 * @package    blueprint
 * @author     Jaggy Gauran <jaggygauran@gmail.com>
 * @license    http://www.wtfpl.net/ Do What the Fuck You Want to Public License
 * @version    Release: 0.1.1
 * @link       http://github.com/jaggyspaghetti/slim-boilerplate
 * @since      Class available since Release 0.2.0
 */
interface SessionAdapter
{


    /* public read($key) {{{ */
    /**
     * read
     *
     * @param  string $key
     * @access public
     * @return void
     */
    public function read($key);
    /* }}} */


    /* public write($key, $value) {{{ */
    /**
     * write
     *
     * @param  string $key
     * @param  string $value
     * @access public
     * @return void
     */
    public function write($key, $value);
    /* }}} */


    /* public delete($key) {{{ */
    /**
     * delete
     *
     * @param mixed $key
     * @access public
     * @return void
     */
    public function delete($key);
    /* }}} */
}
