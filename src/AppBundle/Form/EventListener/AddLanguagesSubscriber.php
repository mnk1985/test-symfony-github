<?php namespace AppBundle\Form\EventListener;

use AppBundle\Entity\Resume;
use AppBundle\Entity\UserRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\HttpFoundation\ParameterBag;

class AddLanguagesSubscriber implements EventSubscriberInterface
{

    /**
     * @return array The event names to listen to
     */
    public static function getSubscribedEvents()
    {
        return array(FormEvents::POST_SUBMIT => 'setLanguagesFrequency');
    }

    public function setLanguagesFrequency(FormEvent $event)
    {
        /** @var Resume $resume */
        $resume = $event->getData();

        $repoCount = $resume->getRepositories()->count();
        if ($repoCount == 0) {
            return;
        }

        // get languages and amount of its occurrences
        {
            $languagesAmount = [];
            /** @var UserRepository $repo */
            foreach ($resume->getRepositories() as $repo) {
                if (null == ($topLanguage = $repo->getTopLanguage())) {
                    continue;
                }

                if (isset($languagesAmount[$topLanguage])) {
                    $languagesAmount[$topLanguage]++;
                } else {
                    $languagesAmount[$topLanguage] = 1;
                }
            }
        }

        $languagesFrequency = new ParameterBag();

        foreach ($languagesAmount as $lang => $amount) {
            $languagesFrequency->set($lang, round(floatval($amount/$repoCount * 100), 2));
        }

        $resume->setLanguages($languagesFrequency);
    }
}