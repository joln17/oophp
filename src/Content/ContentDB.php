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
        $this->setColumns(['id', 'title', 'type', 'path', 'slug', 'published', 'created', 'updated', 'deleted']);
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
}
