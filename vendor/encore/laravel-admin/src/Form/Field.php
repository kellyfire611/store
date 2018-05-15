<?php

namespace Encore\Admin\Form;

use Encore\Admin\Admin;
use Encore\Admin\Form;
use App\Models\CommonModel;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;

/**
 * Class Field.
 */
class Field implements Renderable
{
    const FILE_DELETE_FLAG = '_file_del_';

    /**
     * Element id.
     *
     * @var array|string
     */
    protected $id;

    /**
     * Element value.
     *
     * @var mixed
     */
    protected $value;

    /**
     * Field original value.
     *
     * @var mixed
     */
    protected $original;

    /**
     * Field default value.
     *
     * @var mixed
     */
    protected $default;

    /**
     * Render style
     */
    protected $renderStyle;
    
    /**
     * Display or not?
     */
    protected $display = true;

    /**
     * Element label.
     *
     * @var string
     */
    protected $label = '';
    protected $labelPosition = 4; // Left

    /**
     * Column name.
     *
     * @var string|array
     */
    protected $column = '';

    /**
     * View Mode.
     *
     * Supports `default` and `tab` currently.
     *
     * @var string
     */
    protected $viewMode = 'default';

    /**
     * Form element name.
     *
     * @var string
     */
    protected $elementName = [];

    /**
     * Form element classes.
     *
     * @var array
     */
    protected $elementClass = [];

    /**
     * Variables of elements.
     *
     * @var array
     */
    protected $variables = [];

    /**
     * Options for specify elements.
     *
     * @var array
     */
    protected $options = [];

    /**
     * Validation rules.
     *
     * @var string|\Closure
     */
    protected $rules = '';

    /**
     * @var callable
     */
    protected $validator;

    /**
     * Validation messages.
     *
     * @var array
     */
    protected $validationMessages = [];

    /**
     * Css required by this field.
     *
     * @var array
     */
    protected static $css = [];

    /**
     * Js required by this field.
     *
     * @var array
     */
    protected static $js = [];

    /**
     * Script for field.
     *
     * @var string
     */
    protected $script = '';

    /**
     * Element attributes.
     *
     * @var array
     */
    protected $attributes = [];

    /**
     * Parent form.
     *
     * @var Form
     */
    protected $form = null;

    /**
     * View for field to render.
     *
     * @var string
     */
    protected $view = '';

    /**
     * Help block.
     *
     * @var array
     */
    protected $help = [];

    /**
     * Key for errors.
     *
     * @var mixed
     */
    protected $errorKey;

    /**
     * Placeholder for this field.
     *
     * @var string|array
     */
    protected $placeholder;

    /**
     * Width for label and field.
     *
     * @var array
     */
    protected $width = [
        'label' => 2,
        'field' => 12,
        'view' => 12,
    ];

    /**
     * If the form horizontal layout.
     *
     * @var bool
     */
    protected $horizontal = true;
    protected $ajaxHtmlCssLoader;

    /**
     * Field constructor.
     *
     * @param $column
     * @param array $arguments
     */
    public function __construct($column, $arguments = [])
    {
        $this->column = $column;
        $this->label = $this->formatLabel($arguments);
        $this->id = $this->formatId($column);
    }

    /**
     * Get assets required by this field.
     *
     * @return array
     */
    public static function getAssets()
    {
        return [
            'css' => static::$css,
            'js'  => static::$js,
        ];
    }

    /**
     * Format the field element id.
     *
     * @param string|array $column
     *
     * @return string|array
     */
    protected function formatId($column)
    {
        return str_replace('.', '_', $column);
    }

    /**
     * Format the label value.
     *
     * @param array $arguments
     *
     * @return string
     */
    protected function formatLabel($arguments = [])
    {
        $column = is_array($this->column) ? current($this->column) : $this->column;

        $label = isset($arguments[0]) ? $arguments[0] : ucfirst($column);

        return str_replace(['.', '_'], ' ', $label);
    }

