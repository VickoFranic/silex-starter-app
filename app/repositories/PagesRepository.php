<?php

namespace app\repositories;

use app\models\Page;
use Doctrine\DBAL\Connection;

/**
 * User Repository
 */
class PagesRepository
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
	 * Saves pages to database, for given user id
	 * 
	 * @param array $pages
	 * @param string $user_id
	 * @return bool
	 */
	public function save($pages, $user_id)
	{
		if (! $this->findAllByUser($user_id)) {
			foreach ($pages as $page) {
				$this->db->insert('pages', (array) $page); 
			}
			return true;
		}

		return false;
	}

	/**
	 * Update Pages data for given user_id
	 * 
	 * @param string $page_id
	 * @return bool
	 */
	public function update($pages, $user_id)
	{
		$data = $this->findAllByUser($user_id);

		if (! $data) {
			return false;
		}

		foreach ($pages as $page) {
			$this->db->update('pages', (array) $page, array('page_id' => $page->page_id));
		}

		return true;
	}

	/**
	 * Returns specific page data as array, matching given id
	 * 
	 * @param string $page_id
	 * @return array
	 */
	public function findPageById($page_id)
	{
		$sql = "SELECT * FROM pages WHERE page_id = ?";
		return $this->db->fetchAssoc($sql, [ $page_id ]);
	}

	/**
	 * Returns all pages for user from database
	 * 
	 * @return array | false
	 */
	public function findAllByUser($user_id)
	{
		$sql = "SELECT * FROM pages WHERE user_id = ?";
		return $this->db->fetchAll($sql, [ $user_id ]);
	}

}