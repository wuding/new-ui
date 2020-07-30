<?php

namespace NewUI;

class Engine
{
    const VERSION = '20.213.108';
    public $adapter = null;
    
    public function __construct($template_dir, $name = 'wuding/new-ui')
    {
        $names = array(
            'wuding/new-ui' => 'NewUI',
            'league/plates' => 'PlatesPhp',
        );

        if (array_key_exists($name, $names)) {
            $file = $names[$name];
            $class = "NewUI\\Adpater\\$file";
            $this->adapter = new $class($template_dir);
        }
    }

    public function __call($name, $arguments)
    {
        return call_user_func_array(array($this->adapter, $name), $arguments);
    }

    public function render($script, $vars = [])
    {
        return $this->adapter->render($script, $vars);
    }
}
