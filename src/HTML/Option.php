<?php
namespace NewUI\HTML;

class Option
{
    public $data = [];
    public $selected = null;
    public $nameKeys = ['name', 0];
    public $valueKeys = ['value', 1];

    public function __construct($data = [], $selected = null, $name = null, $value = null)
    {
        $this->init($data, $selected, $name, $value);
    }

    public function init($data = [], $selected = null, $name = null, $value = null)
    {
        $this->data = $data;
        $this->selected = $selected;
        if ($name) {
            $this->nameKeys = $name;
        }
        if ($value) {
            $this->valueKeys = $value;
        }
    }

    public function html()
    {
        $data = $this->data;
        $pieces = [];
        foreach ($data as $key => $value) {
            $pieces[] = $this->tag($value, $key);
        }
        $opt = implode(PHP_EOL, $pieces);
        return $opt;
    }

    public function tag($row, $key = null)
    {
        if (is_object($row)) {
            $row = (array) $row;
        }
        $name = $value = null;

        if (is_array($row)) {
            foreach ($this->nameKeys as $keyname) {
                if (isset($row[$keyname])) {
                    $name = $row[$keyname];
                    break;
                }
            }

            foreach ($this->valueKeys as $keyname) {
                if (isset($row[$keyname])) {
                    $value = $row[$keyname];
                    break;
                }
            }
        } else {
            $name = $row;
        }

        $val = $sel = '';
        if ($value !== null) {
            $vsc = htmlspecialchars($value);
            $val = " value=\"$vsc\"";
        } else {
            $value = $name;
        }
        if ($this->selected !== null) {
            $sel = $this->selected == $value ? ' selected' : '';
        }
        return $opt = "<option$val$sel>$name</option>";
    }
}
