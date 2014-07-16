<?php
namespace model;

use Valitron\Validator;

/**
 *
 * @package    Model
 * @author     Jaggy Gauran <jaggygauran@gmail.com>
 * @license    http://www.wtfpl.net/ Do What the Fuck You Want to Public License
 * @version    Release: 0.1.4
 * @link       http://github.com/jaggyspaghetti/slim-framework
 * @since      Class available since Release 0.1.0
 */
class BaseModel extends \Model
{

    /**
     * Error Object
     *
     * @var    array
     * @access public
     */
    public $errors;

    /**
     * Valitron Object
     *
     * @var    Valitron\Validator
     * @access protected
     */
    protected $validator;

    /**
     * Validation set
     *
     * @var    array
     * @access protected
     */
    protected $validation = [];

    /**
     * Association object
     *
     * @var    array
     * @access protected
     */
    protected $_associations;


/*
|--------------------------------------------------------------------------
| Validation
|--------------------------------------------------------------------------
*/
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
     * @access public
     * @return boolean
     */
    public function validate()
    {
        $data = $this->getData();
        $this->validator = new Validator($data);

        foreach ($this->validation as $field => $rules) {
            foreach ($rules as $rule => $info) {
                $this->validator->rule($rule, $field)->message($info['message']);
            }
        }

        if (!$this->validator->validate()) {
            $this->errors = $this->validator->errors();
            return false;
        }

        return true;
    }




/*
|--------------------------------------------------------------------------
| Hooks
|--------------------------------------------------------------------------
*/


    /**
     * Before save: defaults to populating the timestamps
     *
     * @access protected
     * @return boolean
     */
    protected function beforeSave()
    {
        $this->set_expr('created', 'NOW()');
        $this->set_expr('updated', 'NOW()');

        return true;
    }

    /**
     * @access protected
     * @return boolean
     */
    protected function afterSave()
    {
        return true;
    }

    /**
     * @access protected
     * @return boolean
     */
    protected function beforeValidate()
    {
        return true;
    }


    /**
     * @access protected
     * @return boolean
     */
    protected function afterValidate()
    {
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
        // before validate hook
        if (!$this->beforeValidate()) {
            return false;
        }

        $validation = $this->validate();

        // after validate hook
        if (!$this->afterValidate()) {
            return false;
        }

        // validation fails
        if (is_array($validation)) {
            return $validation;
        }

        // before save hook
        if (!$this->beforeSave()) {
            return false;
        }

        $response = parent::save();

        // after save hook
        if (!$this->afterSave()) {
            return false;
        }

        return $response;
    }


    /* public associations() {{{ */
    /**
     * Get the assocition list
     *
     * @access public
     * @return void
     */
    public function associations()
    {
        return $this->_associations;
    }
    /* }}} */


    /* protected fetchAssociation($name) {{{ */
    /**
     * Detect the association and return a dynamic callback
     *
     * @param mixed $name
     * @access protected
     * @return void
     */
    protected function fetchAssociation($name)
    {
        $check = false;

        foreach ($this->_associations as $association => $relations) {
            foreach ($relations as $function => $model) {
                if ($name === $function) {
                    $check = true;
                    break;
                }
            }
        }

        // just cancel when nothing is found
        if (!$check) return false;

        // $this->hasMany();
        // $this->belongsTo();
        return function () use ($association, $model) {
            return call_user_func_array([$this, $association], [$model]);
        };
    }
    /* }}} */



    /* public __call($name, $arguments = []) {{{ */
    /**
     *  Add a check for dynamic associations so we can test the models
     *
     * @param mixed $name
     * @param mixed $arguments
     * @access public
     * @return void
     */
    public function __call($name, $arguments = [])
    {
        $method = strtolower(preg_replace('/([a-z])([A-Z])/', '$1_$2', $name));

        if (method_exists($this, $method)) {
            return call_user_func_array(array($this, $method), $arguments);
        }

        $callback = $this->fetchAssociation($name);

        if ($callback) {
            return call_user_func($callback);
        }

        throw new \ParisMethodMissingException("Method $name() does not exist in class " . get_class($this));
    }
    /* }}} */
}
