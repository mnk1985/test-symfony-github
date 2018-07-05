<?php namespace AppBundle\Services;

use Github\Api\Repo;
use Github\Api\User;
use \Github\Client;

class GithubDataProvider
{
    /** @var User  */
    private $user;
    /** @var Repo  */
    private $api;
    /**
     * @var RepoLanguageDefiner
     */
    private $languageDefiner;

    public function __construct($user, $password, $method, RepoLanguageDefiner $languageDefiner)
    {
        $client = new Client();

        if (isset($user, $password, $method)){
            $client->authenticate( $user, $password, $method);
        }

        $this->user = $client->api('user');
        $this->api = $client->api('repo');
        $this->languageDefiner = $languageDefiner;
    }

    public function getDataByUsername(string $username)
    {
        $userDetails = $this->user->show($username);
        $repositories = $this->user->repositories($username);
        $updatedRepositories = [];
        foreach ($repositories as $repo) {
            $allLanguages = $this->api->languages($username, $repo['name']);
            $repo['topLanguage'] = $this->languageDefiner->getTopLanguage($allLanguages);
            $updatedRepositories[] = $repo;
        }
        $userDetails['repositories'] = $updatedRepositories;

        return $userDetails;
    }
}