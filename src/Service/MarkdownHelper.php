<?php
namespace App\Service;

use Psr\Log\LoggerInterface;
use Michelf\MarkdownInterface;
use Symfony\Component\Cache\Adapter\AdapterInterface;

class MarkdownHelper
{
    private $cache;

    private $markdown;

    public function __construct(AdapterInterface $cache, MarkdownInterface $markdown, LoggerInterface $markdownLogger)
    {
        $this->cache    = $cache;
        $this->markdown = $markdown;
        $this->markdownLogger   = $markdownLogger;
    }

    public function parse(string $source ): string
    {

        if (stripos($source, 'bacon') !== false) {
            $this->markdownLogger->info('They are talkin about bacon again!');
        }

        // dump($this->cache); die();

        $item = $this->cache->getItem('markdown_'.md5($source));
        if (!$item->isHit()) {
            $item->set($this->markdown->transform($source));
            $this->cache->save($item);
        }

        return $item->get();
    }
}
