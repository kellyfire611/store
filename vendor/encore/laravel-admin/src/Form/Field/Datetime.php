<?php

namespace Encore\Admin\Form\Field;

class Datetime extends Date
{
    protected $format = 'YYYY-MM-DD';

    public function render()
    {
        //$this->defaultAttribute('style', 'width: 160px');

        return parent::render();
    }
}
