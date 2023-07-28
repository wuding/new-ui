<?php

namespace NewUI\html;

class Links
{
    const VERSION = '23.7.28';
    const REVISION = 3;

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


    public static function list($variable, $href_prefix = '')
    {

        $html = '';
        foreach ($variable as $key => $value) {
            $line = "<a href=\"$href_prefix$key\">$value</a> ". PHP_EOL;

            $html .= $line;
        }



        return $html;

    }
}
