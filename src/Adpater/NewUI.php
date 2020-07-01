<?php

namespace NewUI\Adpater;

use NewUI\Template;

class NewUI extends _Abstract
{
    public function __construct($template_dir)
    {
        $this->template = new Template($template_dir);
    }

    public function __call($name, $arguments)
    {
        return call_user_func_array(array($this->template, $name), $arguments);
    }
}
