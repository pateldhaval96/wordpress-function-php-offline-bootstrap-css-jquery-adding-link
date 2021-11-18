<?php
if ( ! function_exists( 'jenishspices_setup' ) ) :
	function jenishspices_setup() {		
		load_theme_textdomain( 'jenishspices', get_template_directory() . '/languages' );		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'jenishspices' ),
			'menu-footer1' => esc_html__( 'Footer Menu1', 'jenishspices' ),
			'menu-footer2' => esc_html__( 'Footer Menu2', 'jenishspices' ),
			'menu-footer3' => esc_html__( 'Footer Menu3', 'jenishspices' ),
			'menu-footer4' => esc_html__( 'Footer Menu4', 'jenishspices' ),
		) );
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );	
		add_theme_support( 'custom-background', apply_filters( 'jenishspices_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );		
		add_theme_support( 'customize-selective-refresh-widgets' );
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'jenishspices_setup' );

function jenishspices_content_width() {	
	$GLOBALS['content_width'] = apply_filters( 'jenishspices_content_width', 640 );
}
add_action( 'after_setup_theme', 'jenishspices_content_width', 0 );


add_filter( 'widget_posts_args', 'my_widget_posts_args');
function my_widget_posts_args($args) {
	if ( is_category() ) { //adds the category parameter in the query if we display a category
		$cat = get_queried_object();
		return array(
			'posts_per_page' => 10,//set the number you want here 
			'no_found_rows' => true, 
			'post_status' => 'publish', 
			'ignore_sticky_posts' => true,
			'cat' => $cat -> term_id//the current category id
			 );
	}
	else {//keeps the normal behaviour if we are not in category context
		return $args;
	}
} 




function jenishspices_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'jenishspices' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'jenishspices' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'jenishspices_widgets_init' );
function jenishspices_scripts() {
	wp_enqueue_style( 'jenishspices-style', get_stylesheet_uri() );
	
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.css' );
	
	wp_enqueue_style( 'style', get_template_directory_uri() . '/css/style.css' );

	wp_enqueue_style( 'blog-style', get_template_directory_uri() . '/css/blog-custom.css' );

	wp_enqueue_style( 'animation', get_template_directory_uri() . '/css/custom-animation.css' );

	// wp_enqueue_style( 'slick-slider', get_template_directory_uri() . '/slick-slider/slick-slider.css' );
	
	wp_enqueue_style( 'load-fa', 'https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' );

	wp_enqueue_style( 'poppins_fonts', 'https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap' );

	wp_enqueue_style( 'quicksand_fonts', 'https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap' );
		
	wp_enqueue_script( 'script', get_template_directory_uri() . '/js/jquery.js', array() );
	
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.js', array() );

	wp_enqueue_script( 'elfsight-app', 'https://apps.elfsight.com/p/platform.js', array() );

	// wp_enqueue_script( 'slick-slider', get_template_directory_uri() . '/slick-slider/slick-slider.js', array() );

  	wp_enqueue_script( 'laungage-translate', '//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit', array() );
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'jenishspices_scripts' );
require get_template_directory() . '/inc/custom-header.php';
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/template-functions.php';
require get_template_directory() . '/inc/customizer.php';
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

