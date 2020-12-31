<?php

namespace NewUI;

class Template
{
    public $template_dir = null;
    public $script_file = null;
    public $output_callback = 'ob_gzhandler';
    // ob_gzhandler 中途打印而不退出，显示空白
    public static $render_result = null;
    public static $output_include = null;
    public static $tpl_vars = null;
    public static $output_content = null;
    
    public function __construct($template_dir)
    {
        $this->template_dir = $template_dir;
    }

    public function render($__script__, $__vars__ = [])
    {
        $__vars__ = is_array($__vars__) ? array_merge(['__nothing__' => null], $__vars__) : ['__nothing__' => $__vars__];
        $this->script = $__script__;
        $this->script_file = $this->template_dir . '/' . $__script__ . '.php';
        extract($__vars__, EXTR_PREFIX_INVALID, '');
        unset($__script__, $__vars__);

        if ($this->output_callback && in_array(gettype($this->output_callback), ['string', 'array'])) {
            ob_start($this->output_callback);
        } else {
            ob_start();
        }

        // 是否包含
        if (false !== self::$output_include) {
            $include_result = @include $this->script_file;
        } else {
            $include_result = 1;
        }

        // 包含失败
        if (false === $include_result) {
            unset($include_result);
            $__template__ = [
                'code' => 404,
                'msg' => [
                    '' => "No such file or directory $this->script_file",
                    'file' => __FILE__,
                    'line' => __LINE__,
                    'method' => __METHOD__,
                ],
                'data' => [
                    'obj' => $this,
                ],
            ];
            $include_result = include dirname(__DIR__) . '/tpl/404.php';
        }
        // 有返回结果
        if (1 !== $include_result) {
            return $include_result;
        }
        // 直接返回缓冲
        if (!$this->output_callback) {
            $output = ob_get_clean();
            $patterns = $replacements = array();
            if (is_array(static::$tpl_vars) && preg_match_all("/{{([a-z0-9_]+)}}/", $output, $matches)) {
                $variable = $matches[1];
                foreach ($variable as $key) {
                    $replacements[] = static::$tpl_vars[$key] ?? null;
                    $patterns[] = '/{{'. $key .'}}/';
                }
                $output = preg_replace($patterns, $replacements, $output);
            }
            return $output;
        }
        $end = ob_end_flush();
        if (null !== static::$output_content) {
            return static::$output_content;
        }
        return $end;
    }
    
    public function setTemplateDir($template_dir)
    {
        $this->template_dir = $template_dir;
    }

    public function setCallback($output_callback = null, $output_include = null)
    {
        if (false !== $output_callback) {
            $this->output_callback = $output_callback;
        }
        if (null !== $output_include) {
            self::$output_include = $output_include;
        }
        return $this->output_callback;
    }

    public function setTplVars($vars)
    {
        static::$tpl_vars = $vars;
    }
}
