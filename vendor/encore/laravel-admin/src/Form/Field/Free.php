<?php

namespace Encore\Admin\Form\Field;

use Encore\Admin\Form\Field;

class Free extends Field
{
    protected $code;

    public function code($string)
    {
        if (is_null($this->prepend)) {
            $this->prepend = $string;
        }

        return $this;
    }

    protected function init()
    {
        if($this->viewMode == 'default') {
            if (empty($this->view)) {
                $this->view = 'admin::form.free';
            }
        }
        else {
            if (empty($this->view)) {
                $this->view = 'admin::form.free'.$this->viewMode;
            }
        }
    }

    /**
     * Render this filed.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function render()
    {
        $this->init();

        return parent::render()->with([
            'prepend' => $this->prepend,
            'append'  => $this->append,
        ]);
    }
}
