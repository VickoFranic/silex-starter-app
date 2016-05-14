<?php 

namespace app\models;

use Silex\Application;
use app\repositories\PagesRepository;

/**
 * User model
 */
class UserPages
{
	/**
	 * @var string
	 */
	public $user_id;

	/**
	 * @var string
	 */
	public $page_id;

	/**
	 * @var string
	 */
	public $page_token;

	/**
	 * Get all Pages for given user_id
	 * 
	 * @param string $user_id
	 * @return array UserPages
	 */
	public static function findByUserId($user_id, Application $app)
	{
		return $app['repositories.pages']->findAllByUserId($user_id);
	}
}