<?php
namespace ISA\Workshop;

/**
 * Class BlogController
 * @package ISA\Workshop
 */
class BlogController
{
    /**
     * @var \Twig_Environment
     */
    private $twig;
    /**
     * @var BlogRepository
     */
    private $blogRepository;

    /**
     * BlogController constructor.
     * @param BlogRepository $blogRepository
     * @param \Twig_Environment $twig
     */
    public function __construct(BlogRepository $blogRepository, \Twig_Environment $twig)
    {
        $this->twig = $twig;
        $this->blogRepository = $blogRepository;
    }

    /**
     * @return string
     */
    public function showHomePage() : string
    {
        $recent = $this->blogRepository->loadCollectionOfRecentPosts();
        $popular = $this->blogRepository->loadCollectionOfPopularPosts();

        return $this->twig->render('index.twig', ['recent' => $recent, 'trending' => $popular]);
    }

    /**
     * @return string
     */
    public function showPostsCollection()
    {
        return $this->twig->render('post-collection.twig', ['posts' => $this->blogRepository->loadPostCollection()]);
    }

    /**
     * @param string $postId
     * @return string
     */
    public function showSinglePost(string $postId) : string
    {
        return $this->twig->render('single-post.twig', $this->blogRepository->loadPostById($postId), $this->blogRepository->updateVisitForPost($postId));
    }

    /**
     * return About page
     */

    public function showAbout ()
    {
        return $this->twig->render('about.twig');
    }

    /**
     * return Gallery page
     */

    public function  showGallery ()
    {
        return $this->twig->render('gallery.twig');
    }




}
