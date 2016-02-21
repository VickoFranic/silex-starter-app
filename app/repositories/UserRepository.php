<?php

namespace app\repositories;

use app\models\User;
use Doctrine\DBAL\Connection;

/**
 * User Repository
 */
class UserRepository
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
	 * Saves User to database, if doesn`t exist already
	 * 
	 * @param User $user
	 * @return true | false
	 */
	public function save($user)
	{
		if ($this->find($user->facebook_id)) {
			return false;
		}
		return $this->db->insert('users', (array) $user);
	}

	/**
	 * Update User data
	 * @param User $user
	 * @return true | false 
	 */
	public function update($user)
	{
		if (! $this->find($user->facebook_id)) {
			return false;
		}
		return $this->db->update('users', (array) $user, array('facebook_id' => $user->facebook_id));
	}

	/**
	 * Returns specific user data as array, matching given id
	 * @param string $facebook_id
	 * @return array
	 */
	public function find($facebook_id)
	{
		$sql = "SELECT * FROM users WHERE facebook_id = ?";
		return $this->db->fetchAssoc($sql, [ $facebook_id ]);
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