function jenishspices_widgets_header_init() {
	register_sidebar( array(
		'name'          => 'jenishspices Top Header',
		'id'            => 'jenishspices_widgets_header_init_id',
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="rounded">',
		'after_title'   => '</h2>',
	) );	
	register_sidebar( array(
		'name'          => 'jenishspices Footer Info',
		'id'            => 'jenishspices_footer_info',
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="rounded">',
		'after_title'   => '</h2>',
	) );	
	register_sidebar( array(
		'name'          => 'jenishspices Footer Logo',
		'id'            => 'jenishspices_footer_logo',
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="rounded">',
		'after_title'   => '</h2>',
	) );	
	register_sidebar( array(
		'name'          => 'jenishspices Copyright',
		'id'            => 'jenishspices_copyright',
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="rounded">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'jenishspices_widgets_header_init' );

function wpbsearchform( $form ) {
    $form = '<div class="nav-item"><div class="sample thirteen"><form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" ><div><input type="text" value="' . get_search_query() . '" name="s" id="s" />
	<img src="' .get_template_directory_uri() .'/images/src.png"><input type="submit" id="searchsubmit" value="" />
    </div></form></div></div>';
    return $form;
} 
add_shortcode('wpbsearch', 'wpbsearchform');
function wpb_change_search_url() {
    if ( is_search() && ! empty( $_GET['s'] ) ) {
        wp_redirect( home_url( "/search/" ) . urlencode( get_query_var( 's' ) ) );
        exit();
    }   
}
add_action( 'template_redirect', 'wpb_change_search_url' );


function add_footer(){
	?>


<script>
function googleTranslateElementInit() {
	    new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.HORIZONTAL, multilanguagePage: true}, 'google_translate_element');
	   
	      if(typeof(document.querySelector) == 'function') {
	          document.querySelector('.goog-logo-link').setAttribute('style', 'display: none');
	          document.querySelector('.goog-te-gadget').setAttribute('style', 'font-size: 0');
	      }

	      jQuery('.goog-logo-link').css('display', 'none');
	      jQuery('.goog-te-gadget').css('font-size', '0');
	   
	  }
	  </script>

	  <!-- <script type="text/javascript">
	  	jQuery(document).ready(function($) {
		    jQuery('.main_sliders').slick({
		        dots: false,
		        infinite: true,
		        speed: 500,
		        slidesToShow: 3,
		        slidesToScroll: 1,
		        autoplay: true,
		        autoplaySpeed: 2000,
		        arrows: true,
		        responsive: [{
		          breakpoint: 600,
		          settings: {
		            slidesToShow: 1,
		            slidesToScroll: 1
		          }
		        },
		        {
		           breakpoint: 400,
		           settings: {
		              arrows: false,
		              slidesToShow: 1,
		              slidesToScroll: 1
		           }
		        }]
		    });
		});
	  </script> -->




	  <!-- Navbar Fix Js -->
		<script type="text/javascript">
		      jQuery(window).scroll(function() {    
		    var scroll = jQuery(window).scrollTop();

		    if (scroll >= 20) {
		        jQuery(".header-section-main-div").addClass("fixed-sec-nav");
		    } else {
		        jQuery(".header-section-main-div").removeClass("fixed-sec-nav");
		    }
		    });
		</script>

		<script type="text/javascript">
		    $( document ).ready(function() {
			    $( ".mob-search-icon-div" ).click(function() {
				//location.reload();
				$('.mobile-search-row-main-div').toggle();
			});
			});
		</script>

	  <script type="text/javascript">
	  	jQuery(document).ready(function(){
			
			<?php if(is_front_page()) { ?>
			$(".footer-cav-img-row-div").css('display', 'none');
			//$(".footer-cav-img-div").addClass('ft-home');
			//$(".footer-cav-img-div img").attr("src","<?php echo site_url(); ?>/wp-content/themes/jenishspices/images/footer-gray.png");
			<?php } else { ?>
			//$(".footer-cav-img-div img").attr("src","<?php echo site_url(); ?>/wp-content/themes/jenishspices/images/footer-white.png");
			<?php } ?>
			
			jQuery(".special-recipe-contain-div").click(function(){
				$(".special-recipe-contain-div").removeClass("active");
				$(this).addClass("active");
			});			
			
		  jQuery("#special-recipe-heading1").click(function(){
		    jQuery("#special-recipe-video1").show(1000);
		    jQuery("#special-recipe-video2").hide(1000);
		    jQuery("#special-recipe-video3").hide(1000);
		  });
		  jQuery("#special-recipe-heading2").click(function(){
		    jQuery("#special-recipe-video2").show(1000);
		    jQuery("#special-recipe-video1").hide(1000);
		    jQuery("#special-recipe-video3").hide(1000);
		  });
		  jQuery("#special-recipe-heading3").click(function(){
		    jQuery("#special-recipe-video3").show(1000);
		    jQuery("#special-recipe-video1").hide(1000);
		    jQuery("#special-recipe-video2").hide(1000);
		  });
		});
	  </script>

	  <!-- Custom Animation JS -->
	  <script type="text/javascript">
		// --> Check https://codepen.io/bramus/pen/vKpjNP
		jQuery(function($) {
		 
		  // Function which adds the 'animated' class to any '.animatable' in view
		  var doAnimations = function() {
		    
		    // Calc current offset and get all animatables
		    var offset = jQuery(window).scrollTop() + jQuery(window).height(),
		        $animatables = jQuery('.animatable');
		    
		    // Unbind scroll handler if we have no animatables
		    if ($animatables.length == 0) {
		      jQuery(window).off('scroll', doAnimations);
		    }
		    
		    // Check all animatables and animate them if necessary
				$animatables.each(function(i) {
		       var $animatable = jQuery(this);
					if (($animatable.offset().top + $animatable.height() - 20) < offset) {
		        $animatable.removeClass('animatable').addClass('animated');
					}
		    });

			};
		  
		  // Hook doAnimations on scroll, and trigger a scroll
			jQuery(window).on('scroll', doAnimations);
			  jQuery(window).trigger('scroll');

			});
	  </script>

	  <!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-135554413-22"></script>
		<script>
		  window.dataLayer = window.dataLayer || [];
		  function gtag(){dataLayer.push(arguments);}
		  gtag('js', new Date());

		  gtag('config', 'UA-135554413-22');
		</script>

		<?php if ( is_front_page() ) : ?>

		 <div class="modal fade homepage-popup-div" id="myModal">
		    <div class="modal-dialog modal-lg modal-dialog-centered">
		      <div class="modal-content">
		        
		        
		        <div class="modal-body">
		          <iframe src="https://www.youtube.com/embed/vvPlbtXM1es?list=PLHnZ-35dameIoAJB0u8e0aXVhbqii8Yxc&loop=1" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
		        </div>
		        
		        
		        <div class="modal-footer mt-2">
		          <a href="javascript:void(0)" data-dismiss="modal" id="skip_btn">
		          	<img src="https://www.jenishspices.com/wp-content/uploads/2021/05/skip-btn.png" class="skip-btn img-fluid">
		          </a>
		        </div>
		        
		      </div>
		    </div>
		  </div> 

		  	 <script type="text/javascript">
			    $( document ).ready(function() {
			       $('#myModal').modal('show');
			    });

			    $( document ).ready(function() {
				    $( "#skip_btn" ).click(function() {
					//location.reload();
					$('#myModal').modal('hide');
					$('#myModal').html('');
				});
				});
			</script> 


			
			<?php
					endif;
					?>
			

	  <?php
	}
	add_action( 'wp_footer', 'add_footer' );