    /**
     * Format the name of the field.
     *
     * @param string $column
     *
     * @return array|mixed|string
     */
    protected function formatName($column)
    {
        if (is_string($column)) {
            $name = explode('.', $column);

            if (count($name) == 1) {
                return $name[0];
            }

            $html = array_shift($name);
            foreach ($name as $piece) {
                $html .= "[$piece]";
            }

            return $html;
        }

        if (is_array($this->column)) {
            $names = [];
            foreach ($this->column as $key => $name) {
                $names[$key] = $this->formatName($name);
            }

            return $names;
        }

        return '';
    }

    /**
     * Set form element name.
     *
     * @param string $name
     *
     * @return $this
     *
     * @author Edwin Hui
     */
    public function setElementName($name)
    {
        $this->elementName = $name;

        return $this;
    }

    /**
     * Fill data to the field.
     *
     * @param array $data
     *
     * @return void
     */
    public function fill($data)
    {
        // Field value is already setted.
//        if (!is_null($this->value)) {
//            return;
//        }

        if (is_array($this->column)) {
            foreach ($this->column as $key => $column) {
                $this->value[$key] = array_get($data, $column);
            }

            return;
        }

        $this->value = array_get($data, $this->column);
    }

    /**
     * Set original value to the field.
     *
     * @param array $data
     *
     * @return void
     */
    public function setOriginal($data)
    {
        if (is_array($this->column)) {
            foreach ($this->column as $key => $column) {
                $this->original[$key] = array_get($data, $column);
            }

            return;
        }

        $this->original = array_get($data, $this->column);
    }

    /**
     * @param Form $form
     *
     * @return $this
     */
    public function setForm(Form $form = null)
    {
        $this->form = $form;

        return $this;
    }

    /**
     * Set width for field and label.
     *
     * @param int $field
     * @param int $label
     *
     * @return $this
     */
    public function setWidth($field = 8, $label = 2, $view = 12)
    {
        $this->width = [
            'label' => $label,
            'field' => $field,
            'view'  => $view,
        ];

        return $this;
    }
    
    public function setViewWidth($view = 12)
    {
        $this->width['view'] = $view;

        return $this;
    }

    /**
     * Set the field options.
     *
     * @param array $options
     *
     * @return $this
     */
    public function options($options = [])
    {
        if ($options instanceof Arrayable) {
            $options = $options->toArray();
        }

        $this->options = array_merge($this->options, $options);

        return $this;
    }

    /**
     * Get or set rules.
     *
     * @param null  $rules
     * @param array $messages
     *
     * @return $this
     */
    public function rules($rules = null, $messages = [])
    {
        if ($rules instanceof \Closure) {
            $this->rules = $rules;
        }

        if (is_string($rules)) {
            $rules = array_filter(explode('|', "{$this->rules}|$rules"));

            $this->rules = implode('|', $rules);
        }

        $this->validationMessages = $messages;

        return $this;
    }

    /**
     * Get field validation rules.
     *
     * @return string
     */
    protected function getRules()
    {
        if ($this->rules instanceof \Closure) {
            return $this->rules->call($this, $this->form);
        }

        return $this->rules;
    }

    /**
     * Remove a specific rule.
     *
     * @param string $rule
     *
     * @return void
     */
    protected function removeRule($rule)
    {
        $this->rules = str_replace($rule, '', $this->rules);
    }

    /**
     * Set field validator.
     *
     * @param callable $validator
     *
     * @return $this
     */
    public function validator(callable $validator)
    {
        $this->validator = $validator;

        return $this;
    }

    /**
     * Get key for error message.
     *
     * @return string
     */
    public function getErrorKey()
    {
        return $this->errorKey ?: $this->column;
    }

    /**
     * Set key for error message.
     *
     * @param string $key
     *
     * @return $this
     */
    public function setErrorKey($key)
    {
        $this->errorKey = $key;

        return $this;
    }

    /**
     * Set or get value of the field.
     *
     * @param null $value
     *
     * @return mixed
     */
    public function value($value = null)
    {
        if (is_null($value)) {
            return is_null($this->value) ? $this->getDefault() : $this->value;
        }

        $this->value = $value;

        return $this;
    }

    /**
     * Set default value for field.
     *
     * @param $default
     *
     * @return $this
     */
    public function default($default)
    {
        $this->default = $default;

        return $this;
    }

