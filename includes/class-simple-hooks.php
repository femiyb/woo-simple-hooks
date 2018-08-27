<?php

/**
 * Register all actions and filters for the plugin
 *
 * @link:       http://www.femiyb.com
 * @since      1.0.0
 *
 * @package    wcsh_Hooks
 * @subpackage wcsh_Hooks/includes
 */

/**
 * Register all actions and filters for the plugin.
 *
 * Maintain a list of all hooks that are registered throughout
 * the plugin, and register them with the WordPress API. Call the
 * run function to execute the list of actions and filters.
 *
 * @package    wcsh_Hooks
 * @subpackage wcsh_Hooks/includes
 * @author:       Femi <94sam.fem@gmail.com>
 */
class wcsh_Loader {

	/**
	 * The array of actions registered with WordPress.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      array    $actions    The actions registered with WordPress to fire when the plugin loads.
	 */
	protected $actions;

	/**
	 * The array of filters registered with WordPress.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      array    $filters    The filters registered with WordPress to fire when the plugin loads.
	 */
	protected $filters;

	/**
	 * Initialize the collections used to maintain the actions and filters.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->actions = array();
		$this->filters = array();

	}

	/**
	 * Add a new action to the collection to be registered with WordPress.
	 *
	 * @since    1.0.0
	 * @var      string               $hook             The name of the WordPress action that is being registered.
	 * @var      object               $component        A reference to the instance of the object on which the action is defined.
	 * @var      string               $callback         The name of the function definition on the $component.
	 * @var      int      Optional    $priority         The priority at which the function should be fired.
	 * @var      int      Optional    $accepted_args    The number of arguments that should be passed to the $callback.
	 */
	public function add_action( $hook, $component, $callback, $priority = 10, $accepted_args = 1 ) {
		$this->actions = $this->add( $this->actions, $hook, $component, $callback, $priority, $accepted_args );
	}

	/**
	 * Add a new filter to the collection to be registered with WordPress.
	 *
	 * @since    1.0.0
	 * @var      string               $hook             The name of the WordPress filter that is being registered.
	 * @var      object               $component        A reference to the instance of the object on which the filter is defined.
	 * @var      string               $callback         The name of the function definition on the $component.
	 * @var      int      Optional    $priority         The priority at which the function should be fired.
	 * @var      int      Optional    $accepted_args    The number of arguments that should be passed to the $callback.
	 */
	public function add_filter( $hook, $component, $callback, $priority = 10, $accepted_args = 1 ) {
		$this->filters = $this->add( $this->filters, $hook, $component, $callback, $priority, $accepted_args );
	}

	/**
	 * A utility function that is used to register the actions and hooks into a single
	 * collection.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      array                $hooks            The collection of hooks that is being registered (that is, actions or filters).
	 * @var      string               $hook             The name of the WordPress filter that is being registered.
	 * @var      object               $component        A reference to the instance of the object on which the filter is defined.
	 * @var      string               $callback         The name of the function definition on the $component.
	 * @var      int      Optional    $priority         The priority at which the function should be fired.
	 * @var      int      Optional    $accepted_args    The number of arguments that should be passed to the $callback.
	 * @return   type                                   The collection of actions and filters registered with WordPress.
	 */
	private function add( $hooks, $hook, $component, $callback, $priority, $accepted_args ) {

		$hooks[] = array(
			'hook'          => $hook,
			'component'     => $component,
			'callback'      => $callback,
			'priority'      => $priority,
			'accepted_args' => $accepted_args
		);

		return $hooks;

	}

