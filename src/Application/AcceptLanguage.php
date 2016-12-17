<?php

namespace Baguette\Application;

/**
 * Param trait for Application (filter_var wrapper)
 *
 * @author    USAMI Kenta <tadsan@zonu.me>
 * @copyright 2016 Baguette HQ
 * @license   http://www.apache.org/licenses/LICENSE-2.0 Apache-2.0
 * @link      http://php.net/manual/function.filter-var.php
 */
trait AcceptLanguage
{
    /** @var string */
    protected $accept_language_default_language = 'en';
    /** @var array */
    protected $accept_language_available_languages = ['en'];
    /** @var callable */
    protected $accept_language_strategy;

    /**
     * @param  array $languages
     * @throws \DomainException
     * @return string
     */
    public function getLanguage(array $languages = [])
    {
        /** @var \Baguette\Application $this */

        if (empty($languages)) {
            if (empty($this->accept_language_strategy)) {
                throw new \DomainException('$this->accept_language_strategy is not set.');
            }
            $strategy = $this->accept_language_strategy;
            $default  = $this->accept_language_default_language;
        } else {
            $languages = empty($languages)
                ? $this->accept_language_available_languages
                : array_values($languages) ;
            if (empty($languages)) {
                throw new \DomainException('$this->accept_language_available_languages is not set.');
            }
            $strategy = function ($lang) use ($languages) {
                $match = array_search($lang['language'], $languages, true);
                return ($match !== false) ? $languages[$match] : false ;
            };
            $default = $languages[0];
        }

        return \Teto\HTTP\AcceptLanguage::detect($strategy, $default, $this->server['HTTP_ACCEPT_LANGUAGE']);
    }

    public function getLanguageByStrategy()
    {

    }

    protected function setAvailableLanguages(array $lang)
    {

    }

    /**
     * @param callable $strategy
     */
    protected function setLanguageDetectStrategy(callable $strategy)
    {
        $this->accept_language_strategy = $strategy;
    }
}
