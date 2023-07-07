<?php

//enqueueing styles ans css
function aavishkaar_enqueue_style() {

   

        wp_enqueue_style( 'bootstrap-css', get_template_directory_uri() .'/css/bootstrap.min.css', array(), '', 'all' );
        wp_enqueue_style( 'style-css', get_template_directory_uri() .'/css/style.css', array(), '', 'all' );
        wp_enqueue_style( 'slick-css', get_template_directory_uri() .'/css/slick.css', array(), '', 'all' );
        
        
        wp_enqueue_style( 'default-css', get_template_directory_uri() .'/style.css', array(), '', 'all' );

    

    
}


function aavishkaar_enqueue_script() { 

   

        
    wp_enqueue_script( 'jquery-js', get_template_directory_uri() .'/js/jquery-3.4.1.min.js', array(), '', true );
    wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() .'/js/bootstrap.min.js', array(), '', true );
    wp_enqueue_script( 'custom-js', get_template_directory_uri() .'/js/custom.js', array(), '', true );

    wp_enqueue_script( 'slick-min-js', get_template_directory_uri() .'/js/slick.min.js', array(), '', true );
    if(!is_page(array('home','portfolio','news-videos'))){

   // wp_enqueue_script( 'default-js', get_template_directory_uri() .'/js/default.js', array(), '', true );
    }

    if(is_page('home')){

   // wp_enqueue_script( 'slick-js', get_template_directory_uri() .'/js/slick.js', array(), '', true );
    wp_enqueue_script( 'scrollmagic-js', get_template_directory_uri() .'/js/ScrollMagic.min.js', array(), '', true );

    
        wp_enqueue_script( 'home-js', get_template_directory_uri() .'/js/home.js', array(), '', true );
    }

    if(is_page('about')){
        wp_enqueue_script( 'about-js', get_template_directory_uri() .'/js/about.js', array(), '', true );
        wp_enqueue_script( 'custom-js', get_template_directory_uri() .'/js/custom.js', array(), '', true );
    }

    if(is_page('portfolio')){
        wp_enqueue_script( 'portfolio-js', get_template_directory_uri() .'/js/portfolio.js', array(), '', true );
    }
    if(is_page('news-videos')){
        wp_enqueue_script( 'insights-js', get_template_directory_uri() .'/js/insights.js', array(), '', true );
    }

    
    
   
}




add_action( 'wp_enqueue_scripts', 'aavishkaar_enqueue_style' );
add_action( 'wp_enqueue_scripts', 'aavishkaar_enqueue_script' );


//////////////////////////////////////////////////////////////////

/*creates new theme location for menu*/
register_nav_menus( array(

    //'top_menu' => __( 'Top Menu',      'web' ),
    'main_menu' => __( 'Main Menu',      'web' ),
    'footer_menu' => __( 'Footer Menu',      'web' ),

  ) );

/////////////////////////////////////////////////////////////////


/*manage logo from backend*/
function aavishkaar_theme_customizer( $wp_customize ) {
    // Fun code will go here
     $wp_customize->add_section( 'aavishkaar_logo_section' , array(
    'title'       => __( 'Logo', 'aavishkaar' ),
    'priority'    => 30,
    'description' => 'Upload a logo for default showing on header menu before the scroll event',
) );
$wp_customize->add_setting( 'aavishkaar_logo' );

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'aavishkaar_logo', array(
    'label'    => __( 'Logo', 'aavishkaar' ),
    'section'  => 'aavishkaar_logo_section',
    'settings' => 'aavishkaar_logo',
) ) );
}

add_action( 'customize_register', 'aavishkaar_theme_customizer' );

// manage footer logo

function aavishkaar_theme_customizer1( $wp_customize1 ) {
    // Fun code will go here
     $wp_customize1->add_section( 'aavishkaar_footer_logo_section' , array(
    'title'       => __( 'Footer Logo', 'aavishkaar' ),
    'priority'    => 30,
    'description' => 'Upload a logo for default showing on header menu before the scroll event',
) );
$wp_customize1->add_setting( 'aavishkaar_footer_logo' );

$wp_customize1->add_control( new WP_Customize_Image_Control( $wp_customize1, 'aavishkaar_footer_logo', array(
    'label'    => __( 'Footer Logo', 'aavishkaar' ),
    'section'  => 'aavishkaar_footer_logo_section',
    'settings' => 'aavishkaar_footer_logo',
) ) );
}

