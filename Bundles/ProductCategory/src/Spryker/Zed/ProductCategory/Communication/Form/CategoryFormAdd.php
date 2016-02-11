<?php

/**
 * (c) Spryker Systems GmbH copyright protected
 */

namespace Spryker\Zed\ProductCategory\Communication\Form;

use Spryker\Zed\Gui\Communication\Form\Type\Select2ComboBoxType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

class CategoryFormAdd extends AbstractType
{

    const OPTION_PARENT_CATEGORY_NODE_CHOICES = 'parent_category_node_choices';

    const FIELD_NAME = 'name';
    const FIELD_CATEGORY_KEY = 'category_key';
    const FIELD_PK_CATEGORY_NODE = 'id_category_node';
    const FIELD_FK_PARENT_CATEGORY_NODE = 'fk_parent_category_node';
    const FIELD_FK_NODE_CATEGORY = 'fk_category';

    /**
     * @return string
     */
    public function getName()
    {
        return 'category';
    }

    /**
     * @param \Symfony\Component\OptionsResolver\OptionsResolverInterface $resolver
     *
     * @return void
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        parent::setDefaultOptions($resolver);

        $resolver->setRequired(self::OPTION_PARENT_CATEGORY_NODE_CHOICES);
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array $options
     *
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this
            ->addNameField($builder)
            ->addCategoryKeyField($builder)
            ->addCategoryNodeField($builder, $options[self::OPTION_PARENT_CATEGORY_NODE_CHOICES])
            ->addPkCategoryNodeField($builder);
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     *
     * @return $this
     */
    protected function addNameField(FormBuilderInterface $builder)
    {
        $builder
            ->add(self::FIELD_NAME, 'text', [
                'constraints' => [
                    new NotBlank(),
                ],
            ]);

        return $this;
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     *
     * @return $this
     */
    protected function addCategoryKeyField(FormBuilderInterface $builder)
    {
        $builder
            ->add(self::FIELD_CATEGORY_KEY, 'text', [
            'constraints' => [
                new NotBlank(),
            ],
        ]);

        return $this;
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array $choices
     *
     * @return $this
     */
    protected function addCategoryNodeField(FormBuilderInterface $builder, array $choices)
    {
        $builder
            ->add(self::FIELD_FK_PARENT_CATEGORY_NODE, new Select2ComboBoxType(), [
                'label' => 'Parent',
                'choices' => $choices,
                'constraints' => [
                    new NotBlank(),
                ],
            ]);

        return $this;
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     *
     * @return $this
     */
    protected function addPkCategoryNodeField(FormBuilderInterface $builder)
    {
        $builder->add(self::FIELD_PK_CATEGORY_NODE, 'hidden');

        return $this;
    }

}