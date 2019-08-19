<?php

namespace NewUI\Adpater;

use NewUI\Template;

class NewUI extends _Abstract
{
    public function __construct($template_dir)
    {
        $this->template = new Template($template_dir);
    }

    public function render($script, $vars = [])
    {
        return $this->template->render($script, $vars);
    }

    public function setTemplateDir($template_dir)
    {
        $this->template->setTemplateDir($template_dir);
    }
}
