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
				$this->db->insert('pages', array( 'page_id' => $page->page_id, 
											 	  'name'	=> $page->name,
											 	  'picture' => $page->picture,
											 	  'genre' 	=> $page->genre, 
											 	  'likes'	=> $page->likes ) 
												);


				$this->db->insert('user_pages', array( 'user_id' 	=> $page->user_id, 
													   'page_id'	=> $page->page_id, 
													   'page_token'	=> $page->page_token )
													);
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
			$this->db->update('pages', 
							   array( 'page_id' 	=> $page->page_id, 
							 	      'name'		=> $page->name,
									  'picture' => $page->picture,							 	     
							 	      'genre' 	=> $page->genre, 
							 	      'likes'	=> $page->likes),

							   array('page_id' => $page->page_id)
							);

			$this->db->update('user_pages', 
							   array( 'user_id'		=> $page->user_id, 
							   		  'page_id'		=> $page->page_id, 
							   		  'page_token'	=> $page->page_token), 

							   array('user_id' => $page->user_id, 
							   		 'page_id' => $page->page_id)
				);
		}

		return true;
	}

	/**
	 * Returns specific page data as array, matching given id
	 * 
	 * @param string $page_id
	 * @return Page | false
	 */
	public function findPageById($page_id)
	{
		$sql = "SELECT * FROM pages WHERE page_id = ?";
		$res = $this->db->fetchAssoc($sql, [ $page_id ]);

		if (! $res) {
			return false;
		}

		$page = new Page();

		$page->page_id = $res['page_id'];
		$page->name = $res['name'];
		$page->picture = $res['picture'];
		$page->genre = $res['genre'];
		$page->likes = $res['likes'];

		return $page;
	}


	/**
	 * Returns true if given page belongs to given user
	 * 
	 * @param string $page_id
	 * @param string $user_id
	 * @return bool
	 */
	public function pageBelongsToUser($user_id, $page_id)
	{
		$sql = "SELECT * FROM user_pages WHERE user_id = ? AND page_id = ?";
		return $this->db->fetchAll($sql, [ $user_id, $page_id ]);
	}

	/**
	 * Returns all pages for user from database
	 * 
	 * @return array | false
	 */
	public function findAllByUser($user_id)
	{
		$sql = "SELECT * FROM user_pages WHERE user_id = ?";
		$pages = $this->db->fetchAll($sql, [ $user_id ]);

		$res = [];
		foreach ($pages as $page)
			$res[] = $this->findPageById($page['page_id']);

		return $res;
	}

}