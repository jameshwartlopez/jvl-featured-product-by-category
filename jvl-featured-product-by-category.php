<?php

/*
	Plugin Name: Featured Products by Category
	Plugin URI: https://jameshwartlopez.com/plugin/get-featured-products-of-a-category/
	description: Display Woocommerce Featured Product by category 
	Version: 1.0
	Author: Jameshwart Lopez
	Author URI: https://jameshwartlopez.com/
	License: GPLv2 or later
	License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

defined( 'ABSPATH' ) || exit;

if ( !class_exists( 'JVL_Featured_Product_by_Category' ) ) {

	class JVL_Featured_Product_by_Category {

		protected static $_instance = null;

		public static function instance() {
			
			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self();
			}

			return self::$_instance;
		}

		public function __construct() {

			add_shortcode('featured_products_by_category', array($this, 'featured_products_by_category') );

		}


		public function featured_products_by_category( $atts ) {
			global $post;

			$atts = shortcode_atts( array(
				'cat' => '',
				'limit' => 8,
			), $atts );

			$limit = absint( $atts['limit'] );
			$product_cat = sanitize_title_with_dashes($atts['cat']);
			$columns = wc_get_loop_prop( 'columns' );


		    $query_args = array(
		        'limit' => $limit,
		        'featured' => true,
		        'orderby' => 'menu_order',
		        'order' => 'ASC',
		        'category' => array($product_cat)
		    );
			$products = wc_get_products($query_args);



			if(empty($products)) {
				return 'No products found.';
			}

			$html_output = '';
			ob_start();
			?>
			<div class="woocommerce columns-<?php echo esc_attr( $columns ); ?>">
				<?php
					woocommerce_product_loop_start();
					foreach ($products as $product) {
						$post = get_post($product->get_id());
				        setup_postdata($post);
				        wc_get_template_part('content', 'product');
					}
					wp_reset_postdata();
					woocommerce_product_loop_end();
				?>
			</div>

			<?php
			$html_output .= ob_get_clean();

			return $html_output;

		}
	}

}


JVL_Featured_Product_by_Category::instance();