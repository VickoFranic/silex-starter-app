<?php 

namespace app\repositories;

use Silex\Application;
use Facebook\Facebook;
use app\models\User;
use app\models\Page;
use app\services\UserService;

/**
* FacebookRepository is helper class used for fetching data from Facebook
* It doesn`t fetch data from application DB, only from Facebook API
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

	/**
	 * array $config
	 */
	private $config;

	/**
	 * app\services\UserService
	 */
	protected $us;

	/**
	 * app\repositories\PagesRepository
	 */
	protected $pr;

	/**
	 * Silex\Application
	 */
	protected $app;

	function __construct( Facebook $fb, array $config, UserService $us, PagesRepository $pr, Application $app )
	{
		$this->fb = $fb;
		$this->helper = $this->fb->getRedirectLoginHelper();
		$this->config = $config;
		$this->us = $us;
		$this->pr = $pr;
		$this->app = $app;
	}

	/**
	 * Generate login url with given permissions and callback url
	 * 
	 * @return string
	 */
	public function generateLoginUrl()
	{
		$perms = ['manage_pages'];
		$callback = $this->config['domain'].'/login';
		
		return $this->helper->getLoginUrl($callback, $perms);
	}

	/**
	 * Get user access token from redirect
	 * 
	 * @return string
	 */
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
			$response = $this->fb->get('/me?fields=id,name,picture', $token)->getGraphUser();
		} catch (Exception $e) {
			// Write to log or something
			echo $e->getMessage();
		}

		$user = new User();
		$user->facebook_id = $response->getId();
		$user->name = $response->getName();
		$user->picture = $response->getPicture()['url'];
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

				try {
				/**
				 * Facebook\GraphNodes\GraphEdge
				 */
				$pageData = $this->fb->get('/'.$page->getField('id').'?fields=name,picture.type(large),genre,likes', $page->getField('access_token'))
									 ->getGraphNode();

				} catch (Exception $e) {
					// Write to log or something
					echo $e->getMessage();
				}

				$tmp->page_id = $pageData->getField('id');
				$tmp->user_id = $user_id;
				$tmp->name = $pageData->getField('name');
				$tmp->picture = $pageData->getField('picture')['url'];
				$tmp->genre = $pageData->getField('genre');
				$tmp->likes = $pageData->getField('likes');
				$tmp->page_token = $page->getField('access_token');			
				
				$res[] = $tmp;
			}
		}

		return $res;
	}

	/**
	 * Get events for Facebook page
	 * 
	 * @param string $page_id
	 * @return array | bool
	 */
	public function getPageEventsFromFacebook($page_id)
	{
		$user = $this->us->getCurrentUser($this->app);
		$user_page = $this->pr->PageBelongsToUser($user->facebook_id, $page_id);

		try {
			/**
			 * Facebook\GraphNodes\GraphEdge
			 */
			$response = $this->fb->get('/'.$page_id.'/events', $user_page['page_token'])->getGraphEdge();

		} catch (Exception $e) {
			// Write to log or something
			echo $e->getMessage();
		}

		if(! $response) {
			return false;
		}

		return $response;
	}


	/**
	 * Get notifications for Facebook page
	 * 
	 * @param string $user_id
	 * @param Page $page
	 * @return array | bool
	 */
	public function getPageNotificationsFromFacebook($user_id, Page $page)
	{
		$token = $this->pr->getTokenForUserIdAndPageId($user_id, $page->page_id);

		try {
			/**
			 * Facebook\GraphNodes\GraphEdge
			 */
			$response = $this->fb->get('/'.$page->page_id.'?fields=notifications.limit(1){created_time,title,from}', $token)->getGraphObject();

		} catch (Exception $e) {
			// Write to log or something
			echo $e->getMessage();
		}

		if(! $response->getField('notifications') ) {
			return false;
		}

		$notificationObject = $response->getField('notifications');

		$res = [];
		foreach ($notificationObject as $data) {
			$res['page'] = $page->name;
			$res['created_time'] = $data['created_time']->format('Y-m-d H:i:s');
			$res['title'] = $data['title'];
		}

		return $res;
	}

}