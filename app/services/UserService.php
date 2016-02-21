<?php 

namespace app\services;

use app\models\User;
use app\repositories\UserRepository;

class UserService
{
	/**
	 * app\repositories\UserRepository
	 */
	protected $ur;

	function __construct( UserRepository $ur )
	{
		$this->ur = $ur;
	}

	/**
	 * Save user data and access token recieved from Facebook to DB. Update if user exists already.
	 * 
	 * @param User $data
	 * @return void
	 */
	public function saveOrUpdateUser(User $data)
	{
		$user = $this->ur->find($data->facebook_id);

		# Update user - refreshing access token
		if($user) {
			$this->ur->update($data);
		}
		# User not found - save it to DB
		$this->ur->save($data);
	}

}