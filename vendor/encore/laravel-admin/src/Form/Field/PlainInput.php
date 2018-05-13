<?php

namespace Encore\Admin\Form\Field;

trait PlainInput
{
    protected $prepend;

    protected $append;

    public function prepend($string)
    {
        if (is_null($this->prepend)) {
            $this->prepend = $string;
        }

        return $this;
    }

    public function append($string)
    {
        if (is_null($this->append)) {
            $this->append = $string;
        }

        return $this;
    }

    protected function initPlainInput()
    {
        if($this->viewMode == 'default') {
            if (empty($this->view)) {
                $this->view = 'admin::form.input';
            }
        }
        else {
            if (empty($this->view)) {
                $this->view = 'admin::form.input'.$this->viewMode;
            }
        }
    }

    protected function defaultAttribute($attribute, $value)
    {
        if (!array_key_exists($attribute, $this->attributes)) {
            $this->attribute($attribute, $value);
        }

        return $this;
    }
}
