<?php

namespace Core;

class Template
{

    protected $tplName = false;
    protected $tpl = '';
    public $result = '';
    public $find = [];
    public $replace = [];

    public function __construct($template)
    {
        $this->tplName = $template;
    }

    public final function assign($name, $value)
    {
        $this->find[] = $name;
        $this->replace[] = $value;
    }

    public function before_render()
    {

    }

    public final function render()
    {
        $this->before_render();

        $this->tpl = file_get_contents($this->tplName);

        if (count($this->find) != 0) {

            $find = array_map(
                function ($var_name) {
                    return '{' . $var_name . '}';
                },
                $this->find
            );
            $this->result = str_replace($find, $this->replace, $this->tpl);

        } else {

            $this->result = &$this->tpl;

        }

        return $this->result;
    }

}