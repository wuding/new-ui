<?php

namespace NewUI\Adpater;

use League\Plates\Engine;

class PlatesPhp extends _Abstract
{
    public function __construct($template_dir)
    {
        $this->template = new Engine($template_dir);
    }

    public function render($script, $vars = [])
    {
        return $this->template->render($script, $vars);
    }
}
