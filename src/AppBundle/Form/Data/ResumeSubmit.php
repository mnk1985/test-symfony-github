<?php namespace AppBundle\Form\Data;

class ResumeSubmit
{
    private $username;

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }
}