    public function renderStyle($renderStyle)
    {
        $this->renderStyle = $renderStyle;
        switch($this->renderStyle)
        {
            case CommonModel::RENDER_STYLE_ONLY_CONTROL:
                $this->width = [
                    'label' => 0,
                    'field' => 12,
                    'view' => 12,
                ];
                break;
            case CommonModel::RENDER_STYLE_ONLY_LABEL:
                $this->width = [
                    'label' => 12,
                    'field' => 0,
                    'view' => 12,
                ];
                break;
            case CommonModel::RENDER_STYLE_LABEL_AND_CONTROL:
                $this->width = [
                    'label' => 2,
                    'field' => 10,
                    'view' => 12,
                ];
                break;
            default:
                break;
        }

        return $this;
    }

    public function displayNone()
    {
        $this->display = false;
        $this->addElementClass(['display-none']);

        return $this;
    }

    public function display()
    {
        $this->display = true;

        return $this;
    }

    public function isDisplay()
    {
        return $this->display;
    }

    /**
     * Get default value.
     *
     * @return mixed
     */
    public function getDefault()
    {
        if ($this->default instanceof \Closure) {
            return call_user_func($this->default, $this->form);
        }

        return $this->default;
    }

    public function getRenderStyle()
    {
        if ($this->renderStyle instanceof \Closure) {
            return call_user_func($this->renderStyle, $this->form);
        }

        return $this->renderStyle;
    }

    /**
     * Set help block for current field.
     *
     * @param string $text
     * @param string $icon
     *
     * @return $this
     */
    public function help($text = '', $icon = 'fa-info-circle')
    {
        $this->help = compact('text', 'icon');

        return $this;
    }

    /**
     * Get column of the field.
     *
     * @return string|array
     */
    public function column()
    {
        return $this->column;
    }

    /**
     * Get label of the field.
     *
     * @return string
     */
    public function label()
    {
        return $this->label;
    }

    /**
     * Get original value of the field.
     *
     * @return mixed
     */
    public function original()
    {
        return $this->original;
    }

    /**
     * Get validator for this field.
     *
     * @param array $input
     *
     * @return bool|Validator
     */
    public function getValidator(array $input)
    {
        if ($this->validator) {
            return $this->validator->call($this, $input);
        }

        $rules = $attributes = [];

        if (!$fieldRules = $this->getRules()) {
            return false;
        }

        if (is_string($this->column)) {
            if (!array_has($input, $this->column)) {
                return false;
            }

            $input = $this->sanitizeInput($input, $this->column);

            $rules[$this->column] = $fieldRules;
            $attributes[$this->column] = $this->label;
        }

        if (is_array($this->column)) {
            foreach ($this->column as $key => $column) {
                if (!array_key_exists($column, $input)) {
                    continue;
                }
                $input[$column.$key] = array_get($input, $column);
                $rules[$column.$key] = $fieldRules;
                $attributes[$column.$key] = $this->label."[$column]";
            }
        }

        return Validator::make($input, $rules, $this->validationMessages, $attributes);
    }

    /**
     * Sanitize input data.
     *
     * @param array  $input
     * @param string $column
     *
     * @return array
     */
    protected function sanitizeInput($input, $column)
    {
        if ($this instanceof Field\MultipleSelect) {
            $value = array_get($input, $column);
            array_set($input, $column, array_filter($value));
        }

        return $input;
    }

    /**
     * Add html attributes to elements.
     *
     * @param array|string $attribute
     * @param mixed        $value
     *
     * @return $this
     */
    public function attribute($attribute, $value = null)
    {
        if (is_array($attribute)) {
            $this->attributes = array_merge($this->attributes, $attribute);
        } else {
            $this->attributes[$attribute] = (string) $value;
        }

        return $this;
    }

    /**
     * Set the field as readonly mode.
     *
     * @return Field
     */
    public function readOnly()
    {
        return $this->attribute('readonly', true);
    }
    public function disable()
    {
        return $this->attribute('disabled', true);
    }

    /**
     * Set field placeholder.
     *
     * @param string $placeholder
     *
     * @return Field
     */
    public function placeholder($placeholder = '')
    {
        $this->placeholder = $placeholder;

        return $this;
    }

    /**
     * Get placeholder.
     *
     * @return string
     */
    public function getPlaceholder()
    {
        return $this->placeholder ?: trans('admin.input').' '.$this->label;
    }

