<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Flickr_model extends CI_Model {

	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
		
    }
	
	public function getRecentphotos() 
	{	
		#
		# build the API URL to call
		#

		$params = array(
			'api_key'	=> '3bd4375728949f7d689ae85c5072b83a',
			'method'	=> 'flickr.photos.getRecent',
			'format'	=> 'php_serial',
			'per_page' => '5'
		);

		$encoded_params = array();

		foreach ($params as $k => $v){

			$encoded_params[] = urlencode($k).'='.urlencode($v);
		}

		#
		# call the API and decode the response
		#

		$url = "https://api.flickr.com/services/rest/?".implode('&', $encoded_params);

		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_URL, $url); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$rsp = curl_exec($ch); 
		curl_close($ch);

		$rsp_obj = unserialize($rsp);
		
		if (!empty($rsp_obj['photos']['photo'])){
			foreach ($rsp_obj['photos']['photo'] as $photo_key => $photo_val) {
				$sizesphotos = $this->getSizesphotos($params['api_key'], $photo_val['id']);
				$rsp_obj['photos']['photo'][$photo_key]['Sizesphotos'] = $sizesphotos;		
			}
		}
		
		if($rsp_obj['stat'] == "ok"){
			return $rsp_obj['photos']['photo'];
		} else {	
			return "API Error";
		}
	}
	
	
	public function getSizesphotos($api_key, $photo_id) 
	{
		$params = array(
			'api_key'	=> $api_key,
			'method'	=> 'flickr.photos.getSizes',
			'format'	=> 'php_serial',
			'photo_id' => $photo_id
		);

		$encoded_params = array();

		foreach ($params as $k => $v){

			$encoded_params[] = urlencode($k).'='.urlencode($v);
		}

		#
		# call the API and decode the response
		#

		$url = "https://api.flickr.com/services/rest/?".implode('&', $encoded_params);

		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_URL, $url); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$rsp = curl_exec($ch); 
		curl_close($ch);

		$rsp_obj = unserialize($rsp);
		
		if($rsp_obj['stat'] == "ok"){
			return $rsp_obj['sizes']['size'];
		} else {	
			return "API Error";
		}
	}
}