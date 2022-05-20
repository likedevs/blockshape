<?php namespace Terranet\Administrator\Form;

use Illuminate\Support\Collection;
use Terranet\Administrator\Exception;
use Terranet\Administrator\Exceptions\UnknownFieldTypeException;

class Builder
{
    /**
     * @var array
     */
    private $fields = null;

    private $cleanFields = [];

    /**
     * The valid field types and their associated classes
     *
     * @var array
     */
    private $fieldTypes = array(
        'key'       => 'Terranet\\Administrator\\Form\\Type\\Key',
        'text'      => 'Terranet\\Administrator\\Form\\Type\\Text',
        'hidden'    => 'Terranet\\Administrator\\Form\\Type\\Hidden',
        'email'     => 'Terranet\\Administrator\\Form\\Type\\Email',
        'select'    => 'Terranet\\Administrator\\Form\\Type\\Select',
        'textarea'  => 'Terranet\\Administrator\\Form\\Type\\Textarea',
        'ckeditor'  => 'Terranet\\Administrator\\Form\\Type\\Ckeditor',
        'tinymce'   => 'Terranet\\Administrator\\Form\\Type\\Tinymce',
        'markdown'  => 'Terranet\\Administrator\\Form\\Type\\Markdown',
        'password'  => 'Terranet\\Administrator\\Form\\Type\\Password',
        'date'      => 'Terranet\\Administrator\\Form\\Type\\Date',
        'time'      => 'Terranet\\Administrator\\Form\\Type\\Time',
        'datetime'  => 'Terranet\\Administrator\\Form\\Type\\Datetime',
        'number'    => 'Terranet\\Administrator\\Form\\Type\\Number',
        'tel'       => 'Terranet\\Administrator\\Form\\Type\\Tel',
        'bool'      => 'Terranet\\Administrator\\Form\\Type\\Bool',
        'image'     => 'Terranet\\Administrator\\Form\\Type\\Image',
        'file'      => 'Terranet\\Administrator\\Form\\Type\\File',
        'color'     => 'Terranet\\Administrator\\Form\\Type\\Color',
    );

    /**
     * Fields that should be translated
     *
     * @var array
     */
    protected $translatable = [];

    public function __construct(array $fields = [])
    {
        $this->cleanFields = $fields;
    }

    public function getFields()
    {
        if (null == $this->fields)
        {
            $fields = [];

            foreach($this->cleanFields as $name => $options)
            {
                if (is_a($options, '\\Terranet\Administrator\\Form\\Element'))
                {
                    $element = $options;
                }
                else if ((is_string($name) && is_array($options)))
                {
                    $type    = $options['type'];
                    $element = $this->createElement($type, $options, $name);

                    if (isset($options['translatable']) && (bool) $options['translatable'])
                    {
                        $element = new TranslatableElement($element);
                    }
                }
                else
                {
                    throw new Exception(sprintf('Can not initializa element [%s]', $name));
                }

                $fields[]  = $element;
            }

            $this->fields = Collection::make($fields);
        }

        return $this->fields;
    }

    /**
     * @param $type
     * @param $options
     * @param $name
     * @return mixed
     * @throws UnknownFieldTypeException
     */
    private function createElement($type, $options, $name)
    {
        $className = $this->fieldTypes[$type];
        if (!$className) {
            throw new UnknownFieldTypeException(sprintf("Unknown field of type '%s'", $options['type']));
        }

        $element = (new $className($name))->initFromArray($options);

        return $element;
    }

    public function getEditors()
    {
        if (! $this->fields)
        {
            $this->getFields();
        }

        $editors = [];

        foreach ($this->fields as $field)
        {
            if ($field->getType() == 'tinymce' && ! in_array('tinymce', $editors))
            {
                $editors[] = 'tinymce';
            }
            else if ($field->getType() == 'ckeditor' && ! in_array('tinymce', $editors))
            {
                $editors[] = 'ckeditor';
            }
        }

        return $editors;
    }
}