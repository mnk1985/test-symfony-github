<?php namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * @ORM\Entity
 */
class Resume
{

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    private $username;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    private $website;

    /**
     * @var ArrayCollection|UserRepository[]
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\UserRepository", mappedBy="resume")
     */
    private $repositories;

    /** @var ParameterBag */
    private $languages;

    public function __construct()
    {
        $this->repositories = new ArrayCollection();
        $this->languages = new ParameterBag();
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(?string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getWebsite(): ?string
    {
        return $this->website;
    }

    public function setWebsite(string $website): self
    {
        $this->website = $website;

        return $this;
    }

    public function addRepository(UserRepository $repository): self
    {
        $repository->setResume($this);
        $this->repositories->add($repository);

        return $this;
    }

    public function removeRepository(UserRepository $repository): self
    {
        $repository->setResume(null);
        $this->repositories->removeElement($repository);

        return $this;
    }

    /**
     * @return UserRepository[]|ArrayCollection
     */
    public function getRepositories()
    {
        return $this->repositories;
    }

    /**
     * @return ParameterBag
     */
    public function getLanguages(): ParameterBag
    {
        return $this->languages;
    }

    /**
     * @param ParameterBag $languages
     */
    public function setLanguages(ParameterBag $languages): self
    {
        $this->languages = $languages;

        return $this;
    }

}