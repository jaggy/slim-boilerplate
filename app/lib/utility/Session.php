<?php
namespace lib\utility;

/**
 *
 * @package    lib\utility
 * @author     Jaggy Gauran <jaggygauran@gmail.com>
 * @license    http://www.wtfpl.net/ Do What the Fuck You Want to Public License
 * @version    Release: 0.1.0
 * @link       http://github.com/jaggyspaghetti/slim-boilerplate
 * @since      Class available since Release 0.2.0
 */
class Session implements blueprint\SessionAdapter
{


    /* public read($key) {{{ */
    /**
     * read
     *
     * @param  string $key
     * @access public
     * @return mixed
     */
    public function read($key)
    {
        if (!isset($_SESSION[$key])) {
            return null;
        }
        return $_SESSION[$key];
    }
    /* }}} */


    /* public write($key, $value) {{{ */
    /**
     * write
     *
     * @param  string $key
     * @param  mixed  $value
     * @access public
     * @return void
     */
    public function write($key, $value)
    {
        $_SESSION[$key] = $value;
    }
    /* }}} */

    /* public delete($key) {{{ */
    /**
     * Delete a session key
     *
     * @param mixed $key
     * @access public
     * @return void
     */
    public function delete($key)
    {
        unset($_SESSION[$key]);
    }
    /* }}} */
}
