<?php

namespace NewUI;

class Template
{
    public $template_dir = null;
    
    public function __construct($template_dir)
    {
        $this->template_dir = $template_dir;
    }

    public function render($__script__, $__vars__ = [])
    {
        $__vars__ = is_array($__vars__) ? $__vars__ : ['__nothing__' => $__vars__];
        $__script_file__ = $this->template_dir . '/' . $__script__ . '.php';
        extract($__vars__);
        unset($__script__, $__vars__);

        ob_start();
        $__include_result__ = include $__script_file__;
        $__out_content__ = ob_get_contents();
        ob_end_clean();

        return $__out_content__;
    }
    
    public function setTemplateDir($template_dir)
    {
        $this->template_dir = $template_dir;
    }
}
