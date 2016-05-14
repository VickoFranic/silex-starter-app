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

	public function findByAccessToken($token)
	{
		$sql = "SELECT * FROM users WHERE access_token = ?";
		$res = $this->db->fetchAssoc($sql, [ $token ]);

		if ($res) {
			$user = new User();
			$user->facebook_id = $res['facebook_id'];
			$user->name = $res['name'];
			$user->picture = $res['picture'];
			$user->access_token = $res['access_token'];
		
			return $user;
		}
	}

	/**
	 * Returns all users from database
	 * @return array
	 */
	public function findAll()
	{
		$sql = "SELECT * FROM users";
		$res = $this->db->fetchAll($sql);

		$users = [];
		if ($res) {
			foreach ($res as $us) {
				$user = new User();
				$user->facebook_id = $us['facebook_id'];
				$user->name = $us['name'];
				$user->picture = $us['picture'];
				$user->access_token = $us['access_token'];
				
				$users[] = $user;
			}
		}

		return $users;
	}

}