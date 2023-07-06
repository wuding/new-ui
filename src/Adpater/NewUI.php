<?php

namespace NewUI\Adpater;

use NewUI\Template;

class NewUI extends _Abstract
{
    const VERSION = '23.7.6';
    const REVISION = 2;

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

    public function pagination($page, $pages)
    {
        return $this->template->pagination($page, $pages);
    }
}
