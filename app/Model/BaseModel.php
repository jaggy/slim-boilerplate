<?php
namespace Model;

use Model;
use Valitron\Validator;

/**
 *
 * @package    Model
 * @author     Jaggy Gauran <jaggygauran@gmail.com>
 * @license    http://www.wtfpl.net/ Do What the Fuck You Want to Public License
 * @version    Release: 0.1.1
 * @link       http://github.com/jaggyspaghetti/slim-framework
 * @since      Class available since Release 0.1.0
 */
class BaseModel extends Model
{

    /**
     * Valitron Object
     *
     * @access protected
     * @var    Valitron\Validator
     */
    protected $validator;


    /**
     * Validation set
     *
     * @access protected
     * @var    array
     */
    protected $validation = [];

    /**
     * Get the object attributes as an array for valdiation
     *
     * @access protected
     * @return array
     */
    protected function getData()
    {
        $data = [];

        $fields = array_keys($this->validation);

        foreach ($fields as $field) {
            $data[$field] = $this->{$field};
        }

        return $data;
    }

    /**
     * Validate the model
     *
     * @access protected
     * @return boolean
     */
    protected function validate()
    {
        $data = $this->getData();
        $this->validator = new Validator($data);

        foreach ($this->validation as $field => $rules) {
            foreach ($rules as $rule => $info) {
                $this->validator->rule($rule, $field)->message($info['message']);
            }
        }

        if (!$this->validator->validate()) {
            return $this->validator->errors();
        }

        return true;
    }


    /**
     * Override the save function to add validation and prefill data
     *
     * @access public
     * @return boolean
     */
    public function save()
    {
        $validation = $this->validate();

        // validation fails
        if (is_array($validation)) {
            return $validation;
        }

        $this->set_expr('created', 'NOW()');
        $this->set_expr('updated', 'NOW()');

        return parent::save();
    }

}