    /**
     * Prepare for a field value before update or insert.
     *
     * @param $value
     *
     * @return mixed
     */
    public function prepare($value)
    {
        return $value;
    }

    /**
     * Format the field attributes.
     *
     * @return string
     */
    protected function formatAttributes()
    {
        $html = [];

        foreach ($this->attributes as $name => $value) {
            $html[] = $name.'="'.e($value).'"';
        }

        return implode(' ', $html);
    }

    /**
     * @return $this
     */
    public function disableHorizontal()
    {
        $this->horizontal = false;

        return $this;
    }

    /**
     * @return array
     */
    public function getViewElementClasses()
    {
        if($this->viewMode == 'default') {
            if ($this->horizontal) {
                return [
                    'label'      => "col-sm-{$this->width['label']}",
                    'field'      => "col-sm-{$this->width['field']}",
                    'view'       => "col-sm-{$this->width['view']}",
                    'form-group' => 'form-group ',
                ];
            }

            return ['label' => '', 'field' => '', 'form-group' => ''];
        }
        else {
            if ($this->horizontal) {
                return [
                    'label'      => "no-padding no-margin col-sm-{$this->width['label']}",
                    'field'      => "no-padding no-margin col-sm-{$this->width['field']}",
                    'form-group' => 'form-group no-padding no-margin form-group-viewmode-'.$this->viewMode." col-sm-{$this->width['view']} ",
                ];
            }

            return ['label' => '', 'field' => '', 'form-group' => ''];
        }
    }

    /**
     * Set form element class.
     *
     * @param string|array $class
     *
     * @return $this
     */
    public function setElementClass($class)
    {
        $this->elementClass = (array) $class;

        return $this;
    }

    /**
     * Get element class.
     *
     * @return array
     */
    protected function getElementClass()
    {
        if (!$this->elementClass) {
            $name = $this->elementName ?: $this->formatName($this->column);

            $this->elementClass = (array) str_replace(['[', ']'], '_', $name);
        }

        return $this->elementClass;
    }

    /**
     * Get element class string.
     *
     * @return mixed
     */
    public function getElementClassString()
    {
        $elementClass = $this->getElementClass();

        if (Arr::isAssoc($elementClass)) {
            $classes = [];

            foreach ($elementClass as $index => $class) {
                $classes[$index] = is_array($class) ? implode(' ', $class) : $class;
            }

            return $classes;
        }

        return implode(' ', $elementClass);
    }

    /**
     * Get element class selector.
     *
     * @return string
     */
    public function getElementClassSelector()
    {
        $elementClass = $this->getElementClass();

        if (Arr::isAssoc($elementClass)) {
            $classes = [];

            foreach ($elementClass as $index => $class) {
                $classes[$index] = '.'.(is_array($class) ? implode('.', $class) : $class);
            }

            return $classes;
        }

        return '.'.implode('.', $elementClass);
    }

    /**
     * Add the element class.
     *
     * @param $class
     *
     * @return $this
     */
    public function addElementClass($class)
    {
        if (is_array($class) || is_string($class)) {
            $this->elementClass = array_merge($this->elementClass, (array) $class);

            $this->elementClass = array_unique($this->elementClass);
        }

        return $this;
    }

    /**
     * Remove element class.
     *
     * @param $class
     *
     * @return $this
     */
    public function removeElementClass($class)
    {
        $delClass = [];

        if (is_string($class) || is_array($class)) {
            $delClass = (array) $class;
        }

        foreach ($delClass as $del) {
            if (($key = array_search($del, $this->elementClass))) {
                unset($this->elementClass[$key]);
            }
        }

        return $this;
    }

    /**
     * Get the view variables of this field.
     *
     * @return array
     */
    protected function variables()
    {
        return array_merge($this->variables, [
            'id'          => $this->id,
            'name'        => $this->elementName ?: $this->formatName($this->column),
            'help'        => $this->help,
            'class'       => $this->getElementClassString(),
            'value'       => $this->value(),
            'label'       => $this->label,
            'viewClass'   => $this->getViewElementClasses(),
            'column'      => $this->column,
            'errorKey'    => $this->getErrorKey(),
            'attributes'  => $this->formatAttributes(),
            'placeholder' => $this->getPlaceholder(),
            'renderStyle' => $this->renderStyle,
            'viewMode'    => $this->viewMode,
            'labelPosition' => $this->labelPosition,
            'ajaxHtmlCssLoader' => $this->ajaxHtmlCssLoader,
        ]);
    }

