<?php

namespace App\Services;

use Michelf\MarkdownInterface;
use Psr\Cache\InvalidArgumentException;
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
     * MarkdownHelper constructor.
     *
     * @param AdapterInterface  $adapterInterface
     * @param MarkdownInterface $markdownInterface
     */
    public function __construct(AdapterInterface $adapterInterface, MarkdownInterface $markdownInterface)
    {
        $this->adapterInterface = $adapterInterface;
        $this->markdownInterface = $markdownInterface;
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
        $item = $this->adapterInterface->getItem('markdown_'.md5($source));

        if (!$item->isHit()) {
            $item->set($this->markdownInterface->transform($source));
            $this->adapterInterface->save($item);
        }

        return $item->get();
    }
}
