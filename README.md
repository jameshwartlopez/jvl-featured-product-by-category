# jvl-featured-product-by-category
WooCommerce has products called Featured Products which are products that become featured when they are starred or set in the WP Admin dashboard.

Most of the time you will need to show featured product by category in the home page of your online. This plugin is for that purpose only. 

How to use? 
1. You will need to have the slug of your category. So go to Product categories and get the slug of the category you want
2. add the shortcode [featured_products_by_category cat="your-selected-cat-slug"] in the page, post or elementor shortcode widget. 

The default featured products to display is 8 but you can override this by passing the limit parameter in the shortcode like below. 
[featured_products_by_category cat="your-selected-cat-slug" limit=4]
