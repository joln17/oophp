<?php
namespace Joln\Content;

/**
 * Class for ContentDB
 */
class ContentDB extends \Joln\BaseDB\BaseDB
{
    /** @var array $articleTypes    Article types */
    private $articleTypes = ['page', 'post'];

    /** @var array $articleFilters    Article filters */
    private $articleFilters = ['bbcode', 'link', 'markdown', 'nl2br'];



    /**
     * Constructor to create a Content database
     *
     * @param object $db       Anax Database object.
     * @param string $table    Table name.
     */
    public function __construct(\Anax\Database\Database $db, string $table = 'content')
    {
        parent::__construct($db, $table);
        $this->setColumns([
            'id',
            'title',
            'type',
            'path',
            'slug',
            'published',
            'created',
            'updated',
            'deleted'
        ]);
        $this->setSetupFile('../sql/content/setup.sql');
    }



    /**
     * Get article types
     *
     * @return array    Available article types.
     */
    public function getArticleTypes()
    {
        return $this->articleTypes;
    }



    /**
     * Get article filters
     *
     * @return array    Available article filters.
     */
    public function getArticleFilters()
    {
        return $this->articleFilters;
    }



    /**
     * Get all articles by type
     *
     * @param string $type    Type of articles to get
     *
     * @return mixed    Resultset.
     */
    public function getArticlesByType(string $type)
    {
        $sql = "SELECT *, ";
        $sql .= "CASE WHEN (deleted <= NOW()) THEN 'isDeleted' ";
        $sql .= "WHEN (published <= NOW()) THEN 'isPublished' ";
        $sql .= "ELSE 'notPublished' END AS status, ";
        $sql .= "DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%dT%TZ') AS published_iso8601, ";
        $sql .= "DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%d') AS published_date ";
        $sql .= "FROM {$this->table} WHERE type = ? ";
        $sql .= "ORDER BY published DESC, id DESC;";
        $res = $this->db->executeFetchAll($sql, [$type]) ?? null;

        if ($res) {
            $textFilter = new \Joln\Content\TextFilter();
            foreach ($res as $key => $row) {
                $res[$key]->data = $textFilter->parse($row->data, $row->filter);
            }
        }
        return $res;
    }



    /**
     * Get page
     *
     * @param string $path    Path of the page to get.
     *
     * @return mixed    Resultset.
     */
    public function getPage(string $path)
    {
        $sql = "SELECT *, CASE ";
        $sql .= "WHEN (deleted <= NOW()) THEN 'isDeleted' ";
        $sql .= "WHEN (published <= NOW()) THEN 'isPublished' ";
        $sql .= "ELSE 'notPublished' END AS status ";
        $sql .= "FROM {$this->table} WHERE path = ?;";
        $res = $this->db->executeFetch($sql, [$path]) ?? null;
        if ($res) {
            $textFilter = new \Joln\Content\TextFilter();
            $res->data = $textFilter->parse($res->data, $res->filter);
        }
        return $res;
    }



    /**
     * Get blogpost
     *
     * @param string $slug      Slug of the blogpost to get.
     *
     * @return mixed    Resultset.
     */
    public function getBlogpost(string $slug)
    {
        $sql = "SELECT *, ";
        $sql .= "CASE WHEN (deleted <= NOW()) THEN 'isDeleted' ";
        $sql .= "WHEN (published <= NOW()) THEN 'isPublished' ";
        $sql .= "ELSE 'notPublished' END AS status, ";
        $sql .= "DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%dT%TZ') AS published_iso8601, ";
        $sql .= "DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%d') AS published_date ";
        $sql .= "FROM {$this->table} WHERE slug = ?;";
        $res = $this->db->executeFetch($sql, [$slug]) ?? null;

        if ($res) {
            $textFilter = new \Joln\Content\TextFilter();
            $res->data = $textFilter->parse($res->data, $res->filter);
        }
        return $res;
    }



    /**
     * Get unique path
     *
     * @param string $path    Suggested path.
     * @param int $id         ID of the article.
     *
     * @return string||null    Unique path.
     */
    public function getUniquePath(?string $path, int $id, string $type)
    {
        if ($type == 'post') {
            return "blogpost_{$id}";
        }
        if (!$path) {
            return null;
        }
        $pathAndId = $path . '_' . $id;
        $sql = "SELECT IF(EXISTS (SELECT path FROM {$this->table} WHERE path = ? AND id != ?), ?, ?) AS path;";
        $res = $this->db->executeFetch($sql, [$path, $id, $pathAndId, $path]);
        return $res->path;
    }



    /**
     * Get unique slug
     *
     * @param string $str    Suggested slug string.
     * @param int $id        ID of the article.
     *
     * @return string    Unique slug.
     */
    public function getUniqueSlug(string $str, int $id = 0)
    {
        $str = mb_strtolower(trim($str));
        $str = str_replace(['å','ä','ö'], ['a','a','o'], $str);
        $str = preg_replace('/[^a-z0-9-_]/', '-', $str);
        $str = trim(preg_replace('/-+/', '-', $str), '-');

        $strAndId = $str . '_' . $id;
        $sql = "SELECT IF(EXISTS (SELECT slug FROM {$this->table} WHERE slug = ? AND id != ?), ?, ?) AS slug;";
        $res = $this->db->executeFetch($sql, [$str, $id, $strAndId, $str]);
        return $res->slug;
    }



    /**
     * Soft delete article by id
     *
     * @param int $id    ID of the article to delete.
     *
     * @return int    Number of rows updated.
     */
    public function softDeleteArticle(int $id)
    {
        $sql = "UPDATE {$this->table} SET deleted = NOW() WHERE id = ?;";
        $this->db->execute($sql, [$id]);
        return $this->db->rowCount();
    }
}
