<?php 

namespace app\models;

/**
 * Example Book model class
 */
class User
{
	/**
	 * @var string
	 */
	protected $facebook_id;

	/**
	 * @var string
	 */
	protected $name;

	/**
	 * Get user`s facebook_id
	 * @return string
	 */
	public function getFacebookId()
	{
		return $this->facebook_id;
	}

	/**
	 * Get user`s name
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}
}