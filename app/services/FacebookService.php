<?php

namespace app\services;
session_start();

use app\repositories\FacebookRepository;

class FacebookService
{
	/**
	 * app\respositories\FacebookRepository
	 */
	protected $fr;

	/**
	 * PagesService
	 */
	protected $us;


	/**
	 * PagesService
	 */
	protected $ps;

	function __construct( FacebookRepository $fr, UserService $us, PagesService $ps )
	{
		$this->fr = $fr;
		$this->us = $us;
		$this->ps = $ps;
	}

	/**
	 * Generate login url
	 * 
	 * @return string
	 */
	public function loginUrl()
	{
		return $this->fr->generateLoginUrl();
	}

	/**
	 * Fetches user from facebook and returns it.
	 * Returns false on error.
	 * 
	 * @return array | bool
	 */ 
	public function getUser()
	{
		$token = $this->fr->getUserAccessTokenFromRedirect()->getValue();
		$user = $this->fr->getUserDataFromFacebook($token);

		if (! $user) {
			return false;
		}

		$this->us->saveOrUpdateUser($user);

		return $user;
	}

	/**
	 * Fetches pages for user from facebook.
	 * Returns false if no pages found for user.
	 * 
	 * @return array | false
	 */
	public function getPagesForUser($user)
	{
		$pages = $this->fr->getUserPagesDataFromFacebook($user->facebook_id, $user->access_token);

		if(! $pages) {
			return false;
		}

		$this->ps->saveOrUpdatePagesForUser($pages, $user->facebook_id);

		return $pages;
	}
	
}