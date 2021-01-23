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
}
