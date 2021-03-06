<?php
namespace Dvi\Component\Widget\Form\Field;

use Adianti\Base\Lib\Widget\Base\TScript;
use Adianti\Base\Lib\Widget\Form\TEntry;
use Dvi\Component\Widget\Form\Field\Contract\FormComponentEventContract;
use Dvi\Component\Widget\Form\Field\Contract\FormField;
use Dvi\Component\Widget\Form\Field\Input\FormComponentEventImplementation;
use Dvi\Support\View\View;

/**
 * Widget Form Varchar
 * @package    form
 * @subpackage widget
 * @author     Davi Menezes
 * @copyright  Copyright (c) 2017. (davimenezes.dev@gmail.com)
 * @link https://github.com/DaviMenezes
 */
class Varchar extends TEntry implements FormField, FieldComponent, FormComponentEventContract
{
    use FormFieldTrait;
    use FormFieldValidationTrait;
    use SearchableField;
    use BaseComponentTrait;
    use FormComponentEventImplementation;

    public function __construct(string $name, string $label = null, int $max_length = null, bool $required = false)
    {
        parent::__construct($name);

        $this->setup($label ?? '', $required, $max_length);

        $this->operator('like');
    }

    public function prepareViewParams()
    {
        // verify if the widget is non-editable
        if (!parent::getEditable()) {
            $this->properties['readonly'] = 1;
            $this->properties['onmouseover'] = "style.cursor='default'";
        }

        if (isset($this->completion)) {
            $options = json_encode($this->completion);
            TScript::create(" tentry_autocomplete( '{$this->id}', $options); ");
        }

        $data['numeric_mask'] = $this->numericMask;
        if ($this->numericMask) {
            $data['decimals'] = $this->decimals;
            $data['decimals_separator'] = $this->decimalsSeparator;
            $data['thousand_separator'] = $this->thousandSeparator;
        }
        return $data;
    }

    public function getView(array $data)
    {
        return View::run('Widget.Form.Field.Varchar.View.varchar', $data);
    }
}
