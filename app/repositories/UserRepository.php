<?php

namespace app\repositories;

use app\models\User;
use Doctrine\DBAL\Connection;

/**
 * User Repository
 */
class UserRepository implements RepositoryInterface
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
	 * Saves User to database
	 * @param array $user
	 * @return true | false 
	 */
	public function save($user)
	{
		return $this->db->insert('users', $user);
	}

	/**
	 * Returns specific user data as array, matching given id
	 * @param integer $id
	 * @return array
	 */
	public function find($facebook_id)
	{
		$sql = "SELECT * FROM users WHERE facebook_id = ?";

		return $this->db->fetchAssoc($sql, [ $id ]);
	}

	/**
	 * Returns all users from database
	 * @return array
	 */
	public function findAll()
	{
		$sql = "SELECT * FROM users";
		return $this->db->fetchAll($sql);
	}

}