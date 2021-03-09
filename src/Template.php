<?php

namespace NewUI;

class Template
{
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
}
