<?php 

namespace app\services;

use app\models\Page;
use app\repositories\PagesRepository;

class PagesService
{
	/**
	 * app\repositories\PagesRepository
	 */
	protected $pr;

	function __construct( PagesRepository $pr )
	{
		$this->pr = $pr;
	}

	/**
	 * Save or update pages for user in DB
	 * 
	 * @param array $pages
	 * @param string $user_id
	 * @return void
	 */
	public function saveOrUpdatePagesForUser($pages, $user_id)
	{
		$data = $this->pr->findAllByUser($user_id);

		# Update pages for user - refreshing page tokens
		if($data) {
			$this->pr->update($pages, $user_id);
		}
		# Pages not found - save it to DB
		$this->pr->save($pages, $user_id);
	}

	/**
	 * Return array of Page models for given user
	 * 
	 * @param app\models\User
	 * @return array
	 */
	public function getPagesForUser($user)
	{
		if (is_object($user)) {
			return $this->pr->findAllByUserId($user->facebook_id);			
		}
		
		return $this->pr->findAllByUserId($user['facebook_id']);
	}

}