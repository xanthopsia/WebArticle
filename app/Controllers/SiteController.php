<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Article;
use Twig\Environment;
use Carbon\Carbon;

class SiteController
{
    private Environment $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    public function index()
    {
        $articles = [
            new Article('Title 1', 'Article desc 1', 1),
            new Article('Title 2', 'Article desc 2', 2),
            new Article('Title 3', 'Article desc 3', 3)
        ];

        $currentTime = Carbon::now();
        $template = $this->twig->load('index.twig');

        return $template->render(['articles' => $articles, 'currentTime' => $currentTime]);
    }

    public function article($vars)
    {
        $id = $vars['id'];
        $articles = [
            1 => new Article(
                'Article 1',
                'Article desc1',
                1),
            2 => new Article(
                'Article 2',
                'Article desc2',
                2),
            3 => new Article('Title 3', 'Article desc', 3)
        ];

        if (isset($articles[$id])) {
            $article = $articles[$id];
            $template = $this->twig->load('article.twig');
            return $template->render(['article' => $article]);
        } else {
            return 'Article not found';
        }
    }
}
