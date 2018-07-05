<?php namespace AppBundle\Form\Type;

use AppBundle\Entity\Resume;
use AppBundle\Form\EventListener\AddLanguagesSubscriber;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ResumeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('login', TextType::class, [
                'property_path' => 'username',
            ])
            ->add('blog', TextType::class, [
                'property_path' => 'website',
            ])
            ->add('repositories', CollectionType::class, [
                'entry_type' => UserRepositoryType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
            ])
        ;

        $builder->addEventSubscriber(new AddLanguagesSubscriber());
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Resume::class,
        ));
    }
}