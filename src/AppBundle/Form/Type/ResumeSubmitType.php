<?php namespace AppBundle\Form\Type;

use AppBundle\Form\Data\ResumeSubmit;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class ResumeSubmitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, [
                'required' => true,
                'attr' => array('class' => 'form-control'),
                'label' => 'Github username',
                'constraints' => [
                    new Length(['max' => 39, 'maxMessage' => 'Username is too long. It should have {{ limit }} character or less.'])
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => ResumeSubmit::class,
        ));
    }
}