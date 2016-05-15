<?php

namespace app\services;

// Had to set it up this way, beacuse of Silex session provider
if(! isset($_SESSION))
{ 
	session_start(); 
} 

use app\models\UserPages;
use app\repositories\FacebookRepository;
use Facebook\GraphNodes\GraphNode;

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
	 * Generate login / request early access url
	 * 
	 * @return string
	 */
	public function loginUrl()
	{
		return $this->fr->generateLoginUrl();
	}

	/**
	 * Fetches user from facebook, saves it to db and returns it.
	 * Returns false on error.
	 * 
	 * @return array | bool
	 */ 
	public function getUser()
	{
		$token = $this->fr->getUserAccessTokenFromRedirect();

		if (! $token) {
			return false;
		}

		$user = $this->fr->getUserDataFromFacebook($token->getValue());

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
	 * @param User
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

	public function getEventsForPageId($page_id)
	{
		$events = $this->fr->getPageEventsFromFacebook($page_id);

		return $events;
	}

	public function getLatestNotificationForPages($user_id, $pages)
	{
		$notifications = [];
		foreach ($pages as $page) {
			$tmp = $this->fr->getPageNotificationsFromFacebook($user_id, $page);

			if ($tmp) {
				$notifications[] = $tmp;
			}
		}

		return $notifications;
	}
	
}