	/**
	 * Register the filters and actions with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {

		foreach ( $this->filters as $hook ) {
			add_filter( $hook['hook'], array( $hook['component'], $hook['callback'] ), $hook['priority'], $hook['accepted_args'] );
		}

		foreach ( $this->actions as $hook ) {
			add_action( $hook['hook'], array( $hook['component'], $hook['callback'] ), $hook['priority'], $hook['accepted_args'] );
		}
		
		
		// woocommerce_before_main_content
		add_action('woocommerce_before_main_content', 'wcsh_before_main_content', 100);
		function wcsh_before_main_content(){
			echo '<span class="wcsh_before_main_content">' .get_option('wcsh_before_main_content'). '</span>';
		}
		
		// woocommerce_archive_description
		add_action('woocommerce_archive_description', 'wcsh_archive_description', 100);
		function wcsh_archive_description(){
			echo '<span class="wcsh_archive_description">' .get_option('wcsh_archive_description'). '</span>';
		}
		
		// woocommerce_before_shop_loop
		add_action('woocommerce_before_shop_loop', 'wcsh_before_shop_loop', 100);
		function wcsh_before_shop_loop(){
			echo get_option('wcsh_before_shop_loop');
		}
		
		// woocommerce_before_shop_loop_item
		add_action ('woocommerce_before_shop_loop_item', 'wcsh_before_shop_loop_item', 100);
		function wcsh_before_shop_loop_item(){
			echo get_option('wcsh_before_shop_loop_item');
		}
		
		// woocommerce_before_shop_loop_item_title
		add_action ('woocommerce_before_shop_loop_item_title', 'wcsh_before_shop_loop_item_title', 100);
		function wcsh_before_shop_loop_item_title(){
			echo get_option('wcsh_before_shop_loop_item_title');
		}
		
		// woocommerce_shop_loop_item_title
		add_action ('woocommerce_shop_loop_item_title', 'wcsh_shop_loop_item_title', 100);
		function wcsh_shop_loop_item_title(){ ?>
		<span class="wcsh_shop_loop_item_title">
			<?php echo get_option('wcsh_shop_loop_item_title'); ?>
		</span>
		<?php }
		
		// woocommerce_after_shop_loop_item_title
		add_action ('woocommerce_after_shop_loop_item_title', 'wcsh_after_shop_loop_item_title', 100);
		function wcsh_after_shop_loop_item_title(){
			echo get_option('wcsh_after_shop_loop_item_title');
		}
		
		// woocommerce_after_shop_loop_item
		add_action ('woocommerce_after_shop_loop_item', 'wcsh_after_shop_loop_item', 100);
		function wcsh_after_shop_loop_item(){
			echo get_option('wcsh_after_shop_loop_item');
		}
		
		// woocommerce_after_shop_loop
		add_action ('woocommerce_after_shop_loop', 'wcsh_after_shop_loop', 100);
		function wcsh_after_shop_loop(){
			echo get_option('wcsh_after_shop_loop');
		}
		
		// woocommerce_before_single_product
		add_action ('woocommerce_before_single_product', 'wcsh_before_single_product', 100);
		function wcsh_before_single_product(){
			echo get_option('wcsh_before_single_product');
		}
		
		// woocommerce_before_single_product_summary
		add_action ('woocommerce_before_single_product_summary', 'wcsh_before_single_product_summary', 100);
		function wcsh_before_single_product_summary(){
			echo get_option('wcsh_before_single_product_summary');
		}
		
		// woocommerce_before_cart
		add_action ('woocommerce_before_cart', 'wcsh_before_cart', 100);
		function wcsh_before_cart(){
			echo get_option('wcsh_before_cart');
		}
		
		// woocommerce_before_cart_table
		add_action ('woocommerce_before_cart_table', 'wcsh_before_cart_table', 100);
		function wcsh_before_cart_table(){
			echo get_option('wcsh_before_cart_table');
		}
		
		// woocommerce_login_form_start
		add_action ('woocommerce_login_form_start', 'wcsh_login_form_start', 100);
		function wcsh_login_form_start(){
			echo get_option('wcsh_login_form_start');
		}
		
		// woocommerce_before_customer_login_form
		add_action ('woocommerce_before_customer_login_form', 'wcsh_before_customer_login_form', 100);
		function wcsh_before_customer_login_form(){
			echo get_option('wcsh_before_customer_login_form');
		}
		
		
		// woocommerce_before_mini_cart
		add_action ('woocommerce_before_mini_cart', 'wcsh_before_mini_cart', 100);
		function wcsh_before_mini_cart(){
			echo get_option('wcsh_before_mini_cart');
		}
		
		// woocommerce_before_mini_cart_contents
		add_action ('woocommerce_before_mini_cart_contents', 'wcsh_before_mini_cart_contents', 100);
		function wcsh_before_mini_cart_contents(){
			echo get_option('wcsh_before_mini_cart_contents');
		}
		
		// woocommerce_single_product_summary
		add_action ('woocommerce_single_product_summary', 'wcsh_single_product_summary', 100);
		function wcsh_single_product_summary(){
			echo get_option('wcsh_single_product_summary');
		}
		
		// woocommerce_wcsh_add_to_cart
		add_action ('woocommerce_wcsh_add_to_cart', 'wcsh_wcsh_add_to_cart', 100);
		function wcsh_wcsh_add_to_cart(){
			echo get_option('wcsh_wcsh_add_to_cart');
		}
		
		// woocommerce_before_add_to_cart_form
		add_action ('woocommerce_before_add_to_cart_form', 'wcsh_before_add_to_cart_form', 100);
		function wcsh_before_add_to_cart_form(){
			echo get_option('wcsh_before_add_to_cart_form');
		}
		
		// woocommerce_before_add_to_cart_button
		add_action ('woocommerce_before_add_to_cart_button', 'wcsh_before_add_to_cart_button', 100);
		function wcsh_before_add_to_cart_button(){
			echo get_option('wcsh_before_add_to_cart_button');
		}
		
		// woocommerce_before_add_to_cart_quantity
		add_action ('woocommerce_before_add_to_cart_quantity', 'wcsh_before_add_to_cart_quantity', 100);
		function wcsh_before_add_to_cart_quantity(){
			echo get_option('wcsh_before_add_to_cart_quantity');
		}
		
		// woocommerce_after_add_to_cart_quantity
		add_action ('woocommerce_after_add_to_cart_quantity', 'wcsh_after_add_to_cart_quantity', 100);
		function wcsh_after_add_to_cart_quantity(){
			echo get_option('wcsh_after_add_to_cart_quantity');
		}
		
		// woocommerce_after_add_to_cart_button
		add_action ('woocommerce_after_add_to_cart_button', 'wcsh_after_add_to_cart_button', 100);
		function wcsh_after_add_to_cart_button(){
			echo get_option('wcsh_after_add_to_cart_button');
		}
		
		// woocommerce_after_add_to_cart_form
		add_action ('woocommerce_after_add_to_cart_form', 'wcsh_after_add_to_cart_form', 100);
		function wcsh_after_add_to_cart_form(){
			echo get_option('wcsh_after_add_to_cart_form');
		}
		
		// woocommerce_product_thumbnails
		add_action ('woocommerce_product_thumbnails', 'wcsh_product_thumbnails', 100);
		function wcsh_product_thumbnails(){
			echo get_option('wcsh_product_thumbnails');
		}
		
		// woocommerce_after_single_product_summary
		add_action ('woocommerce_after_single_product_summary', 'wcsh_after_single_product_summary', 100);
		function wcsh_after_single_product_summary(){
			echo get_option('wcsh_after_single_product_summary');
		}
		
		// woocommerce_product_meta_start
		add_action ('woocommerce_product_meta_start', 'wcsh_product_meta_start', 100);
		function wcsh_product_meta_start(){
			echo get_option('wcsh_product_meta_start');
		}
		
		// woocommerce_product_meta_end
		add_action ('woocommerce_product_meta_end', 'wcsh_product_meta_end', 100);
		function wcsh_product_meta_end(){
			echo get_option('wcsh_product_meta_end');
		}
		
		// woocommerce_before_cart_contents
		add_action ('woocommerce_before_cart_contents', 'wcsh_before_cart_contents', 100);
		function wcsh_before_cart_contents(){
			echo get_option('wcsh_before_cart_contents');
		}
		
		// woocommerce_cart_contents
		add_action ('woocommerce_cart_contents', 'wcsh_cart_contents', 100);
		function wcsh_cart_contents(){
			echo get_option('wcsh_cart_contents');
		}
		
		// woocommerce_cart_coupon
		add_action ('woocommerce_cart_coupon', 'wcsh_cart_coupon', 100);
		function wcsh_cart_coupon(){
			echo get_option('wcsh_cart_coupon');
		}
		
		// woocommerce_cart_actions
		add_action ('woocommerce_cart_actions', 'wcsh_cart_actions', 100);
		function wcsh_cart_actions(){
			echo get_option('wcsh_cart_actions');
		}
		
		// woocommerce_after_cart_contents
		add_action ('woocommerce_after_cart_contents', 'wcsh_after_cart_contents', 100);
		function wcsh_after_cart_contents(){
			echo get_option('wcsh_after_cart_contents');
		}
		
		// woocommerce_after_cart_table
		add_action ('woocommerce_after_cart_table', 'wcsh_after_cart_table', 100);
		function wcsh_after_cart_table(){
			echo get_option('wcsh_after_cart_table');
		}
		
		// woocommerce_before_cart_totals
		add_action ('woocommerce_before_cart_totals', 'wcsh_before_cart_totals', 100);
		function wcsh_before_cart_totals(){
			echo get_option('wcsh_before_cart_totals');
		}
		
		// woocommerce_cart_totals_before_shipping
		add_action ('woocommerce_cart_totals_before_shipping', 'wcsh_cart_totals_before_shipping', 100);
		function wcsh_cart_totals_before_shipping(){
			echo get_option('wcsh_cart_totals_before_shipping');
		}
		
		// woocommerce_after_shipping_rate
		add_action ('woocommerce_after_shipping_rate', 'wcsh_after_shipping_rate', 100);
		function wcsh_after_shipping_rate(){
			echo get_option('wcsh_after_shipping_rate');
		}
		
		// woocommerce_before_shipping_calculator
		add_action ('woocommerce_before_shipping_calculator', 'wcsh_before_shipping_calculator', 100);
		function wcsh_before_shipping_calculator(){
			echo get_option('wcsh_before_shipping_calculator');
		}
		
		// woocommerce_after_shipping_calculator
		add_action ('woocommerce_after_shipping_calculator', 'wcsh_after_shipping_calculator', 100);
		function wcsh_after_shipping_calculator(){
			echo get_option('wcsh_after_shipping_calculator');
		}
		
		// woocommerce_cart_totals_after_shipping
		add_action ('woocommerce_cart_totals_after_shipping', 'wcsh_cart_totals_after_shipping', 100);
		function wcsh_cart_totals_after_shipping(){
			echo get_option('wcsh_cart_totals_after_shipping');
		}
		
		// woocommerce_cart_totals_before_order_total
		add_action ('woocommerce_cart_totals_before_order_total', 'wcsh_cart_totals_before_order_total', 100);
		function wcsh_cart_totals_before_order_total(){
			echo get_option('wcsh_cart_totals_before_order_total');
		}
		
		// woocommerce_cart_totals_after_order_total
		add_action ('woocommerce_cart_totals_after_order_total', 'wcsh_cart_totals_after_order_total', 100);
		function wcsh_cart_totals_after_order_total(){
			echo get_option('wcsh_cart_totals_after_order_total');
		}
		
		// woocommerce_proceed_to_checkout
		add_action ('woocommerce_proceed_to_checkout', 'wcsh_proceed_to_checkout', 100);
		function wcsh_proceed_to_checkout(){
			echo get_option('wcsh_proceed_to_checkout');
		}
		
		// woocommerce_after_cart_totals
		add_action ('woocommerce_after_cart_totals', 'wcsh_after_cart_totals', 100);
		function wcsh_after_cart_totals(){
			echo get_option('wcsh_after_cart_totals');
		}
		
		// woocommerce_after_cart
		add_action ('woocommerce_after_cart', 'wcsh_after_cart', 100);
		function wcsh_after_cart(){
			echo get_option('wcsh_after_cart');
		}
		
		#CHECKOUT PAGE HOOKS
		// woocommerce_before_checkout_form
		add_action ('woocommerce_before_checkout_form', 'wcsh_before_checkout_form', 100);
		function wcsh_before_checkout_form(){
			echo get_option('wcsh_before_checkout_form');
		}
		
		// woocommerce_checkout_before_customer_details
		add_action ('woocommerce_checkout_before_customer_details', 'wcsh_checkout_before_customer_details', 100);
		function wcsh_checkout_before_customer_details(){
			echo get_option('wcsh_checkout_before_customer_details');
		}
		
		// woocommerce_checkout_after_customer_details
		add_action ('woocommerce_checkout_after_customer_details', 'wcsh_checkout_after_customer_details', 100);
		function wcsh_checkout_after_customer_details(){
			echo get_option('wcsh_checkout_after_customer_details');
		}
		
		// woocommerce_checkout_billing
		add_action ('woocommerce_checkout_billing', 'wcsh_checkout_billing', 100);
		function wcsh_checkout_billing(){
			echo get_option('wcsh_checkout_billing');
		}
		
		// woocommerce_before_checkout_billing_form
		add_action ('woocommerce_before_checkout_billing_form', 'wcsh_before_checkout_billing_form', 100);
		function wcsh_before_checkout_billing_form(){
			echo get_option('wcsh_before_checkout_billing_form');
		}
		
		// woocommerce_checkout_before_order_review
		add_action ('woocommerce_checkout_before_order_review', 'wcsh_checkout_before_order_review', 100);
		function wcsh_checkout_before_order_review(){
			echo get_option('wcsh_checkout_before_order_review');
		}
		
		// woocommerce_review_order_before_cart_contents
		add_action ('woocommerce_review_order_before_cart_contents', 'wcsh_review_order_before_cart_contents', 100);
		function wcsh_review_order_before_cart_contents(){
			echo get_option('wcsh_review_order_before_cart_contents');
		}
		
		// woocommerce_review_order_after_cart_contents
		add_action ('woocommerce_review_order_after_cart_contents', 'wcsh_review_order_after_cart_contents', 100);
		function wcsh_review_order_after_cart_contents(){
			echo get_option('wcsh_review_order_after_cart_contents');
		}
		
		// woocommerce_review_order_before_shipping
		add_action ('woocommerce_review_order_before_shipping', 'wcsh_review_order_before_shipping', 100);
		function wcsh_review_order_before_shipping(){
			echo get_option('wcsh_review_order_before_shipping');
		}
		
		// woocommerce_review_order_after_shipping
		add_action ('woocommerce_review_order_after_shipping', 'wcsh_review_order_after_shipping', 100);
		function wcsh_review_order_after_shipping(){
			echo get_option('wcsh_review_order_after_shipping');
		}
		
		// woocommerce_review_order_before_order_total
		add_action ('woocommerce_review_order_before_order_total', 'wcsh_review_order_before_order_total', 100);
		function wcsh_review_order_before_order_total(){
			echo get_option('wcsh_review_order_before_order_total');
		}
		
		// woocommerce_review_order_after_order_total
		add_action ('woocommerce_review_order_after_order_total', 'wcsh_review_order_after_order_total', 100);
		function wcsh_review_order_after_order_total(){
			echo get_option('wcsh_review_order_after_order_total');
		}
		
		// woocommerce_review_order_before_payment
		add_action ('woocommerce_review_order_before_payment', 'wcsh_review_order_before_payment', 100);
		function wcsh_review_order_before_payment(){
			echo get_option('wcsh_review_order_before_payment');
		}
		
		// woocommerce_after_checkout_billing_form
		add_action ('woocommerce_after_checkout_billing_form', 'wcsh_after_checkout_billing_form', 100);
		function wcsh_after_checkout_billing_form(){
			echo get_option('wcsh_after_checkout_billing_form');
		}
		
		// woocommerce_before_checkout_registration_form
		add_action ('woocommerce_before_checkout_registration_form', 'wcsh_before_checkout_registration_form', 100);
		function wcsh_before_checkout_registration_form(){
			echo get_option('wcsh_before_checkout_registration_form');
		}
		
		// woocommerce_checkout_before_terms_and_conditions
		add_action ('woocommerce_checkout_before_terms_and_conditions', 'wcsh_checkout_before_terms_and_conditions', 100);
		function wcsh_checkout_before_terms_and_conditions(){
			echo get_option('wcsh_checkout_before_terms_and_conditions');
		}
		
		// woocommerce_review_order_after_submit
		add_action ('woocommerce_review_order_after_submit', 'wcsh_review_order_after_submit', 100);
		function wcsh_review_order_after_submit(){
			echo get_option('wcsh_review_order_after_submit');
		}
		
		// woocommerce_review_order_after_payment
		add_action ('woocommerce_review_order_after_payment', 'wcsh_review_order_after_payment', 100);
		function wcsh_review_order_after_payment(){
			echo get_option('wcsh_review_order_after_payment');
		}
		
		// woocommerce_after_checkout_form
		add_action ('woocommerce_after_checkout_form', 'wcsh_after_checkout_form', 100);
		function wcsh_after_checkout_form(){
			echo get_option('wcsh_after_checkout_form');
		}
		
		
		#ACCOUNT PAGE HOOKS
		// woocommerce_login_form
		add_action ('woocommerce_login_form', 'wcsh_login_form', 100);
		function wcsh_login_form(){
			echo get_option('wcsh_login_form');
		}
		
		// woocommerce_login_form_end
		add_action ('woocommerce_login_form_end', 'wcsh_login_form_end', 100);
		function wcsh_login_form_end(){
			echo get_option('wcsh_login_form_end');
		}
		
		// woocommerce_after_customer_login_form
		add_action ('woocommerce_after_customer_login_form', 'wcsh_after_customer_login_form', 100);
		function wcsh_after_customer_login_form(){
			echo get_option('wcsh_after_customer_login_form');
		}
		
	}

}
