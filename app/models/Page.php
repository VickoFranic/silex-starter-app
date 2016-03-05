<?php 

namespace app\models;

/**
 * Page model
 */
class Page
{
	/**
	 * @var string
	 */
	public $page_id;

	/**
	 * @var string
	 */
	public $user_id;

	/**
	 * @var string
	 */
	public $name;

	/**
	 * @var string
	 */
	public $about;	

	/**
	 * @var string
	 */
	public $genre;

	/**
	 * @var int
	 */
	public $likes;

	/**
	 * @var string
	 */
	public $page_token;
}