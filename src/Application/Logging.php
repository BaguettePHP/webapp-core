<?php
namespace Baguette\Application;
use Psr\Log;

/**
 * Logging trait for Application
 *
 * @package   Baguette\Application
 * @author    USAMI Kenta <tadsan@zonu.me>
 * @copyright 2015 USAMI Kenta
 * @license   http://www.apache.org/licenses/LICENSE-2.0 Apache-2.0
 * @link      https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-3-logger-interface.md
 */
trait Logging
{
    use Log\LoggerTrait;

    /** @var \Psr\Log\LoggerInterface */
    private $logging_logger;

    /**
     * Logs with an arbitrary level.
     *
     * @param  mixed  $level
     * @param  string $message
     * @param  array  $context
     * @return null
     */
    public function log($level, $message, array $context = [])
    {
        return $this->logging_logger->log($level, $message, $context);
    }

    /**
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function setLogger(Log\LoggerInterface $logger)
    {
        $this->logging_logger = $logger;
    }
}
