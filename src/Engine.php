<?php

namespace NewUI;

class Engine
{
    const VERSION = '23.7.6';
    const REVISION = 3;

    public $adpater = null;
    
    public function __construct($template_dir = null, $name = 'wuding/new-ui')
    {
        $names = array(
            'wuding/new-ui' => 'NewUI',
            'league/plates' => 'PlatesPhp',
        );

        if (array_key_exists($name, $names)) {
            $file = $names[$name];
            $class = "NewUI\\Adpater\\$file";
            $this->adpater = new $class($template_dir);
        }
    }

    public function render($script, $vars = [])
    {
        return $this->adpater->render($script, $vars);
    }

    public function setTemplateDir($template_dir)
    {
        return $this->adpater->setTemplateDir($template_dir);
    }

    public function pagination($page, $pages)
    {
        return $this->adpater->pagination($page, $pages);
    }
}
