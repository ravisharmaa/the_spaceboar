<?php

namespace App\Controller;

use App\Services\MarkdownHelper;
use Nexy\Slack\Client;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{

    /**
     * @var bool
     */
    private $isDebug;
    /**
     * @var Client
     */
    private $slackClient;

    public function __construct(bool $isDebug, Client $slackClient)
    {

        $this->isDebug = $isDebug;
        $this->slackClient = $slackClient;
    }

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
     * @param MarkdownHelper $markdownHelper
     *
     * @param bool $isDebug
     * @param Client $slackClient
     * @return Response
     * @throws \Psr\Cache\InvalidArgumentException
     */
    public function show($slug, MarkdownHelper $markdownHelper)
    {
        //dd($this->slackClient->send('hello world'));

        $comments = [
            'some random dymmy text',
        ];

        $articleContent = <<<EOF
                **th** isahjfhskhfkasjhdfkjashdfkjashdfksakdfhasjkhdfkashfkjshdfkjashfjkahsjkdfhjasf
                asdfasdfjalskfjlaksfjdklajflkasjdflkjaslkfjsajflkasjdfkljsdalkfjaslkfjlkasjdflakjsfdlkjasldfkja
                **sadfklaf** 
EOF;

        return $this->render('articles/show.html.twig', [
            'comments' => $comments,
            'articleContent' => $markdownHelper->parse($articleContent),
            'slug' => $slug,
            'title' => 'Hello world',
        ]);
    }
}
