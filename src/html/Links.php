<?php

namespace NewUI\html;

class Links
{
    const VERSION = '23.7.6';
    const REVISION = 1;

    public static function getView($array = null, $view = null, $view_default = 'node')
    {
        $view = $view ?: $view_default;

        $variable = array(
            'node' => '节点',
            'name' => '名称',
        );
        $array = $array ?: $variable;

        $html = '';
        foreach ($array as $key => $value) {
            $val = $value;
            if ($view == $key) {
                 $val = "<b>$value</b>";
            }
            $line = "<a href=\"?view=$key\">$val</a> ";

            $html .= $line;
        }

        return $html;
    }
}
