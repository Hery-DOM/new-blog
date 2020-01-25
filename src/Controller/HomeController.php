<?php


namespace App\Controller;


use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */

    public function home(CategoryRepository $categoryRepository)
    {
        // get every categories
        $categories = $categoryRepository->findAll();

        return $this->render('home.html.twig',[
            'categories' => $categories
        ]);
    }

    /**
     * @Route("/category/", name="category_redirect")
     * To redirect if wild card don't exist
     */
    public function category_redirect()
    {
        return $this->redirectToRoute('home');
    }

    /**
     * @Route("/category/{cat}", name="category")
     * show every articles according with category selected on homepage
     * Note : cat is category's ID
     */

    public function every_articles($cat, ArticleRepository $articleRepository)
    {
        // get articles for category selected
        $articles = $articleRepository->findBy(['category' => $cat]);

        return $this->render('category.html.twig',[
            'articles' => $articles
        ]);
    }

    /**
     * @Route("/article/", name="article_redirect")
     * To redirect if wild card don't exist
     */
    public function article_redirect()
    {
        return $this->redirectToRoute('home');
    }

    /**
     * @Route("/article/{id}", name="article")
     * To show an article
     */
    public function article($id, ArticleRepository $articleRepository)
    {
        // get article
        $article = $articleRepository->find($id);

        return $this->render('article.html.twig',[
            'article' => $article
        ]);
    }

}