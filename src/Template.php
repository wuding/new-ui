<?php

namespace NewUI;

class Template
{
    public $template_dir = null;
    public $script_file = null;
    public $output_callback = 'ob_gzhandler';
    
    public function __construct($template_dir)
    {
        $this->template_dir = $template_dir;
    }

    public function render($__script__, $__vars__ = [])
    {
        $__vars__ = is_array($__vars__) ? array_merge(['__nothing__' => null], $__vars__) : ['__nothing__' => $__vars__];
        $this->script_file = $__script_file__ = $this->template_dir . '/' . $__script__ . '.php';
        extract($__vars__, EXTR_PREFIX_INVALID, '_');
        unset($__vars__);

        if (in_array(gettype($this->output_callback), ['string', 'array'])) {
            ob_start($this->output_callback);
        } else {
            ob_start();
        }
        $include_result = @include $this->script_file;
        // 包含失败
        if (false === $include_result) {
            unset($include_result);
            $include_result = ['vars' => get_defined_vars(), 'msg' => "No such file or directory $this->script_file", 'file' => __FILE__, 'line' => __LINE__];
        }
        // 有返回结果
        if (1 !== $include_result) {
            return $include_result;
        }
        // 直接返回缓冲
        if (!$this->output_callback) {
            return ob_get_clean();
        }
        ob_end_flush();
    }
    
    public function setTemplateDir($template_dir)
    {
        $this->template_dir = $template_dir;
    }

    public function setCallback($output_callback = null)
    {
        $this->output_callback = $output_callback;
    }
}
