<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Ixudra\Curl\Facades\Curl;
use Iivannov\Larasquare\Facade\Larasquare;
use Illuminate\Support\Str;

class AjaxController extends Controller
{
	public function venues_categories()
    {
		$response   = Larasquare::request("venues/categories");
		$categories = $response->response->categories;
		
		$main_cat = array();
		$subs_cat = '';
		$i=0;
		foreach($categories as $kategoriler) {
			
			$m_slug = Str::slug($kategoriler->name, '-');
			
			$z=0;
			foreach($kategoriler->categories as $subcategories) {
				
				$s_name = '';
				if(isset($subcategories->name))
					$s_name = $subcategories->name;
				
				$s_slug = Str::slug($subcategories->name, '-');
				$subs_cat .= '<li><a href="/category/'.$s_slug.'">'.$s_name.'</a></li>';
				$z++;
			}
			
			$name = '';
			if(isset($kategoriler->name))
				$name = $kategoriler->name;
			
			$main_cat[] = '<div class="panel panel-primary">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a href="/category/'.$m_slug.'">'.$name.'</a>
					</h4>
				</div>
				<div class="panel-collapse collapse in">
					<div class="panel-body">
						<ul class="nav">
							'.$subs_cat.'
						</ul>
					</div>
				</div>
			</div>';
			$i++;
		}
		
		return response()->json(['categories' => $main_cat]);
    }
	
	public function venues_explore(Request $request)
    {
		$response = Larasquare::venues(['near' => config('CITY'), 'query' => $request->input('query')]);

		$explore_list = array();
		$i=0;
		foreach($response[0]->items as $explore) {
			
			$name = '';
			if(isset($explore->venue->name))
				$name = $explore->venue->name;
			
			$address = '';
			if(isset($explore->venue->location->address))
				$address = $explore->venue->location->address;
			
			$country = '';
			if(isset($explore->venue->location->country))
				$country = $explore->venue->location->country;
			
			$city = '';
			if(isset($explore->venue->location->city))
				$city = ', '.$explore->venue->location->city;
			
			$postalCode = '';
			if(isset($explore->venue->location->postalCode))
				$postalCode = ', '.$explore->venue->location->postalCode;
			
			$image = '';
			if(isset($explore->venue->categories[0]->icon->prefix) && isset($explore->venue->categories[0]->icon->suffix))
				$image = '<img src="'.$explore->venue->categories[0]->icon->prefix.'64'.$explore->venue->categories[0]->icon->suffix.'" class="grayscale">';

			$explore_list[] = '<div class="panel panel-default">
				<div class="panel-body">
					<h4 class="panel-title">
						<span class="venue_name" style="color:#337ab7">'.$image.'  '.$name.'</span>
						<p>'.$address.$city.$postalCode.'</p>
						<div class="geodir-category-location"><i class="fa fa-map-marker" aria-hidden="true"></i> <span>'.$country.'</span></div>
					</h4>
				</div>
			</div>';
			$i++;
		}
		
		return response()->json(['explore_list' => $explore_list]);
    }
	
	public function venues_maps($category_name)
    {
		if($category_name == 'all') 
		{
			$query = '';
		}
		else
		{
			$query = $category_name;
		}
		
		$response = Larasquare::venues(['near' => config('CITY'), 'query' => $query]);
		
		$features = array('type' => 'FeatureCollection');
		$i=0;
		foreach($response[0]->items as $explore) {
			
			$address = '';
			if(isset($explore->venue->location->address))
				$address = $explore->venue->location->address;
			
			$features['features'][] = array(
				'type' => "Feature",
				'geometry' => array(
					'type' => 'Point',
					'coordinates' => array($explore->venue->location->lat, $explore->venue->location->lng)
				),
				'properties'  => array('balloonContent' => '<b>'.$explore->venue->name.'</b><br />'.$address),
				'options'     => array('iconLayout' => 'default#image', 'iconImageHref' => '/images/marker.png', 'iconImageSize' => array(50, 50))
			);
			$i++;
		}
		
		return json_encode($features, JSON_PRETTY_PRINT);
    }
}
