<?php
/**
 *Luso CMS - Next generation CMS
 *
 * @package  Luso CMS
 * @version  0.0.1
 * @author   Paulo Carvalho <pauloworkmail@gmail.com>
 * @link     http://paulocarvalhodesign.com
 * 
 */
class Permitions 
{
	
	public static function Administrator(){

		if(User::isAdministrator()){
		return true;
		}
		else{
		return false;	
		}
	}

	public static function Subscriber(){

		if(user::isSubscriber()){
		return true;
		}
		else{
		return false;	
		}
	}

	public static function Author(){

		if(user::isAuthor()){
		return true;
		}
		else{
		return false;	
		}
	}

	public static function PageOwner(){
		$page_id = Config::get('owner');
 		$user = Auth::user();
		if($user->id == $page_id){
		return true;
		}
		else{
		return null;	
		}
	}

	public static function CantCreate(){

	  
       if(user::canCreate() == 'false'){
		
		return true;
		
		}
		else
		{

		return false;	
		
		}
	}
	
}