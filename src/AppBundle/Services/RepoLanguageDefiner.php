<?php namespace AppBundle\Services;

/**
 * Class RepoLanguageDefiner
 * @package AppBundle\Services
 */
class RepoLanguageDefiner
{
    /**
     * get top by most rows
     * @param array $languages
     * @return null|string
     */
    public function getTopLanguage(array $languages): ?string
    {
        if (count($languages) == 0) {
            return null;
        }

        arsort($languages, SORT_DESC);
        reset($languages);
        return key($languages);
    }
}