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
	
	public static function Administrator($id){

		if($id == '1'){
		return true;
		}
		else{
		return null;	
		}
	}
	public static function Subscriber($id){

		if($id == '3'){
		return true;
		}
		else{
		return null;	
		}
	}

	public static function Author($id){

		if($id == '2'){
		return true;
		}
		else{
		return null;	
		}
	}

	public static function PageOwner($user_id, $page_id){

		if($user_id == $page_id){
		return true;
		}
		else{
		return null;	
		}
	}

	public static function CantCreate($user){

	  
       if($user->canCreate() == 'false'){
		
		return true;
		
		}
		else
		{

		return false;	
		
		}
	}
	
}