<?php
namespace Joln\MovieDB;

/**
 * Class for MovieDB
 */
class MovieDB
{
    /** @var object $db    anax\database */
    private $db;



    /**
     * Constructor to create a MovieDB
     *
     * @param object $db    anax\database.
     */
    public function __construct(\Anax\Database\Database $db)
    {
        $this->db = $db;
        $this->db->connect();
    }



    /**
     * Get all rows from DB
     *
     * @return mixed    Resultset.
     */
    public function getAllMovies()
    {
        $sql = "SELECT * FROM movie;";
        $res = $this->db->executeFetchAll($sql);
        return $res;
    }



    /**
     * Get movie by id
     *
     * @return mixed    Resultset.
     */
    public function getMovieById(int $movieId)
    {
        $sql = "SELECT * FROM movie WHERE id = ?;";
        $res = $this->db->executeFetchAll($sql, [$movieId]);
        return $res[0];
    }



    /**
     * Search for title in DB
     *
     * @return mixed    Resultset.
     */
    public function searchTitle(string $title)
    {
        $res = null;
        if ($title) {
            $sql = "SELECT * FROM movie WHERE title LIKE ?;";
            $res = $this->db->executeFetchAll($sql, [$title]);
        }
        return $res;
    }



    /**
     * Search for years in DB
     *
     * @return mixed    Resultset.
     */
    public function searchYear(int $year1, int $year2)
    {
        $res = null;
        if ($year1 && $year2) {
            $sql = "SELECT * FROM movie WHERE year >= ? AND year <= ?;";
            $res = $this->db->executeFetchAll($sql, [$year1, $year2]);
        } elseif ($year1) {
            $sql = "SELECT * FROM movie WHERE year >= ?;";
            $res = $this->db->executeFetchAll($sql, [$year1]);
        } elseif ($year2) {
            $sql = "SELECT * FROM movie WHERE year <= ?;";
            $res = $this->db->executeFetchAll($sql, [$year2]);
        }
        return $res;
    }



    /**
     * Add new title to DB
     *
     * @return int    ID of added movie.
     */
    public function addMovie(string $title = "A title", int $year = 2018, string $image = "noimage.png")
    {
        $sql = "INSERT INTO movie (title, year, image) VALUES (?, ?, ?);";
        $this->db->execute($sql, [$title, $year, $image]);
        $movieId = $this->db->lastInsertId();
        return $movieId;
    }



    /**
     * Delete title from DB
     *
     * @return int    rows deleted.
     */
    public function deleteMovie(int $movieId)
    {
        $sql = "DELETE FROM movie WHERE id = ?;";
        $this->db->execute($sql, [$movieId]);
        return $this->db->rowCount();
    }



    /**
     * Update title in DB
     *
     * @return int    rows affected.
     */
    public function updateMovie(string $movieTitle, int $movieYear, string $movieImage, int $movieId)
    {
        $sql = "UPDATE movie SET title = ?, year = ?, image = ? WHERE id = ?;";
        $this->db->execute($sql, [$movieTitle, $movieYear, $movieImage, $movieId]);
        return $this->db->rowCount();
    }



    /**
     * Restore the database to its original settings
     *
     * @return string    Output from exec MySQL command.
     */
    public function reset()
    {
        $file = '../sql/movie/setup.sql';
        $mysql = '/usr/bin/mysql';
        $output = null;

        $dsn = $this->db->getConfig('dsn');
        $dsnDetail = [];
        preg_match('/mysql:host=(.+?);(?:port=(\d+);)?dbname=([^;.]+)/', $dsn, $dsnDetail, PREG_UNMATCHED_AS_NULL);
        $host = $dsnDetail[1];
        $port = $dsnDetail[2] ?? 3306;
        $database = $dsnDetail[3];
        $login = $this->db->getConfig('username');
        $password = $this->db->getConfig('password');

        $command = "$mysql -h {$host} -P {$port} -u {$login} -p{$password} $database < $file 2>&1";
        $output = [];
        $status = null;
        $res = exec($command, $output, $status);
        $output = "<p>The command was: <code>$command</code>.<br>The command exit status was $status."
            . "<br>The output from the command was:</p><pre>"
            . print_r($output, 1);
        return $output;
    }



    /**
     * Check if login is valid
     *
     * @return bool    True when login is verified.
     */
    public function verifyLogin(string $user, string $password)
    {
        if ($user && $password) {
            $sql = "SELECT * FROM movie_user WHERE user = ?;";
            $res = $this->db->executeFetchAll($sql, [$user]);
            $hash = $res[0]->password ?? null;
            $verified = password_verify($password, $hash) ? true : false;
        }
        return $verified;
    }
}
