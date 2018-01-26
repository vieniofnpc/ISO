<?php
namespace ISA\Workshop;

use Doctrine\DBAL\Connection;

/**
 * Class BlogController
 * @package ISA\Workshop
 */
class BlogController
{
    /**
     * @var Connection
     */
    private $db;
    /**
     * @var \Twig_Environment
     */
    private $twig;

    /**
     * BlogController constructor.
     * @param Connection $db
     * @param \Twig_Environment $twig
     */
    public function __construct(Connection $db, \Twig_Environment $twig)
    {
        $this->db = $db;
        $this->twig = $twig;
    }

    /**
     * @return string
     */
    public function showHomePage() : string
    {
        $recent = $this->loadRecentPosts();
        $popular = $this->loadPopularPosts();

        return $this->twig->render('index.twig', ['recent' => $recent, 'trending' => $popular]);
    }

    /**
     * @return string
     */
    public function showPostsCollection()
    {
        return $this->twig->render('post-collection.twig', ['posts' => $this->loadAllPosts()]);
    }

    /**
     * @param string $postId
     * @return string
     */
    public function showSinglePost(string $postId) : string
    {
        return $this->twig->render('single-post.twig', $this->loadSinglePost($postId));
    }

    /**
     * @return array
     */
    private function loadAllPosts()
    {
        return $this->db->fetchAll('select * from posts');
    }

    /**
     * @return array
     */
    private function loadRecentPosts()
    {
        return $this->db->fetchAll('select * from posts ORDER BY created_at DESC');
    }

    /**
     * @return array
     */
    public function loadPopularPosts()
    {
        return $this->db->fetchAll('select * from posts ORDER BY visited DESC');
    }

    /**
     * @param $postId
     * @return array|bool
     */
    private function loadSinglePost($postId)
    {
        return $this->db->fetchAssoc('SELECT * FROM posts WHERE id = :postId', ['postId' => $postId]);
    }
}
