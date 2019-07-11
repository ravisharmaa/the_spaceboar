<?php

namespace App\Controller;

use App\Services\MarkdownHelper;
use App\Services\SlackService;
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
     * @var SlackService
     */
    private $slackService;

    public function __construct(bool $isDebug, SlackService $slackService)
    {
        $this->isDebug = $isDebug;
        $this->slackService = $slackService;
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
     * @return Response
     *
     * @throws \Http\Client\Exception
     * @throws \Psr\Cache\InvalidArgumentException
     */
    public function show($slug, MarkdownHelper $markdownHelper)
    {
        //dd($this->slackService->sendMessage('John','Hello'));

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
