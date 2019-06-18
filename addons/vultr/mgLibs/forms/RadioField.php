<?php

namespace MGModule\vultr\mgLibs\forms;
use MGModule\vultr as main;


/**
 * Select Form Field
 *
 * @author Michal Czech <michael@modulesgarden.com>
 * @SuppressWarnings(PHPMD)
 */
class RadioField extends AbstractField{
    public $translateOptions            = true;
    public $addValueIfNotExits          = false;
    public $options;
    public $type    = 'radio';
    
    function prepare() {
        if(array_keys($this->options) == range(0, count($this->options) - 1))
        {
            $options = array();
            foreach($this->options as $value)
            {
                $options[$value] = $value;
            }
            $this->options = $options;
        }
        else
        {
            $this->translateOptions = false;
        }
        
        if($this->addValueIfNotExits)
        {
            if($this->value && !isset($this->options[$this->value]))
            {
                $this->options[$this->value] = $this->value;
            }
        }
        
        if($this->translateOptions)
        {
            $options = array();
            foreach($this->options as $value)
            {
                $options[$value] = main\mgLibs\Lang::T($this->formName,$this->name,'options',$value); 
            }
            $this->options = $options;
        }
        
        if(empty($this->value))
        {
            foreach($this->options as $value => $lbl)break;
            $this->value = $value;
        }
    }
}