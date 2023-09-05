<?php

namespace NewUI;

class Template
{
    const VERSION = '23.9.5';
    const REVISION = 6;

    /*
    路径
    */
    public $template_dir = null;
    public $script = null;
    public $extension = '.php';
    public $script_file = null;
    /*
    参数、变量
    */
    public $render_args = array(null, array());
    public $render_vars = array();
    /*
    包含
    */
    public $include = null;
    public $result = null;
    
    public function __construct($template_dir = null)
    {
        if ($template_dir) {
            $this->setTemplateDir($template_dir);
        }
    }

    // 返回渲染结果
    public function render()
    {
        //=s
        $this->render_args = func_get_args();

        //=f
        $this->render_vars = is_array($this->render_args[1]) ? $this->render_args[1] : array('__nothing__' => $this->render_args[1]);

        //=z
        $this->script = $this->render_args[0];
        $this->script_file = $this->template_dir .'/'. $this->script . $this->extension;

        //=sh
        extract($this->render_vars, EXTR_PREFIX_INVALID, '');

        //=l
        ob_start();
        $this->include = include $this->script_file;
        $this->result = ob_get_contents();
        ob_end_clean();

        //=g
        return $this->result;
    }
    
    // 设置模板主目录
    public function setTemplateDir($template_dir = null)
    {
        $this->template_dir = $template_dir;
    }


    //
    public function pagination($page, $pages)
    {
        if (1 >= $pages) {
            // return null;
        }

        $query_string = $_SERVER['QUERY_STRING'];
        parse_str($query_string, $$FORM_DATA);

        $last = $page + 1;
        $next = ($last > $pages) ? $pages : $last;

        $FORM_DATA['page'] = $next;
        $query_str = http_build_query($FORM_DATA);

        $html = <<<HEREDOC

$page/$pages
<a href="?$query_str">下一页</a>
HEREDOC;

        return $html;
    }


    public function paging($page, $pages, $args, $slice_length = 2, $return_name = null)
    {

        $last = $page + 1;
        $next = ($last > $pages) ? $pages : $last;

        $glue = '/';
        $pieces = array_slice($args, 0, $slice_length);
        $pieces[] = $next;
        $path_way = implode($glue, $pieces);

        $html = <<<HEREDOC

$page/$pages
<a href="/$path_way">下一页</a>
HEREDOC;

        if (is_string($return_name)) {
            return $$return_name;
        }

        return $html;

    }


    public function pageBreak($page, $pages, $args, $slice_length = 2, $dictionary_name = 'XZ')
    {
        $path_way = $this->paging($page, $pages, $args, $slice_length, 'path_way');

        $page = <<<HEREDOC
<form action="/dictionary/$dictionary_name" style="display: inline-block;">
    <input type="text" name="pg" value="$page" placeholder="" style="height: 24px;width: 50px;">
    <input type="hidden" name="action" value="goto">
    <blockquote style="display: none">
        <button type="submit">Goto</button>
    </blockquote>
</form>
HEREDOC;

        $html = <<<HEREDOC

$page/$pages
<a href="/$path_way">下一页</a>
HEREDOC;


        return $html;
    }

}
