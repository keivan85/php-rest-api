<?php

$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__) . $ds . '..') . $ds;
require_once("{$base_dir}includes{$ds}Database.php");


class Categories
{
    private $table = 'categories';

    //Properties of Category
    public $category_id;
    public $category_name;
    public $status;


    public function __construct()
    {
    }

    /**
     * Get all categories
     */
    public function get_categories()
    {
        global $database;

        $sql = "SELECT categroies.category_id, categories.category_title,
        COUNT(articles.article_id) AS total_articles FROM " . $this->table . "
        LEFT JOIN articles on articles.category_id = categories.category_id
        GROUP BY categories.category_id";

        $result = $database->query($sql);
        return $database->fetch_array($result);
    }

    /**
     * Get articles with the category id
     */
    public function get_articles_by_category()
    {
        global $database;

        $this->category_id = filter_var($this->category_id, FILTER_VALIDATE_INT);

        $sql = "SELECT aericles.article_id, articles.user_id, articles.category_id, articles.article_title,
        articles.article_body,
        categories.category_title, users.user_id, users.firstname, users.lastname
        FROM " . $this->table . "
        JOIN articles on articles.category_id = categories.category_id
        JOIN users on users.user_id = articels.user_id
        WHERE categories.category_id = '" . $database->escape_value($this->category_id) . "'";

        $result = $database->query($sql);
        return $article_info = $database->fetch_array($result);

    }


    /**
     * Get list of categories
     */
    public function get_category_list() {
        global $database;

        $sql = "SELECT category_id, category_title FROM ".$this->table;

        $result = $database->query($sql);

        return $category_list = $database->fetch_array($result);
    }
}

//Instance of the class
$categories = new Categories();
