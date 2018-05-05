<?php
namespace Joln\MovieDB;

/**
 * Class for MovieDB
 */
class MovieDB
{
    /** @var object $db    Anax Database object */
    private $db;



    /**
     * Constructor to create a MovieDB
     *
     * @param object $db    Anax Database object.
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
     * Get selected rows from DB
     *
     * @param int $hits          Number of hits
     * @param int $page          Page number
     * @param string $orderby    Order by id, title, year or image
     * @param string $order      asc or desc order
     *
     * @return mixed    Resultset.
     */
    public function getMoviesPaginate(int $hits, int $page, string $orderBy, string $order)
    {
        $offset = $hits * ($page - 1);
        $columns = ['id', 'title', 'year', 'image'];
        $orders = ['asc', 'desc'];
        $res = null;

        if (in_array($orderBy, $columns) && in_array($order, $orders)) {
            $sql = "SELECT * FROM movie ORDER BY $orderBy $order LIMIT $hits OFFSET $offset;";
            $res = $this->db->executeFetchAll($sql);
        }

        return $res;
    }



    /**
     * Get movie by id
     *
     * @param int $movieId    The id of the movie to get from the DB
     *
     * @return mixed    Resultset.
     */
    public function getMovieById(int $movieId)
    {
        $sql = "SELECT * FROM movie WHERE id = ?;";
        $res = $this->db->executeFetchAll($sql, [$movieId]);
        $movie = $res[0] ?? null;
        return $movie;
    }



    /**
     * Get max number of pages
     *
     * @param int $hits    Number of hits
     *
     * @return int    Maximum number of pages.
     */
    public function getMaxPage(int $hits)
    {
        $sql = "SELECT COUNT(id) AS max FROM movie;";
        $max = $this->db->executeFetchAll($sql);
        $max = ceil($max[0]->max / $hits);
        return $max;
    }



    /**
     * Search for title in DB
     *
     * @param string $title    Search for movies with this title
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
     * @param int $year1    Search for movies released >= year1
     * @param int $year2    Search for movies released <= year2
     *
     * @return mixed    Resultset.
     */
    public function searchYear(?int $year1, ?int $year2)
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
     * @param string $title    The movie title to add
     * @param int $year        Release year of the movie
     * @param string $image    File name of the image
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
     * @param int $movieId    The id of the movie to delete from the DB
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
     * @param string $movieTitle    The updated title of the movie
     * @param int $movieYear        The updated release year of the movie
     * @param string $movieImage    The updated file name of the image
     * @param int $movieId          The id of the movie to update
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
        exec($command, $output, $status);
        $output = "<p>The command exit status was $status.<br>The output from the command was:</p><pre>"
            . print_r($output, 1);
        return $output;
    }



    /**
     * Check if login is valid
     *
     * @param string $user        User name to verify
     * @param string $password    Password to verify
     *
     * @return bool    True when login is verified.
     */
    public function verifyLogin(string $user, string $password)
    {
        $verified = false;
        if ($user && $password) {
            $sql = "SELECT * FROM movie_user WHERE user = ?;";
            $res = $this->db->executeFetchAll($sql, [$user]);
            if (isset($res[0]->password)) {
                $verified = password_verify($password, $res[0]->password);
            }
        }
        return $verified;
    }
}
