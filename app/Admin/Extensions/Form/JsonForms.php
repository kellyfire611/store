<?php

namespace App\Admin\Extensions\Form;

use Encore\Admin\Form\Field;

class JsonForms extends Field
{
    protected $view = 'admin.extensions.jsonforms';

    protected static $css = [
        '/vendor/json-forms/css/brutusin-json-forms.min.css',
    ];

    protected static $js = [
        '/vendor/json-forms/js/brutusin-json-forms.min.js',
        '/vendor/json-forms/js/brutusin-json-forms-bootstrap.min.js',
    ];

    public function render()
    {
        $this->script = <<<EOT

var schema = {
    "\$schema": "http://json-schema.org/draft-03/schema#",
    "type": "object",
    "properties": {
        "thanhphan": {
            "type": "array",
            "title": "Thành phần",
            "minItems": 4,
            "uniqueItems": true,
            "items": {
              "description": "Thành phần Tổ kiểm nhập",
              "type": "object",
              "properties": {
                "hoten": {
                  "type": "string",
                  "title": "Họ tên",
                  "description": "Họ tên",
                  "required": true
                },
                "chucvu": {
                  "type": "string",
                  "title": "Chức vụ",
                  "description": "Chức vụ",
                  "required": true
                },
                "gioitinh": {
                  "type": "string",
                  "title": "Giới tính",
                  "required": true,
                  "enum": [
                    "Nam",
                    "Nữ"
                  ]
                },
                "vaitro": {
                  "type": "string",
                  "title": "Vai trò",
                  "required": true,
                  "enum": [
                    "Thành viên",
                    "Chủ tịch Hội đồng"
                  ]
                }
              }
            }
          }
    }
};

var BrutusinForms = brutusin["json-forms"];
var bf = BrutusinForms.create(schema);

var container = document.getElementById('$this->id');
bf.render(container);

       
        
EOT;

        //$this->script = "$('textarea.{$this->getElementClass()}').ckeditor();";

        return parent::render();
    }
}