    /**
     * Get view of this field.
     *
     * @return string
     */
    public function getView()
    {
        if (!empty($this->view)) {
            return $this->view;
        }

        $class = explode('\\', get_called_class());

        if($this->viewMode == 'default') {
            return 'admin::form.'.strtolower(end($class));
        }
        else {
            return 'admin::form.'.strtolower(end($class)).$this->viewMode;
        }
    }

    /**
     * Get script of current field.
     *
     * @return string
     */
    public function getScript()
    {
        return $this->script;
    }

    public function script($script)
    {
        return $this->script = $script;
    }

    /**
     * Render this filed.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function render()
    {
        Admin::script($this->script);

        return view($this->getView(), $this->variables());
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->render()->render();
    }

    public function isHidden()
    {
        return is_a($this, \Encore\Admin\Form\Field\Hidden::class);
    }

    /**
     * Set view mode.
     *
     * @param string $mode currently support `tab` mode.
     *
     * @return $this
     *
     * @author Edwin Hui
     */
    public function mode($mode)
    {
        $this->viewMode = $mode;

        return $this;
    }

    public function useTable()
    {
        return $this->mode('table');
    }

    public function useTableDiv()
    {
        return $this->mode('tablediv');
    }

    public function labelPosition($postion) {
        $this->labelPosition = $postion;

        return $this;
    }

    public function on($event, $callback)
    {
        $this->script = <<<EOT

        $('{$this->getElementClassSelector()}').on('$event', function() {
            $callback
        });

EOT;
    }

    public function jsEvent($selector, $event, $callback)
    {
        $this->script = <<<EOT

        $('$selector').on('$event', function() {
            $callback
        });

EOT;
    }

    public function addAjaxCssLoader()
    {
        $this->ajaxHtmlCssLoader = <<<EOT
        <div id="$this->id-cssloader" class="" style="width:32px;height:32px;display:none;"> <svg class="lds-comets" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid"><g transform="rotate(347.968 50 50)"> <animateTransform attributeName="transform" type="rotate" repeatCount="indefinite" values="360 50 50;240 50 50;120 50 50;0 50 50" keyTimes="0;0.333;0.667;1" dur="1s" keySplines="0.7 0 0.3 1;0.7 0 0.3 1;0.7 0 0.3 1" calcMode="spline"></animateTransform> <path fill="#f05125" d="M91,74.1C75.6,98,40.7,102.4,21.2,81c11,9.9,26.8,13.5,40.8,8.7c7.4-2.5,13.9-7.2,18.7-13.3 c1.8-2.3,3.5-7.6,6.7-8C90.5,67.9,92.7,71.5,91,74.1z"></path> <path fill="#fdb813" d="M50.7,5c-4,0.2-4.9,5.9-1.1,7.3c1.8,0.6,4.1,0.1,5.9,0.3c2.1,0.1,4.3,0.5,6.4,0.9c5.8,1.4,11.3,4,16,7.8 C89.8,31.1,95.2,47,92,62c4.2-13.1,1.6-27.5-6.4-38.7c-3.4-4.7-7.8-8.7-12.7-11.7C66.6,7.8,58.2,4.6,50.7,5z"></path> <path fill="#7fbb42" d="M30.9,13.4C12,22.7,2.1,44.2,7.6,64.8c0.8,3.2,3.8,14.9,9.3,10.5c2.4-2,1.1-4.4-0.2-6.6 c-1.7-3-3.1-6.2-4-9.5C10.6,51,11.1,41.9,14.4,34c4.7-11.5,14.1-19.7,25.8-23.8C37,11,33.9,11.9,30.9,13.4z"></path></g></svg></div>
EOT;
        return $this;
    }

    public function getIdString()
    {
        return $this->id;
    }

    public function getIdSelector()
    {
        return '#'.$this->id;
    }
}