add_action( 'customize_register', 'aavishkaar_theme_customizer1' );



//adding custom options in the general section of admin panel
add_action( 'admin_init', 'aavishkaar_settings_api_init' );
function aavishkaar_settings_api_init() {
    // Add the section to general settings so we can add our
     // fields to it
    add_settings_section(
          'email_link_setting_section',
          '',
          '',
          'general'
     );

    

    add_settings_section(
          'fb_link_setting_section',
          '',
          '',
          'general'
     );
    add_settings_section(
          'twitter_link_setting_section',
          '',
          '',
          'general'
     );
    add_settings_section(
          'linkedin_link_setting_section',
          '',
          '',
          'general'
     );
    
    



    add_settings_field(
         'aavishkaar_fb_link',
         'Facebook',
         'aavishkaar_fb_link_setting_callback_function',
         'general',
         'fb_link_setting_section'
     );
    add_settings_field(
         'aavishkaar_twitter_link',
         'Twitter',
         'aavishkaar_twitter_link_setting_callback_function',
         'general',
         'twitter_link_setting_section'
     );
    add_settings_field(
         'aavishkaar_linkedin_link',
         'Linkedin',
         'aavishkaar_linkedin_link_setting_callback_function',
         'general',
         'linkedin_link_setting_section'
     );
    
    add_settings_field(
         'aavishkaar_email_link',
         'Email',
         'aavishkaar_email_link_setting_callback_function',
         'general',
         'email_link_setting_section'
     );
    

    register_setting( 'general', 'aavishkaar_fb_link' );
    register_setting( 'general', 'aavishkaar_twitter_link' );
    register_setting( 'general', 'aavishkaar_linkedin_link' );
    register_setting( 'general', 'aavishkaar_email_link' );
}

/*callback functions*/

function aavishkaar_fb_link_setting_callback_function() {
     echo '<input name="aavishkaar_fb_link" id="aavishkaar_fb_link" type="text" value="'.get_option( 'aavishkaar_fb_link' ).'" style="width:30%;">';
}
function aavishkaar_twitter_link_setting_callback_function() {
     echo '<input name="aavishkaar_twitter_link" id="aavishkaar_twitter_link" type="text" value="'.get_option( 'aavishkaar_twitter_link' ).'" style="width:30%;">';
}
function aavishkaar_linkedin_link_setting_callback_function() {
     echo '<input name="aavishkaar_linkedin_link" id="aavishkaar_linkedin_link" type="text" value="'.get_option( 'aavishkaar_linkedin_link' ).'" style="width:30%;">';
}

function aavishkaar_email_link_setting_callback_function() {
     echo '<input name="aavishkaar_email_link" id="aavishkaar_email_link" type="text" value="'.get_option( 'aavishkaar_email_link' ).'" style="width:30%;">';
}

////////////////////////////////////////////////////////////

// change admin logo to aavishkaar  logo

function my_login_logo() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/aavishkaar-logo.png);
    height:65px;
    width:320px;
    /*background-size: 100px 65px;*/
    background-repeat: no-repeat;
          padding-bottom: 30px;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );    



////////////////////////////////////////////////////////////
//
//// adding widgets
add_action( 'widgets_init', 'aavishkaar_custom_sidebars' );
/*Custom widgets*/
function aavishkaar_custom_sidebars(){
//     register_sidebar(
//           array (
//                'name'          =>  __( 'Footer Widget1', 'Aavishkaar' ),
//                'id'            =>  'footer-widget1',
//                'description'   =>  __( 'First footer menu', 'Aavishkaar' ),
//                'before_widget' =>  '<div class="col-md-2 col-3 footer-pd_0">',
//                'after_widget'  =>  "</div>",
              


//         )
//     );

    register_sidebar(
          array (
               'name'          =>  __( 'FooterLink1', 'Aavishkaar' ),
               'id'            =>  'footer-link1',
               'description'   =>  __( 'Footer Link menu', 'Aavishkaar' ),
               'before_widget' =>  '<div class="col-md-2  footer-pd_0 widget_ul footerlink1">',
               'after_widget'  =>  "</div>",
               

        )
    );
    register_sidebar(
          array (
               'name'          =>  __( 'FooterLink2', 'Aavishkaar' ),
               'id'            =>  'footer-link2',
               'description'   =>  __( 'Footer Link menu', 'Aavishkaar' ),
               'before_widget' =>  '<div class="col-md-2   widget_ul footerlink2">',
               'after_widget'  =>  "</div>",
               

        )
    );
    register_sidebar(
          array (
               'name'          =>  __( 'FooterLink3', 'Aavishkaar' ),
               'id'            =>  'footer-link3',
               'description'   =>  __( 'Footer Link menu', 'Aavishkaar' ),
               'before_widget' =>  '<div class="col-md-2  widget_ul footerlink3">',
               'after_widget'  =>  "</div>",
               

        )
    );
	
	register_sidebar(
          array (
               'name'          =>  __( 'FooterLink4', 'Aavishkaar' ),
               'id'            =>  'footer-link4',
               'description'   =>  __( 'Footer Link menu', 'Aavishkaar' ),
               'before_widget' =>  '<div class="col-md-2   widget_ul csr_wrpr footerlink4">',
               'after_widget'  =>  "</div>",
               

        )
    );


}

