<?php namespace AppBundle\Controller;

use AppBundle\Form\Data\ResumeSubmit;
use AppBundle\Form\Type\ResumeSubmitType;
use AppBundle\Services\GithubResumeFactory;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ResumeController extends Controller
{

    /**
     * @Route("/resume/create", name="resume_create", methods={"GET"})
     */
    public function createAction()
    {
        $resumeSubmit = new ResumeSubmit();
        $form = $this->createForm(ResumeSubmitType::class, $resumeSubmit);

        return $this->render('resume/create.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/resume/generate", name="resume_generate", methods={"POST"})
     */
    public function generateAction(Request $request, GithubResumeFactory $resumeFactory)
    {
        $resumeSubmit = new ResumeSubmit();
        $form = $this->createForm(ResumeSubmitType::class, $resumeSubmit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $resume = $resumeFactory->create($resumeSubmit->getUsername());

            return $this->render('resume/view.html.twig', [
                'resume' => $resume,
            ]);
        }

        $this->flashFormErrors($form);

        return $this->redirectToRoute('resume_create');
    }

    private function flashFormErrors(FormInterface $form)
    {
        $errors = $this->getErrorsFromForm($form);

        if (count($errors) > 0) {
            foreach ($errors as $error) {
                if (is_array($error)) {
                    foreach ($error as $fieldError) {
                        $this->addFlash(
                            'error',
                            $fieldError
                        );
                    }
                } else {
                    $this->addFlash(
                        'error',
                        $error
                    );
                }
            }
        } else {
            $this->addFlash(
                'error',
                'Validation error'
            );
        }
    }

    private function getErrorsFromForm(FormInterface $form)
    {
        $errors = array();
        foreach ($form->getErrors() as $error) {
            $errors[] = $error->getMessage();
        }
        foreach ($form->all() as $childForm) {
            if ($childForm instanceof FormInterface) {
                if ($childErrors = $this->getErrorsFromForm($childForm)) {
                    $errors[$childForm->getName()] = $childErrors;
                }
            }
        }
        return $errors;
    }


}