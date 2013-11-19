<?php


class PageLinesRegions {

	function __construct(){



		$this->url = PL_PARENT_URL . '/editor';
	}


	function region_start( $region ){

		$region_name = strtoupper($region);

		if($region == 'header' || $region == 'footer'){

			$region_title = sprintf(__('Global Region', 'pagelines'), $region_name);

		} else {
			$region_title = sprintf(__('Local Region', 'pagelines'), $region_name);
		}

		printf(
			'<div class="pl-region-bar area-tag"><a class="btn-region" title="%s">%s</a></div>',
			$region_title,
			$region_name
		);

	}
	



}