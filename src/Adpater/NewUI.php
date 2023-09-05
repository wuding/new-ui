<?php

namespace NewUI\Adpater;

use NewUI\Template;

class NewUI extends _Abstract
{
    const VERSION = '23.9.5';
    const REVISION = 4;

    public function __construct($template_dir)
    {
        $this->template = new Template($template_dir);
    }

    public function __call($name, $arguments)
    {
        $return_values = call_user_func_array(array($this->template, $name), $arguments);
        return $return_values;
    }

    public function render($script, $vars = [])
    {
        return $this->template->render($script, $vars);
    }

    public function setTemplateDir($template_dir)
    {
        $this->template->setTemplateDir($template_dir);
    }

    public function pagination($page, $pages)
    {
        return $this->template->pagination($page, $pages);
    }

    public function paging($page, $pages, $args, $slice_length = 2)
    {
        return $this->template->paging($page, $pages, $args, $slice_length);
    }
}
