<?php

namespace App\Services;

use Michelf\MarkdownInterface;
use Psr\Cache\InvalidArgumentException;
use Psr\Log\LoggerInterface;
use Symfony\Component\Cache\Adapter\AdapterInterface;

class MarkdownHelper
{
    /**
     * @var AdapterInterface
     */
    protected $adapterInterface;

    /**
     * @var MarkdownInterface
     */
    protected $markdownInterface;

    /**
     * @var LoggerInterface
     */
    protected $logger;
    /**
     * @var bool
     */
    private $isDebug;

    /**
     * MarkdownHelper constructor.
     *
     * @param AdapterInterface $adapterInterface
     * @param MarkdownInterface $markdownInterface
     * @param LoggerInterface $logger
     * @param bool $isDebug
     */
    public function __construct(AdapterInterface $adapterInterface, MarkdownInterface $markdownInterface, LoggerInterface $logger, bool $isDebug)
    {
        $this->adapterInterface = $adapterInterface;
        $this->markdownInterface = $markdownInterface;
        $this->logger = $logger;
        $this->isDebug = $isDebug;
    }

    /**
     * @param string $source
     *
     * @return string
     *
     * @throws InvalidArgumentException
     */
    public function parse(string $source): string
    {

        if ($this->isDebug) {
            return $this->markdownInterface->transform($source);
        }

        $item = $this->adapterInterface->getItem('markdown_'.md5($source));


        if (!$item->isHit()) {
            $item->set($this->markdownInterface->transform($source));
            $this->adapterInterface->save($item);

            $this->logger->alert('Cached Again');
            $this->logger->info('Cached Again and Again');
        }

        return $item->get();
    }
}