// function for enabling svg options in customizer page

function cc_mime_types( $mimes ){
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter( 'upload_mimes', 'cc_mime_types' );


// functions for getting name of the post types

function news_get_post_type_slug( $type_val ){

    $get_post_type_obj = get_post_type_object( $type_val );
    $name_post_type = $get_post_type_obj->label;

    return $name_post_type;
}



// single article post navigation slider

add_action( 'wp_ajax_single_nav_post_action', 'single_nav_post_action' );
add_action( 'wp_ajax_nopriv_single_nav_post_action', 'single_nav_post_action' );
function single_nav_post_action() {

     $post_id = $_POST['post_id'];
     $func = $_POST['func'];
	 $featured = $_POST['featured'];
     

     // starting the contents


         
     $get_post_obj = get_post($post_id);
          

     $get_article_banner = get_the_post_thumbnail_url( $get_post_obj->ID );
     //$article_title = get_the_title($get_post_obj->ID);
     // converts &#8217; to apostrophe
	 $article_title = str_replace("&#8217;", "’", get_the_title($get_post_obj->ID)); 
     $article_slug = $get_post_obj->post_name;
     $article_content =  str_replace("&#8217;", "’", $get_post_obj->post_content);
     $get_parent_type = news_get_post_type_slug($get_post_obj->post_type);
     $article_author = get_post_meta( $get_post_obj->ID,'wpcf-article-author', true );
     $article_publication = get_post_meta( $get_post_obj->ID,'wpcf-article-publication', true );
     $article_date = get_the_date('d M Y',$get_post_obj->ID);
     
     $parent_slug = $get_post_obj->post_type;
    // $article_permalink = get_the_permalink($get_post_obj->ID);

     



	

     // founds the next and prev of future results
     if( $featured == "true"){
		 $news_insights_args = array(
                'post_type'   => $parent_slug,
                'post_status' => 'publish',
                'numberposts' => -1,
                'orderby'     =>'date',
                'order'       =>'DESC',
			    
      
          );
	 }
	 else{
		 $news_insights_args = array(
                'post_type'   => $parent_slug,
                'post_status' => 'publish',
                'numberposts' => -1,
                'orderby'     =>'date',
                'order'       =>'DESC',
			    'meta_key'    => 'wpcf-featured-article',
     			'meta_value'  => 0,
      
          );
	 }
          
     $news_insights_results = get_posts( $news_insights_args );

      

     if( $news_insights_results ){

          // get IDs of posts retrieved from get_posts
          $article_ids = array();
          
          foreach ( $news_insights_results as $news_insights_result ) {
              $article_ids[] = $news_insights_result->ID;


              
          }

          // get and echo previous and next post in the same category
          $thisindex = array_search( (int)$post_id, $article_ids );
          //$thisindex = 1;
          $previd    = isset( $article_ids[ $thisindex - 1 ] ) ? $article_ids[ $thisindex - 1 ] : 0;
          $nextid    = isset( $article_ids[ $thisindex + 1 ] ) ? $article_ids[ $thisindex + 1 ] : 0;


     

          }
     

     
     print_r(json_encode(array('article_title'=>$article_title,'article_banner'=>$get_article_banner,'article_content'=>$article_content,'article_author'=>$article_author,'article_publication'=>$article_publication,'article_date'=>$article_date,'parent_type'=>$get_parent_type,'parent_type_slug'=>$parent_slug,'article_name'=>$article_slug,'prev_id'=>$previd,'next_id'=>$nextid)));

     wp_die();
}

// bootpag pagination - news

add_action( 'wp_ajax_pagination_news_more_action', 'pagination_news_more_action' );
add_action( 'wp_ajax_nopriv_pagination_news_more_action', 'pagination_news_more_action' );
function pagination_news_more_action() {

     $pagin_offset = $_POST['pagin_offset'];
     $pagin_ppp = $_POST['pagin_ppp'];
     $pagin_pt = $_POST['pagin_pt'];
	 $sort_param = $_POST['sort'];
     
 	if( $sort_param == "Latest" || $sort_param == "Select" || $sort_param == "All"){
		$sort = "DESC";
	}
	else{
		$sort = "ASC";
	}

     $pagin_offset_next = $pagin_offset+$pagin_ppp;
	
			$news_articles_args1 = array(
                     'post_type'   => $pagin_pt,
                     'post_status' => 'publish',
                     'numberposts' => $pagin_ppp,
                     'orderby'     =>'date',
                     'order'       => $sort,
                     'offset'      =>$pagin_offset_next,
                     'meta_key'    => 'wpcf-featured-article',
     				 'meta_value'  => 0,
                 );
     $news_articles__next_results = get_posts( $news_articles_args1 );

     $news_articles_args2 = array(
                     'post_type'   => $pagin_pt,
                     'post_status' => 'publish',
                     'numberposts' => $pagin_ppp,
                     'orderby'     =>'date',
                     'order'       => $sort,
                     'offset'      =>$pagin_offset,
                 	 'meta_key'    => 'wpcf-featured-article',
     				 'meta_value'  => 0,
                 );
     $news_results  = get_posts( $news_articles_args2 );
	
	
     

     if($news_results){

          foreach( $news_results  as $news_result ){

               $article_featured_img = get_the_post_thumbnail_url( $news_result->ID );
			   $article_author = get_post_meta( $news_result->ID,'wpcf-article-author', true );
			   $article_publication = get_post_meta( $news_result->ID,'wpcf-article-publication', true );
			   $artcle_date = get_the_date('d M Y',$news_result->ID);
			   $article_permalink = get_the_permalink($news_result->ID);
        		
			  if( $article_publication ){ 
				  $publication = $article_publication; 
			  }
			  else{
				  $publication = "";
			  }
			  
			  // page titles - reduces the length
			   $trimmed_news_title = wp_trim_words( $news_result->post_title, 10, '...' );
			   $article_news_title = $trimmed_news_title;
			  
			  // article date
			  if( $article_author ){ 
				 $pub_date = $article_author.' / '.$artcle_date;
		      }
			  else{
				 $pub_date = $artcle_date;
			  }
			  
			  
			  
			 
				
               /*content starts here*/
               $rslt_nws_data.= '<div class="col-md-4 news_single p-d-55 news_single" onclick="location.href='."'".$article_permalink."'".'">
								<div class="nws_card">
									<div class="nws_img">
										<img src="'.$article_featured_img.'" alt="'.$news_articles_result->post_title.'">
									</div>
									<div class="nws_cnt">
										<h5>'.$publication.'</h5>
										<h6>'.$article_news_title.'</h6>
										<p>'.$pub_date.'</p>
										<a href="'.get_the_permalink( $news_result->ID ).'" class="readon-first">Read on</a>
									</div>
								</div>
							</div>';

               /*content ends here*/

               /*Checking if next offset posts are exists or not*/
               if(!$news_articles__next_results){
                    $view_less_status = "false";
               }
               else{
                    $view_less_status = "true";
               }

          }

     }
     else{
          $rslt_nws_data = "The site is experiencing technical issues. please contact your sire admin...";
     }



  
    print_r(json_encode(array("view_data"=>$rslt_nws_data,"view_status"=>$view_less_status)));
  
    wp_die();
}

// bootpag - video
// 
add_action( 'wp_ajax_pagination_video_more_action', 'pagination_video_more_action' );
add_action( 'wp_ajax_nopriv_pagination_video_more_action', 'pagination_video_more_action' );
function pagination_video_more_action() {

     $pagin_offset = $_POST['pagin_offset'];
     $pagin_ppp = $_POST['pagin_ppp'];
     $pagin_pt = $_POST['pagin_pt'];


     $pagin_offset_next = $pagin_offset+$pagin_ppp;
	
	
		// for video
		$news_articles_args1 = array(
                     'post_type'   => $pagin_pt,
                     'post_status' => 'publish',
                     'numberposts' => $pagin_ppp,
                     'orderby'     =>'date',
                     'order'       =>'DESC',
                     'offset'      =>$pagin_offset_next,
                     
                 );
     $news_articles__next_results = get_posts( $news_articles_args1 );

     $news_articles_args2 = array(
                     'post_type'   => $pagin_pt,
                     'post_status' => 'publish',
                     'numberposts' => $pagin_ppp,
                     'orderby'     =>'date',
                     'order'       =>'DESC',
                     'offset'      =>$pagin_offset,
                 	 
                 );
     $news_results  = get_posts( $news_articles_args2 );
		
	
     

     if($news_results){

          foreach( $news_results  as $news_result ){

               $article_vid = get_the_post_thumbnail_url($news_result->ID);
			   $artcle_vdate = get_the_date('d M Y',$news_result->ID);	
			   $vidurl=$news_result->post_content;
			   $video_url_str = "'".$vidurl."'";
			   $trimmed_video_title = wp_trim_words( $news_result->post_title, 10, '...' );
			  
			   $videxturl = $news_result->post_excerpt;
			  
			   if(!empty($videxturl)){
				   $video_read_more_data = '<a href="'.$videxturl.'" target="_blank" class="readon-second">Read more</a>';
			   }
			   else{
				   $video_read_more_data = '';
			   }
			  
				
               /*content starts here*/
               $rslt_nws_data.= '<div class="col-md-4 video_single">
						<div class="nws_card">
						  <div class="nws_img">
						  <a href="javascript:void(0)" class="readon-first" onclick="showModal('.$video_url_str.')"> <img src="'.$article_vid.'" alt="'.$news_result->post_title.'"></a>
						  </div>
						  <div class="nws_cnt">
						  <h6 onclick="showModal('.$video_url_str.')">'.$trimmed_video_title.'</h6>
						 
							<a href="javascript:void(0)"  class="readon-first" onclick="showModal('.$video_url_str.')">Watch now</a>
                            '.$video_read_more_data.'
						  </div>
						</div>
					  </div>';

               /*content ends here*/

               /*Checking if next offset posts are exists or not*/
               if(!$news_articles__next_results){
                    $view_less_status = "false";
               }
               else{
                    $view_less_status = "true";
               }

          }

     }
     else{
          $rslt_nws_data = "The site is experiencing technical issues. please contact your sire admin...";
     }



  
    print_r(json_encode(array("view_data"=>$rslt_nws_data,"view_status"=>$view_less_status)));
  
    wp_die();
}



// portfolio - filtration with search results
add_action( 'wp_ajax_portfolio_filtration', 'portfolio_filtration' );
add_action( 'wp_ajax_nopriv_portfolio_filtration', 'portfolio_filtration' );
function portfolio_filtration() {
	
	$type = $_POST['type'];
	$geography = $_POST['geography'];
	$sector = $_POST['sector'];
	$ftype = $_POST['ftype'];
	$folio_serach = $_POST['folio_search'];
	if($type == 1){
		
		if( $geography == "All"){
			
			$portfolio_args = array(
					  'post_type'   => 'portfolio-companies',
					  'post_status' => 'publish',
					  'numberposts' => -1,
					  'orderby'     =>'title',
					  'order'       =>'ASC',
					);
		}
		else{
			
			$portfolio_args = array(
					  'post_type'   => 'portfolio-companies',
					  'post_status' => 'publish',
					  'numberposts' => -1,
					  'orderby'     =>'title',
					  'order'       =>'ASC',
		              'meta_key'    => 'wpcf-geography',
					  'meta_value'  => $geography,
		             //  's'          => $folio_serach
					);
			
		}
		
	}
	else if($type == 2){
		
		 if( $sector == "All"){
			 $portfolio_args = array(
					  'post_type'   => 'portfolio-companies',
					  'post_status' => 'publish',
					  'numberposts' => -1,
					  'orderby'     =>'title',
					  'order'       =>'ASC',
		              
					  

					);
		 }
		 else{
			 $portfolio_args = array(
					  'post_type'   => 'portfolio-companies',
					  'post_status' => 'publish',
					  'numberposts' => -1,
					  'orderby'     =>'title',
					  'order'       =>'ASC',
		              'meta_key'    => 'wpcf-sector',
					  'meta_value'  => $sector,
		             //  's'          => $folio_serach
					  

					);
			
		 }
		  
		
	}
	else if($type == 3){
		
		 if( $ftype == "All"){
			 $portfolio_args = array(
					  'post_type'   => 'portfolio-companies',
					  'post_status' => 'publish',
					  'numberposts' => -1,
					  'orderby'     =>'title',
					  'order'       =>'ASC',
					);
		 }
		 else{
			 $portfolio_args = array(
					  'post_type'   => 'portfolio-companies',
					  'post_status' => 'publish',
					  'numberposts' => -1,
					  'orderby'     =>'title',
					  'order'       =>'ASC',
		              'meta_key'    => 'wpcf-sector',
					  'meta_value'  => $ftype,
		             //  's'          => $folio_serach
					  

					);
			
		 }
		  
		
	}
	else{
		if( $geography == "All" && $sector == "All" && $ftype == "All" ){
			
			$portfolio_args = array(
					  'post_type'   => 'portfolio-companies',
					  'post_status' => 'publish',
					  'numberposts' => -1,
					  'orderby'     =>'title',
					  'order'       =>'ASC',
			          

					);
		}
		else if( $geography != "All" && $sector == "All" && $ftype == "ALL" ){
			
			$portfolio_args = array(
					  'post_type'   => 'portfolio-companies',
					  'post_status' => 'publish',
					  'numberposts' => -1,
					  'orderby'     =>'title',
					  'order'       =>'ASC',
			          'meta_key'    => 'wpcf-geography',
					  'meta_value'  => $geography,
		              
					  

					);
			
		}
		else if( $geography == "All" && $sector != "All" && $ftype == "All"  ){
			
			$portfolio_args = array(
					  'post_type'   => 'portfolio-companies',
					  'post_status' => 'publish',
					  'numberposts' => -1,
					  'orderby'     =>'title',
					  'order'       =>'ASC',
			          'meta_key'    => 'wpcf-sector',
					  'meta_value'  => $sector,
		              
					  

					);
			
		}
        else if( $geography == "All" && $sector == "All" && $ftype != "All" ){
			
			$portfolio_args = array(
					  'post_type'   => 'portfolio-companies',
					  'post_status' => 'publish',
					  'numberposts' => -1,
					  'orderby'     =>'title',
					  'order'       =>'ASC',
			          'meta_key'    => 'wpcf-sector',
					  'meta_value'  => $ftype,
		              
					  

					);
			
		}
		else{	
			$portfolio_args = array(
					  'post_type'   => 'portfolio-companies',
					  'post_status' => 'publish',
					  'numberposts' => -1,
					  'orderby'     =>'title',
					  'order'       =>'ASC',
			          'meta_query' => array(
						   array(
								'key'   => 'wpcf-geography',
								'value' => $geography,
							),
							array(
								'key'   => 'wpcf-sector',
								'value' => $sector,
                            ), 
                            array(
                                'key' => 'wpcf-sector',
                                'value' => $ftype,
                            )
						)
		              
					  

					);
			
		}
		
	}
	
	$portfolio_results = get_posts( $portfolio_args );
	
	if( $portfolio_results ){
		
			$portfolio_counter = 1; 
            foreach( $portfolio_results as $portfolio_slides_result ){
				
				$slider_val = get_post_meta($portfolio_slides_result->ID,'slider_val',true);
				
				$get_geography = get_post_meta( $portfolio_slides_result->ID,'wpcf-geography',true );
               $get_sector = get_post_meta( $portfolio_slides_result->ID,'wpcf-sector',true );	
			   $portfolio_exited = get_post_meta( $portfolio_slides_result->ID,'wpcf-exited',true );
				//echo $portfolio_exited;
				if(empty($portfolio_exited)){
					  $dark_portfolio_logo = get_the_post_thumbnail_url( $portfolio_slides_result->ID );
					  $featured_img= get_post_meta( $portfolio_slides_result->ID,'wpcf-featured-image-popup',true );
					  $enterpreneur = get_post_meta( $portfolio_slides_result->ID,'wpcf-enterpreneur',true );
					  $enterpreneur_linkedin = get_post_meta( $portfolio_slides_result->ID,'wpcf-enterpreneur-linkedin',true );
					  $headquarters = get_post_meta( $portfolio_slides_result->ID,'wpcf-headquarters',true );
					  $status = get_post_meta( $portfolio_slides_result->ID,'wpcf-status',true );
					  $website = get_post_meta( $portfolio_slides_result->ID,'wpcf-website',true );
					  $portfolio_content = $portfolio_slides_result->post_content;
					  // if( $portfolio_counter == 1){ $active_class = "active";} else{ $active_class = "";}
					  if( $portfolio_content ){ 
						  
						    $portfolio_content = wpautop($portfolio_content); 
						   
						    if($featured_img ){ 
								$featured_img = '<img src="'.$featured_img.'" alt="'.$portfolio_slides_result->post_title.' - Featured">';
							 }
						    else{
							  $featured_img =" ";
						    }
						  
						   if( $enterpreneur || $enterpreneur_linkedin || $headquarters || $status || $website ){
                          		$logo_detail = '<div class="logo-detail">
                              				<ul>';
								if( $enterpreneur || $enterpreneur_linkedin ){
									$logo_detail.='<li>';
									if( $enterpreneur ){
										 $logo_detail.='<h6>Entrepreneur(s)</h6><h5>'.$enterpreneur.'</h5>';

									} 
                                   if( $enterpreneur_linkedin ){
                                      $logo_detail.='<a href="'.$enterpreneur_linkedin.'" target="_blank"><img src="'.get_template_directory_uri().'/images/linked-in.png"></a>';
                                   } 
                                  $logo_detail.='</li>';
                                } 
                                if( $headquarters ){ 
                                   $logo_detail.='<li>
                                   <h6>Headquarters</h6>
                                   <h5>'.$headquarters.'</h5>
                                	</li>';
                                } 
                             
                               if( $website ){ 
                                   $logo_detail.='<li>
                                      <h6>Website</h6>
                                      <h5><a href="'.$website.'" target="_blank">'.$website.'</a></h5>
                                  </li>';
                               } 
							   $logo_detail.= '</ul>
							                   </div>';
                              
                              
                            
                          }
						  if( empty($enterpreneur) && empty($enterpreneur_linkedin) && empty($headquarters) && empty($status) && empty($website) ){
							  $logo_detail="";
						  }
						  
						  
							$rslt_folio_data.= '<div class="carousel-item '.$active_class.' carousel-item-'.$slider_val.' '.$get_geography.' '.$get_sector.' '.$portfolio_exited.'">
													<div class="container">
														<div class="row">
														   <div class="col-md-7">
														   		<div class="logo-ontent hide-mobile">
																	 <div class="logo-pop-img"><img src="'.$dark_portfolio_logo.'" alt="'.$portfolio_slides_result->post_title.'"></div>
																	 '.$portfolio_content.'
																	 '.$featured_img.'
																</div>
																<div class="logo-ontent hide-desk">
																   <img src="'.$dark_portfolio_logo.'" alt="'.$portfolio_slides_result->post_title.'">
																   <div class="modal-mobile-img">
                            											'.$featured_img.'
																	</div>
																	'.$portfolio_content.'
																</div>
																
														   </div>
														   <div class="col-md-5">
														   		'.$logo_detail.'
														   </div>
														</div>
													</div>
							                  </div>';
                       } 
					
				}
					
			$portfolio_counter++;  } // ends foreach
		   $rslt_folio_data.= "<script>$('#demo .modal-slider .carousel-item:nth-child(1)').addClass('active');</script>";
	}
	
	 
	

     
 

  
    print_r($rslt_folio_data);
  
    wp_die();
}

// team - filtration with search results
add_action( 'wp_ajax_team_filtration', 'team_filtration' );
add_action( 'wp_ajax_nopriv_team_filtration', 'team_filtration' );
function team_filtration() {
	
	$type = $_POST['type'];
	$team_term = $_POST['team_term'];
	
	// adds status for query for all param and another for renmaining
	if( $team_term == "All"){
		$team_status = 1;
	}
	else{
		$team_status = 0;
	}
	
	if( $team_term == "Emerging Asia"){
		$team_term = "Emerging-Asia";
	}
	else if( $team_term == "Africa" ){
		$team_term = "Africa";
	}
	else {
		
	}
	
	
		if( $team_status == 1){
			$team_args = array(
                'post_type'   => $type,
                'post_status' => 'publish',
                'numberposts' => -1,
                'orderby'     =>'title',
                'order'       =>'ASC',
			    
              );
		}
		else{
			$team_args = array(
                'post_type'   => $type,
                'post_status' => 'publish',
                'numberposts' => -1,
                'orderby'     =>'title',
                'order'       =>'ASC',
			    'meta_key'   => 'wpcf-team-geography',
				'meta_value' => $team_term,
              );
		}
		
		
	
	
	$team_results = get_posts( $team_args );
	
	if( $team_results ){
		$count_rslts = count($team_results);
		$team_counter = 1;
		foreach( $team_results as $team_result ){
			
			$investment_team_image = get_the_post_thumbnail_url( $team_result->ID );
			$team_linkedin = get_post_meta( $team_result->ID,'wpcf-team-linkedin',true );
			$team_email = get_post_meta( $team_result->ID,'wpcf-team-email',true );
			$team_group = $team_result->post_type;
			// get post type name 
			$group_name = get_post_type_object($team_group);
			$team_excerpt = $team_result->post_excerpt;
			$team_location = get_post_meta( $team_result->ID,'wpcf-team-location',true );
			$get_team_slider_val = get_post_meta( $team_result->ID,'team_slider_val',true );
			if( $team_linkedin || $team_email ){
				$team_social = '<ul class="pro-social">';		  
                          
                 if( $team_linkedin ){
					 
					 $team_social.='<li><a href="'.$team_linkedin.'" target="_blank"> <img src="'.get_template_directory_uri().'/images/linkdin-icon.png" alt=""> </a></li>';
					              
                 } 
				if( $team_email ){
                    $team_social.='<li><a href="mailto:'.$team_email.'" target="_blank"> <img src="'.get_template_directory_uri().'/images/mail_icon.png" alt=""> </a></li>';          
                } 
                $team_social.='</ul>';         
						 
              }
			  if(empty($team_linkedin) && empty($team_email)){
				  $team_social ="";
			  }
			
			   // logo detail
			   if( $team_excerpt || $team_location || $team_location ){
				 $logo_detail = '<div class="logo-detail">
				                   <ul>';		   
							   
				if( $team_excerpt ){
				  $logo_detail.='<li>
									<h6>Job title</h6>
									<h5>'.$team_excerpt.'</h5>
								  </li>';			
				 } 
				 if($team_location){
                        $logo_detail.='<li>
                                   <h6>Location</h6>
                                   <h5>'.$team_location.'</h5>
                                </li>';        
				 }
				 $logo_detail.='<li>
                                   <h6>Team</h6>
                                   <h5>'.$group_name->label.'</h5>
                                </li>';
                  $logo_detail.="</ul>
						  </div>" ;             
                              
				 }
			     if( empty($team_excerpt) && empty($team_location) && empty($team_location) ){
					 $logo_detail='';
				 }
			
			$team_data_wrpr.= '<div class="carousel-item carousel-item-'.$get_team_slider_val.'">
			                        <div class="row">
									     <div class="col-md-6 mem-detail-img">
										 
										 	<div class="member_pop-img"><img src="'.$investment_team_image.'" class="img-responsive" alt="'.$team_result->post_title.'">
										 </div>
										 </div>
										 <div class="col-md-6">
										 	<div class="mem-detail-content">
												<h3>'.$team_result->post_title.'</h3>
												'.$team_social.'
												'.$logo_detail.'
											</div>
										 </div>
									</div>
			                   </div>';
			

		$team_counter++; }
		$team_data_wrpr. "<script>$('#member-detail .carousel-item:nth-child(1)').addClass('active');</script>";
	}
	
	
    print_r(json_encode(array('team_data'=>$team_data_wrpr,'type_tab'=>$type,'count_team'=>$count_rslts)));
  
    wp_die();
}


// function for adding active slider val on team tabs

function add_team_slider_active(){
	
	$team_args = array(
                'post_type'   => array('investments-team','operation-team','advisors'),
                'post_status' => 'publish',
                'numberposts' => -1,
                'orderby'     =>'title',
                'order'       =>'ASC'
              );

        $team_results = get_posts( $team_args );
	    $team_counter = 1;
	    foreach( $team_results as $team_result ){
			update_post_meta( $team_result->ID,'team_slider_val',$team_counter );
			$team_counter++;
		}
	
}