<?php

namespace app\repositories;

use app\models\Book;
use Doctrine\DBAL\Connection;

/**
 * Example Book repository class
 */
class BookRepository implements RepositoryInterface
{
	/**
	 * @var \Doctrine\DBAL\Connection
	 */
	protected $db;

	public function __construct( Connection $db )
	{
		$this->db = $db;
	}

	/**
	 * Saves Book to database
	 * @param array $book
	 * @return true | false 
	 */
	public function save($book)
	{
		return $this->db->insert('books', $book);
	}

	/**
	 * Returns object data as array, matching given id
	 * @param integer $id
	 * @return array
	 */
	public function find($id)
	{
		$sql = "SELECT * FROM books WHERE id = ?";

		return $this->db->fetchAssoc($sql, [ $id ]);
	}

	/**
	 * Returns all books from database
	 * @return array
	 */
	public function findAll()
	{
		$sql = "SELECT * FROM books";
		return $this->db->fetchAll($sql);
	}

}