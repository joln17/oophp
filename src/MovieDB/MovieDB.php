<?php
namespace Joln\MovieDB;

/**
 * Class for MovieDB
 */
class MovieDB extends \Joln\BaseDB\BaseDB
{
    /**
     * Constructor to create a MovieDB
     *
     * @param object $db       Anax Database object.
     * @param string $table    Table name.
     */
    public function __construct(\Anax\Database\Database $db, string $table = 'movie')
    {
        parent::__construct($db, $table);
        $this->setColumns(['id', 'title', 'year', 'image']);
        $this->setSetupFile('../sql/movie/setup.sql');
    }



    /**
     * Search for years in DB
     *
     * @param int $year1    Search for movies released >= year1
     * @param int $year2    Search for movies released <= year2
     *
     * @return mixed    Resultset.
     */
    public function searchYear(?int $year1, ?int $year2)
    {
        $res = null;
        if ($year1 && $year2) {
            $sql = "SELECT * FROM {$this->table} WHERE year >= ? AND year <= ?;";
            $res = $this->db->executeFetchAll($sql, [$year1, $year2]);
        } elseif ($year1) {
            $sql = "SELECT * FROM {$this->table} WHERE year >= ?;";
            $res = $this->db->executeFetchAll($sql, [$year1]);
        } elseif ($year2) {
            $sql = "SELECT * FROM {$this->table} WHERE year <= ?;";
            $res = $this->db->executeFetchAll($sql, [$year2]);
        }
        return $res;
    }



    /**
     * Add new row to DB
     *
     * @param array $data    The data to add
     *
     * @return int    ID of added row.
     */
    public function addRow(array $data = [])
    {
        if (!$data) {
            $data = [
                'title' => "A title",
                'year'  => 2018,
                'image' => "noimage.png"
            ];
        }
        return parent::addRow($data);
    }
}
