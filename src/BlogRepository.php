<?php
namespace ISA\Workshop;

use Doctrine\DBAL\Connection;

/**
 * Class BlogRepository
 * @package ISA\Workshop
 */
class BlogRepository
{

    /**
     * @var Connection
     */
    private $db;

    /**
     * BlogRepository constructor.
     * @param Connection $db
     */
    public function __construct(Connection $db)
    {
        $this->db = $db;
    }

    /**
     * @return array
     */
    public function loadPostCollection()
    {
        return $this->db->fetchAll('select * from posts');
    }

    /**
     * @return array
     */
    public function loadCollectionOfRecentPosts()
    {
        return $this->db->fetchAll('select * from posts ORDER BY created_at DESC');
    }

    /**
     * @return array
     */
    public function loadCollectionOfPopularPosts()
    {
        return $this->db->fetchAll('select * from posts ORDER BY visited DESC');
    }

    /**
     * @param int $postId
     * @return array
     */
    public function loadPostById(int $postId)
    {
        $result =  $this->db->fetchAssoc('SELECT * FROM posts WHERE id = :postId', ['postId' => $postId]);
        return $result === false ? [] : $result;
    }

}
