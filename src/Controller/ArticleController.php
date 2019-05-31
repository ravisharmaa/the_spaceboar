<?php

namespace App\Controller;

use Michelf\MarkdownInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Cache\Adapter\AdapterInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route ("/", name="homepage")
     *
     * @return Response
     */
    public function index()
    {
        return $this->render('articles/index.html.twig');
    }

    /**
     * @Route ("/show/{slug}", name="show_article")
     *
     * @param $slug
     * @param MarkdownInterface $markdown
     * @param AdapterInterface  $cache
     *
     * @return Response
     *
     * @throws \Psr\Cache\InvalidArgumentException
     */
    public function show($slug, MarkdownInterface $markdown, AdapterInterface $cache)
    {
        $comments = [
            'some random dymmy text',
        ];

        $articleContent = <<<EOF
                **th** isahjfhskhfkasjhdfkjashdfkjashdfksakdfhasjkhdfkashfkjshdfkjashfjkahsjkdfhjasf
                asdfasdfjalskfjlaksfjdklajflkasjdflkjaslkfjsajflkasjdfkljsdalkfjaslkfjlkasjdflakjsfdlkjasldfkja
                **sadfklaf** 
EOF;
        $item = $cache->getItem('markdown_'.md5($articleContent));

        if (!$item->isHit()) {
            $item->set($markdown->transform($articleContent));
            $cache->save($item);
        }

        return $this->render('articles/show.html.twig', [
            'comments' => $comments,
            'articleContent' => $item->get(),
            'slug' => $slug,
            'title' => 'Hello world',
        ]);
    }
}
