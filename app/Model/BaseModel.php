<?php
namespace Model;

use Model;

/**
 *
 * @package    Model
 * @author     Jaggy Gauran <jaggygauran@gmail.com>
 * @license    http://www.wtfpl.net/ Do What the Fuck You Want to Public License
 * @version    Release: 0.1.0
 * @link       http://github.com/jaggyspaghetti/slim-framework
 * @since      Class available since Release 0.1.0
 */
class BaseModel extends Model
{

    /**
     * Override the save function to add validation and prefill data
     *
     * @return boolean
     */
    public function save()
    {
        $this->set_expr('created', 'NOW()');
        $this->set_expr('updated', 'NOW()');

        return parent::save();
    }

}