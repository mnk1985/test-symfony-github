<?php namespace AppBundle\Services;

use AppBundle\Entity\Resume;
use AppBundle\Entity\UserRepository;
use AppBundle\Form\Type\ResumeType;
use AppBundle\Form\Type\UserRepositoryType;
use Symfony\Component\Form\FormFactory;

class GithubResumeFactory
{
    /**
     * @var GithubDataProvider
     */
    private $githubDataProvider;
    /**
     * @var FormFactory
     */
    private $formFactory;

    public function __construct(GithubDataProvider $githubDataProvider, FormFactory $formFactory)
    {
        $this->githubDataProvider = $githubDataProvider;
        $this->formFactory = $formFactory;
    }

    public function create(string $username): Resume
    {
        $userDetails = $this->githubDataProvider->getDataByUsername($username);

        $repo = new UserRepository();
        $formRepo = $this->formFactory->create(UserRepositoryType::class, $repo);
        $formRepo->submit($userDetails['repositories'][0]);

        $resume = new Resume();
        $form = $this->formFactory->create(ResumeType::class, $resume);
        $form->submit($userDetails);

        return $resume;
    }
}