<?php

namespace NewUI\html;

class Links
{
    const VERSION = '23.7.27';
    const REVISION = 2;

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


    public static function header($a, $div, $h1, $options = [])
    {

        $href = '/';
        extract($options);

        $html = <<<HEREDOC
<header>
    <blockquote>
        <a href="$href">$a</a>
    </blockquote>
    <div>$div</div>
    <h1>$h1</h1>
</header>
HEREDOC;

        return $html;

    }
}
