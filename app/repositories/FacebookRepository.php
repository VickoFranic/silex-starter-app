<?php 

namespace app\repositories;

use Facebook\Facebook;
use app\models\User;
use app\models\Page;

/**
* FacebookRepository is helper class used for fetching data from Facebook
* It doesn`t work with application DB, only with Facebook API
*/
class FacebookRepository
{
	/**
	 * Facebook\Facebook
	 */
	protected $fb;

	/**
	 * Facebook\Helpers\FacebookRedirectLoginHelper
	 */
	protected $helper;

	function __construct( Facebook $fb )
	{
		$this->fb = $fb;
		$this->helper = $this->fb->getRedirectLoginHelper();
	}

	/**
	 * Generate login url with given permissions and callback url
	 * 
	 * @return string
	 */
	public function generateLoginUrl()
	{
		$perms = ['manage_pages'];
		$callback = 'http://bandmanager.dev/login';

		return $this->helper->getLoginUrl($callback, $perms);
	}

	public function getUserAccessTokenFromRedirect()
	{
		try {
			$accessToken = $this->helper->getAccessToken();
		} catch (Exception $e) {
			// Write to log or something
			echo $e->getMessage();
		}
		return $accessToken;
	}

	/**
	 * Get user facebook ID and name from FB Graph, using given token
	 * 
	 * @param string $token
	 * @return User $user
	 */
	public function getUserDataFromFacebook($token)
	{
		try {
			/**
			 * Facebook\GraphNodes\GraphUser
			 */
			$response = $this->fb->get('/me', $token)->getGraphUser();
		} catch (Exception $e) {
			// Write to log or something
			echo $e->getMessage();
		}

		$user = new User();
		$user->facebook_id = $response->getId();
		$user->name = $response->getName();
		$user->access_token = $token;

		return $user;
	}

	/**
	 * Get user pages from Facebook. Returns pages from category Musician/Band
	 * 
	 * @param string $user_id
	 * @param string $token
	 * @return array | bool
	 */
	public function getUserPagesDataFromFacebook($user_id, $token)
	{
		$res = [];

		try {
			/**
			 * Facebook\GraphNodes\GraphEdge
			 */
			$response = $this->fb->get('/me/accounts', $token)->getGraphEdge();
		} catch (Exception $e) {
			// Write to log or something
			echo $e->getMessage();
		}

		if(! $response) {
			return false;
		}

		foreach ($response as $page) {
			if ($page->getField('category') == 'Musician/Band') {
				$tmp = new Page();

				$tmp->page_id = $page->getField('id');
				$tmp->user_id = $user_id;
				$tmp->name = $page->getField('name');
				$tmp->page_token = $page->getField('access_token');							
				
				$res[] = $tmp; 
			}
		}

		return $res;
	}

	public function getPageEventsFromFacebook($page)
	{
		$res = [];

		try {
			/**
			 * Facebook\GraphNodes\GraphEdge
			 */
			$response = $this->fb->get('/'.$page['page_id'].'/events', $page['page_token'])->getGraphEdge();
		} catch (Exception $e) {
			// Write to log or something
			echo $e->getMessage();
		}

		if(! $response) {
			return false;
		}

		return $response;
	}

}