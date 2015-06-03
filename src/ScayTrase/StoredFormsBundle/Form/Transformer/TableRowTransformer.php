<?php
/**
 * Created by PhpStorm.
 * User: Pavel Batanov <pavel@batanov.me>
 * Date: 02.06.2015
 * Time: 17:10
 */

namespace ScayTrase\StoredFormsBundle\Form\Transformer;

use ScayTrase\StoredFormsBundle\Entity\Value\Type\TableRow;
use Symfony\Component\Form\DataTransformerInterface;

class TableRowTransformer implements DataTransformerInterface
{

    /** @inheritdoc */
    public function transform($value)
    {
        if (!($value instanceof TableRow)) {
            return null;
        }

        return $value->getValues();
    }

    /** @inheritdoc */
    public function reverseTransform($value)
    {
        $tableRow = new TableRow();
        $tableRow->setValues($value);
        return $tableRow;
    }
}
