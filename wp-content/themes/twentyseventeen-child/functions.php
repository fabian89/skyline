<?php
add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );
function enqueue_parent_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
}
//Add Post Type Film
add_action('init', 'register_post_types');
function register_post_types(){
	register_post_type('films', array(
		'label'  => false,
		'labels' => array(
			'name'               => 'Фильмы', 
			'singular_name'      => 'Фильм', 
			'add_new'            => 'Добавить фильм', 
			'add_new_item'       => 'Добавление фильма', 
			'edit_item'          => 'Редактировать фильм', 
			'new_item'           => 'Новый фильм', 
			'view_item'          => 'Смотреть фильм', 
			'search_items'       => 'Искать фильм',
			'not_found'          => 'Не найдено', 
			'not_found_in_trash' => 'Не найдено в корзине', 
			'parent_item_colon'  => '',
			'menu_name'          => 'Фильмы', 
		),
		'description'         => '',
		'public'              => true,
		'hierarchical'        => true,
		'supports'            => array('title','editor', 'thumbnail', 'custom-fields'),
		'taxonomies'          => array('category'),
		'has_archive'         => true,
		'rewrite'             => true,
		'query_var'           => true,
	) );
}
//Redirect after registration
add_filter( 'registration_redirect', 'redirect_home' );
function redirect_home( $registration_redirect ) {
    return '/wishlist/';
}

//Redirect after add to cart
add_filter('woocommerce_add_to_cart_redirect', 'new_add_to_cart_redirect');
function new_add_to_cart_redirect() {
 global $woocommerce;
 $checkout_url = wc_get_checkout_url();
 return $checkout_url;
}


//Add New Pay Button Text
add_filter( 'woocommerce_product_single_add_to_cart_text', 'new_cart_button_text' ); 
add_filter( 'woocommerce_product_add_to_cart_text', 'new_cart_button_text' ); 
 
function new_cart_button_text() {
 return __( 'Купить', 'woocommerce' );
}

//Add skype field to form
add_filter('woocommerce_checkout_fields', 'custom_woocommerce_billing_fields');
function custom_woocommerce_billing_fields($fields)
{
    $fields['billing']['billing_options'] = array(
        'label' => __('Skype', 'woocommerce'), // Add custom field label
        'placeholder' => _x('Ваш Skype', 'placeholder', 'woocommerce'), // Add custom field placeholder
        'required' => false, // if field is required or not
        'clear' => false, // add clear or not
        'type' => 'text', // add field type
        'class' => array('skype-field')   // add class name
    );

    return $fields;
}

// Connect Films to Woocommerce
class WCCPT_Product_Data_Store_CPT extends WC_Product_Data_Store_CPT {

    public function read( &$product ) {
        $product->set_defaults();
        if ( ! $product->get_id() || ! ( $post_object = get_post( $product->get_id() ) ) || ! in_array( $post_object->post_type, array( 'films', 'product' ) ) ) { 
            throw new Exception( __( 'Invalid product.', 'woocommerce' ) );
        }
        $id = $product->get_id();
        $product->set_props( array(
            'name'              => $post_object->post_title,
            'slug'              => $post_object->post_name,
            'date_created'      => 0 < $post_object->post_date_gmt ? wc_string_to_timestamp( $post_object->post_date_gmt ) : null,
            'date_modified'     => 0 < $post_object->post_modified_gmt ? wc_string_to_timestamp( $post_object->post_modified_gmt ) : null,
            'status'            => $post_object->post_status,
            'description'       => $post_object->post_content,
            'short_description' => $post_object->post_excerpt,
            'parent_id'         => $post_object->post_parent,
            'menu_order'        => $post_object->menu_order,
            'reviews_allowed'   => 'open' === $post_object->comment_status,
        ) );

        $this->read_attributes( $product );
        $this->read_downloads( $product );
        $this->read_visibility( $product );
        $this->read_product_data( $product );
        $this->read_extra_data( $product );
        $product->set_object_read( true );
    }

    public function get_product_type( $product_id ) {
        $post_type = get_post_type( $product_id );
        if ( 'product_variation' === $post_type ) {
            return 'variation';
        } elseif ( in_array( $post_type, array( 'films', 'product' ) ) ) {
            $terms = get_the_terms( $product_id, 'product_type' );
            return ! empty( $terms ) ? sanitize_title( current( $terms )->name ) : 'simple';
        } else {
            return false;
        }
    }
}

add_filter( 'woocommerce_data_stores', 'woocommerce_data_stores' );
function woocommerce_data_stores ( $stores ) {      
    $stores['product'] = 'WCCPT_Product_Data_Store_CPT';
    return $stores;
}

// Add price field
add_post_meta( 'get_the_ID()', 'new_price', '100', true);

// Pass 'new_price' to woocommerce 'price'
add_filter('woocommerce_get_price','reigel_woocommerce_get_price',20,2);
function reigel_woocommerce_get_price($price,$post){
    if ($post->post->post_type === 'films') 
        $price = get_post_meta($post->id, "new_price", true); 
    return $price;
}
