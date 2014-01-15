<?php

function pl_navigation( $args = array() ){
	
	if( ! isset( $args['menu'] ) || empty( $args['menu'] ) ){
		
		$out = sprintf('<ul class="inline-list pl-nav"><li class="popup-nav"><a class="menu-toggle mm-toggle"><i class="icon-reorder"></i></a></li></ul>');
		
	} else {
		
		$defaults = array(
			'menu_class'		=> 'inline-list pl-nav',
			'menu'				=> pl_setting( 'primary_navigation_menu' ),
			'container'			=> null,
			'container_class'	=> '',
			'depth'				=> 3,
			'fallback_cb'		=> '',
			'items_wrap'      	=> '<ul id="%1$s" class="%2$s">%3$s<li class="popup-nav"><a class="menu-toggle mm-toggle respond"><i class="icon-reorder"></i></a></li></ul>',
			'echo'				=> false,
			'pl_behavior'		=> 'standard'
		); 


		$args = wp_parse_args( $args, $defaults );
		
		$out = str_replace("\n","", wp_nav_menu( $args ));
		
	}
		
		

	
	return $out;

}


function pl_posts_404(){

	$head = __('Nothing Found', 'pagelines');

	$subhead = ( is_search() ) ? __('Try another search?', 'pagelines') : __("Sorry, what you are looking for isn't here.", 'pagelines');

	$the_text = sprintf('<h2 class="center">%s</h2><p class="subhead center">%s</p>', $head, $subhead);

	return sprintf( '<section class="billboard">%s <div class="center fix">%s</div></section>', apply_filters('pagelines_posts_404', $the_text), pagelines_search_form( false ));

}

function pl_get_core_header(){
	require_once( pl_get_template_directory() . '/header.php' );
}

function pl_get_core_footer(){
	require_once( pl_get_template_directory() . '/footer.php' );
}

// This file contains utilities for theme development and theme user experience

function pl_theme_info( $field ){
	$theme_info = wp_get_theme();
	return $theme_info->$field;
}


// Blog Sections & Post Utilities


function pl_post_avatar( $post_id, $size ){
	
	$author_name = get_the_author();
	$default_avatar = PL_IMAGES . '/avatar_default.gif';
	$author_desc = custom_trim_excerpt( get_the_author_meta('description', $p->post_author), 10);
	$author_email = get_the_author_meta('email', $p->post_author);
	$avatar = get_avatar( $author_email, '32' );
	
}

function pl_list_pages( $number = 6 ){

	$pages_out = '';

	$pages = wp_list_pages('echo=0&title_li=&sort_column=menu_order&depth=1');

	$pages_arr = explode("\n", $pages);
	
	for($i=0; $i < $number; $i++){

		if(isset($pages_arr[$i]))
			$pages_out .= $pages_arr[$i];

	}
	
	return $pages_out;
	
}

function pl_recent_posts( $number = 3 ){?>
	<ul class="media-list">
		<?php

		foreach( get_posts( array('numberposts' => $number ) ) as $p ){
			
			
			$img_src = (has_post_thumbnail( $p->ID )) ? pl_the_thumbnail_url( $p->ID, 'thumbnail') : pl_default_thumb();
		
			$img = sprintf('<div class="img"><a class="the-media" href="%s" style="background-image: url(%s)"></a></div>', get_permalink( $p->ID ), $img_src);

			printf(
				'<li class="media fix">%s<div class="bd"><a class="title" href="%s">%s</a><span class="excerpt">%s</span></div></li>',
				$img,
				get_permalink( $p->ID ),
				$p->post_title,
				pl_short_excerpt($p->ID)
			);

		} ?>
	</ul>
<?php }

function pl_popular_taxonomy( $number_of_categories = 6, $taxonomy = 'category' ){
	
	$args = array( 
		'number' 	=> $number_of_categories,
		'depth' 	=> 1, 
		'title_li' 	=> '', 
		'orderby' 	=> 'count', 
		'show_count' => 1, 
		'order' 	=> 'DESC',
		'taxonomy'	=> $taxonomy,
		'echo'		=> 0
	);
	
	return wp_list_categories( $args );

}

function pl_media_list( $title, $list ){
	
	return sprintf( '<ul class="media-list"><lh class="title">%s</lh>%s</ul>', $title, $list);
	
	
}

