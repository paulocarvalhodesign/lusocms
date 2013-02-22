<?php


/**
 *Luso CMS - Next generation CMS
 *
 * @package  Luso CMS
 * @author   Paulo Carvalho <pauloworkmail@gmail.com>
 * @link     http://paulocarvalhodesign.com
 * 
 */

 
class Dashboard_Controller extends Base_Controller {

	/**
	 * Catch-all method for requests that can't be matched.
	 *
	 * @param  string    $method
	 * @param  array     $parameters
	 * @return Response
	 */
	

	


	public function __call($method, $parameters)
	{
		return Response::error('404');
	}


	
	/**
	 * Define global settings.
	 */


	public function __construct(){

	
		
		
	}
	
}