<?php

namespace NewUI\Adpater;

use NewUI\Template;

class NewUI extends _Abstract
{
    const VERSION = '23.8.5';
    const REVISION = 3;

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

    public function paging($page, $pages, $args, $slice_length = 2)
    {
        return $this->template->paging($page, $pages, $args, $slice_length);
    }
}
