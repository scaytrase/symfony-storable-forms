<?php
/**
 * Created by PhpStorm.
 * User: Pavel Batanov <pavel@batanov.me>
 * Date: 29.09.2014
 * Time: 17:57
 */

namespace ScayTrase\Forms\StorableFormsBundle\Form\Type;


use ScayTrase\Forms\StorableFormsBundle\Services\StorableFormsRegistry;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Translation\TranslatorInterface;

class FieldType extends AbstractType
{
    /** @var  StorableFormsRegistry */
    private $registry;

    /** @var TranslatorInterface */
    private $translator;

    function __construct(StorableFormsRegistry $registry, TranslatorInterface $translator)
    {
        $this->registry = $registry;
        $this->translator = $translator;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $translator = $this->translator;

        $builder
            ->add('name', 'text', array('label' => 'Код поля'))
            ->add('description', 'text', array('label' => 'Описание'))
            ->add('help_message', 'textarea', array('label' => 'Подсказка','required'=>false))
            ->add(
                'type',
                'choice',
                array(
                    'choices' => array_combine(
                        $this->registry->getFieldTypes(),
                        array_map(
                            function ($type) use ($translator) {
                                return $translator->trans($type);
                            },
                            $this->registry->getFieldTypes()
                        )
                    ),
                    'label' => 'Тип поля'
                )
            )
            ->add(
                'options',
                'key_value_collection',
                array('allow_add' => true, 'allow_delete' => true, 'label' => 'Опции')
            );
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array('data_class' => 'ScayTrase\Forms\StorableFormsBundle\Entity\Field'));
    }


    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'storable_field';
    }
}