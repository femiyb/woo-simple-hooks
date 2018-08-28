<?php
/**
 *
 * @link:       http://www.femiyb.com
 * @package           Woo_Simple_Hooks
 *
 * Plugin Name:       Simple Hooks for WooCommerce
 * Plugin URI:        http://femiyb.co.za
 * Description:       This plugin makes it easier for you to add WooCommerce hooks, so if you don't know your way around php, you can easily add the hooks from the dashboard.
 * Version:           1.0.1
 * Author:            Femi
 * Author URI:        http://www.femiyb.com
 * License:            GPL-2.0+
 * License URI:        http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:            woo-simple-hooks
 * Domain Path:            /languages
 */
 
 /**
 * The core plugin class that is used to define internationalization,
 * dashboard-specific hooks, and public-facing site hooks.
 */
require_once plugin_dir_path( __FILE__ ) . 'includes/class-simple-hooks.php';


function run_wcsh_Loader() {

	$plugin = new wcsh_Loader();
	$plugin->run();



}
run_wcsh_Loader();

// Simple Hooks Settings Page
add_action('admin_menu', 'wcsh_menu');
function wcsh_menu() {
    add_submenu_page( 'woocommerce', 'Simple Hooks Settings', 'Simple Hooks Settings', 'manage_options', 'wcsh-settings', 'wcsh_settings_page' ); 
  	add_action( 'admin_init', 'update_wcsh_settings' );
}

if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) { // Check if woocommerce is active

// Create function to register plugin settings in the database
if( !function_exists("update_wcsh_settings") )
{
function update_wcsh_settings() {
		$shophooks = array("wcsh_before_main_content", "wcsh_archive_description", "wcsh_before_shop_loop", "wcsh_before_shop_loop_item", "wcsh_before_shop_loop_item_title", "wcsh_shop_loop_item_title", "wcsh_after_shop_loop_item_title", "wcsh_after_shop_loop_item", "wcsh_after_shop_loop");
		foreach ($shophooks as $shophook){
		register_setting( 'wcsh-settings-shophook', $shophook );
		}
	
		$singleproducthooks = array("wcsh_before_single_product", "wcsh_before_single_product_summary", "wcsh_single_product_summary", "wcsh_wcsh_add_to_cart", "wcsh_before_add_to_cart_form", "wcsh_before_add_to_cart_button", "wcsh_before_add_to_cart_quantity", "wcsh_after_add_to_cart_quantity", "wcsh_after_add_to_cart_button", "wcsh_after_add_to_cart_form", "wcsh_product_thumbnails", "wcsh_after_single_product_summary", "wcsh_product_meta_start", "wcsh_product_meta_end");
		foreach ($singleproducthooks as $singleproducthook){
		register_setting( 'wcsh-settings-singleproduct', $singleproducthook );
		}
	
		$cartpagehooks = array("wcsh_before_cart", "wcsh_before_cart_table", "wcsh_before_cart_contents", "wcsh_cart_contents", "wcsh_cart_coupon", "wcsh_cart_actions", "wcsh_after_cart_contents", "wcsh_after_cart_table", "wcsh_before_cart_totals", "wcsh_cart_totals_before_shipping", "wcsh_after_shipping_rate", "wcsh_before_shipping_calculator", "wcsh_after_shipping_calculator", "wcsh_cart_totals_after_shipping", "wcsh_cart_totals_before_order_total", "wcsh_cart_totals_after_order_total", "wcsh_proceed_to_checkout", "wcsh_after_cart_totals", "wcsh_after_cart", "wcsh_after_checkout_billing_form");
		foreach ($cartpagehooks as $cartpagehook){
		register_setting( 'wcsh-settings-cartpage', $cartpagehook );
		}
	
		$checkoutpagehooks = array("wcsh_before_checkout_form", "wcsh_checkout_before_customer_details", "wcsh_checkout_after_customer_details", "wcsh_checkout_billing", "wcsh_before_checkout_billing_form", "wcsh_checkout_before_order_review", "wcsh_review_order_before_cart_contents", "wcsh_review_order_after_cart_contents", "wcsh_review_order_before_shipping", "wcsh_after_shipping_rate", "wcsh_review_order_after_shipping", "wcsh_review_order_before_order_total", "wcsh_review_order_after_order_total", "wcsh_review_order_before_payment", "wcsh_before_checkout_registration_form", "wcsh_checkout_before_terms_and_conditions", "wcsh_review_order_after_submit", "wcsh_review_order_after_payment", "wcsh_after_checkout_form");
		foreach ($checkoutpagehooks as $checkoutpagehook){
		register_setting('wcsh-settings-checkoutpage', $checkoutpagehook);
		}
	
		$accountpagehooks = array("wcsh_login_form_start", "wcsh_before_customer_login_form", "wcsh_login_form", "wcsh_login_form_end", "wcsh_after_customer_login_form");
		foreach ($accountpagehooks as $accountpagehook){
		register_setting( 'wcsh-settings-accountpage', $accountpagehook );
		}
	
		$otherhooks = array("wcsh_before_mini_cart", "wcsh_before_mini_cart_contents");
		foreach ($otherhooks as $otherhook){
		register_setting( 'wcsh-settings-otherhooks', $otherhook );
		}
	
}
}

// Create WordPress plugin page
if( !function_exists("wcsh_settings_page") ) {
	
function wcsh_settings_page(){
	$shophooks = array("Before Shop Page Main Content"=>"wcsh_before_main_content",
					   "Shop Page Archive Description"=>"wcsh_archive_description",
					   "Shop Page Before Shop Loop Hook"=>"wcsh_before_shop_loop",
					   "Shop Page Before Shop Loop Item"=>"wcsh_before_shop_loop_item",
					   "Shop Page Before Shop Loop Item Title"=>"wcsh_before_shop_loop_item_title",
					   "Shop Page Shop Loop Item Title"=>"wcsh_shop_loop_item_title",
					   "Shop Page After Shop Loop Item Title"=>"wcsh_after_shop_loop_item_title",
					   "Shop Page After Shop Loop Item"=>"wcsh_after_shop_loop_item",
					   "Shop Page After Shop Loop"=>"wcsh_after_shop_loop"
					  );
	
	$singleproducthooks = array("Single Product Before single product hook"=>"wcsh_before_single_product",
								"Single Product Before single product Summary hook"=>"wcsh_before_single_product_summary",
							   	"Single Product Summary hook"=>"wcsh_single_product_summary",
							   	"Single Product Simple Add to Cart hook"=>"wcsh_wcsh_add_to_cart",
								"Single Product Before Add to Cart Form hook"=>"wcsh_before_add_to_cart_form",
								"Single Product Before Add to Cart Button hook"=>"wcsh_before_add_to_cart_button",
								"Single Product Before Add to Cart Quantity hook"=>"wcsh_before_add_to_cart_quantity",
								"Single Product After Add to Cart Quantity hook"=>"wcsh_after_add_to_cart_quantity",
								"Single Product After Add to Cart Button hook"=>"wcsh_after_add_to_cart_button",
								"Single Product After Add to Cart Form hook"=>"wcsh_after_add_to_cart_form",
								"Single Product Thumbnails hook"=>"wcsh_product_thumbnails",
								"Single Product After Product Summary hook"=>"wcsh_after_single_product_summary",
								"Single Product Meta Start hook"=>"wcsh_product_meta_start",
								"Single Product Meta End hook"=>"wcsh_product_meta_end"

							   );

	
	$cartpagehooks = array("Cart Page Before Cart Hook"=>"wcsh_before_cart",
						   "Cart Page Before Cart Table Hook"=>"wcsh_before_cart_table",
						   "Cart Page Before Cart Contents"=>"wcsh_before_cart_contents",
						   "Cart Page Cart Contents"=>"wcsh_cart_contents",
						   "Cart Page Cart Coupon"=>"wcsh_cart_coupon",
						   "Cart Page Cart Actions Hook"=>"wcsh_cart_actions",
						   "Cart Page After Cart Contents Hook"=>"wcsh_after_cart_contents",
						   "Cart Page After Cart Table Hook"=>"wcsh_after_cart_table",
						   "Cart Page Before Cart Totals Hook"=>"wcsh_before_cart_totals",
						   "Cart Page Cart Totals Before Shipping Hook"=>"wcsh_cart_totals_before_shipping",
						   "Cart Page After Shipping Rate"=>"wcsh_after_shipping_rate",
						   "Cart Page Before Shipping Calculator"=>"wcsh_before_shipping_calculator",
						   "Cart Page After Shipping Calculator"=>"wcsh_after_shipping_calculator",
						   "Cart Page Cart Totals After Shipping"=>"wcsh_cart_totals_after_shipping",
						   "Cart Page Cart Totals Before Order Total"=>"wcsh_cart_totals_before_order_total",
						   "Cart Page Cart Totals After Order Total"=>"wcsh_cart_totals_after_order_total",
						   "Cart Page Proceed To Checkout"=>"wcsh_proceed_to_checkout",
						   "Cart Page After Cart Totals"=>"wcsh_after_cart_totals",
						   "Cart Page After Cart"=>"wcsh_after_cart",
						   "Checkout Page Review Order Before Payment Hook"=>"wcsh_review_order_before_payment"
						   );
	
	$accountpagehooks = array("Account Page Login Form Start Hook"=>"wcsh_login_form_start",
							  "Account Page Before Customer Login Hook"=>"wcsh_before_customer_login_form",
							 "Checkout Page Login Form Hook"=>"wcsh_login_form",
							 "Checkout Page Login Form End Hook"=>"wcsh_login_form_end",
							 "Checkout Page After Customer Login Form Hook"=>"wcsh_after_customer_login_form");
	
	$checkoutpagehooks = array("Checkout Page Before Checkout Form"=>"wcsh_before_checkout_form",
							  "Checkout Page Before Customer Details"=>"wcsh_checkout_before_customer_details",
							  "Checkout Page After Customer Details"=>"wcsh_checkout_after_customer_details",
							  "Checkout Page Checkout Billing Hook"=>"wcsh_checkout_billing",
							  "Checkout Page Before Checkout Billing Hook"=>"wcsh_before_checkout_billing_form",
							  "Checkout Page Before Order Review Hook"=>"wcsh_checkout_before_order_review",
							  "Checkout Page Review Order Before Cart Contents Hook"=>"wcsh_review_order_before_cart_contents",
							  "Checkout Page Review Order After Cart Contents Hook"=>"wcsh_review_order_after_cart_contents",
							  "Checkout Page Review Before Shipping Hook"=>"wcsh_review_order_before_shipping",
							  "Checkout Page After Shipping Rate Hook"=>"wcsh_after_shipping_rate",
							  "Checkout Page Review Order After Shipping Hook"=>"wcsh_review_order_after_shipping",
							  "Checkout Page Review Order Before Order Total Hook"=>"wcsh_review_order_before_order_total",
							  "Checkout Page Review Order After Order Total Hook"=>"wcsh_review_order_after_order_total",
							  "Checkout Page After Checkout Billing Form Hook"=>"wcsh_after_checkout_billing_form",
							  "Checkout Page Before Checkout registration Form Hook"=>"wcsh_before_checkout_registration_form",
							  "Checkout Page Before Terms and Conditions Hook"=>"wcsh_checkout_before_terms_and_conditions",
							  "Checkout Page Review Order After Submit Hook"=>"wcsh_review_order_after_submit",
							  "Checkout Page Review Order After Payment Hook"=>"wcsh_review_order_after_payment",
							  "Checkout Page After Checkout Form Hook"=>"wcsh_after_checkout_form"
							  );
	
	$otherhooks = array("Before Mini Cart Hook"=>"wcsh_before_mini_cart",
						"Before Mini Cart Contents Hook"=>"wcsh_before_mini_cart_contents"
					   );
?>

  		<h1>Simple Hooks Settings</h1>
  		<form method="post" action="options.php">

  			<?php
            if( isset( $_GET[ 'tab' ] ) ) {
                $active_tab = $_GET[ 'tab' ];
            	}
?>

	  		<h2 class="nav-tab-wrapper">
				<a href="?page=wcsh-settings&tab=wcsh_shop_options" class="nav-tab <?php echo $active_tab == 'wcsh_shop_options' ? 'nav-tab-active' : ''; ?>">Shop Page Hooks</a>
				<a href="?page=wcsh-settings&tab=wcsh_single_product_options" class="nav-tab <?php echo $active_tab == 'wcsh_single_product_options' ? 'nav-tab-active' : ''; ?>">Single Product Page Hooks</a>
				<a href="?page=wcsh-settings&tab=wcsh_cart_page_options" class="nav-tab <?php echo $active_tab == 'wcsh_cart_page_options' ? 'nav-tab-active' : ''; ?>">Cart Page Hooks</a>
				<a href="?page=wcsh-settings&tab=wcsh_checkout_page_options" class="nav-tab <?php echo $active_tab == 'wcsh_checkout_page_options' ? 'nav-tab-active' : ''; ?>">Checkout Page Hooks</a>
				<a href="?page=wcsh-settings&tab=wcsh_account_page_options" class="nav-tab <?php echo $active_tab == 'wcsh_account_page_options' ? 'nav-tab-active' : ''; ?>">Account Page Hooks</a>
				<a href="?page=wcsh-settings&tab=wcsh_other_hooks_options" class="nav-tab <?php echo $active_tab == 'wcsh_other_hooks_options' ? 'nav-tab-active' : ''; ?>">Other Hooks</a>
		</h2>


    		<?php 
			if( $active_tab == 'wcsh_single_product_options' ) {
				settings_fields( 'wcsh-settings-singleproduct' );
				do_settings_sections( 'wcsh-settings-singleproduct' );
    		 ?>
	  			<h2>WOOCOMMERCE SINGLE PRODUCT PAGE HOOKS</h2>
	  		<?php
			
				foreach ($singleproducthooks as $key => $singleproducthook){ ?>
				<table class="form-table">
				<tr valign="top">
				<th scope="row"><?php echo $key; ?></th>
				<td><textarea name="<?php echo $singleproducthook; ?>" class="wcsh-textarea"><?php echo get_option($singleproducthook); ?></textarea></td>
			 	</tr>
    			</table>	
				<?php }
				}
				elseif ($active_tab == 'wcsh_cart_page_options') {
				settings_fields( 'wcsh-settings-cartpage' );
				do_settings_sections( 'wcsh-settings-cartpage' );
				?>
				<h2>WOOCOMMERCE CART PAGE HOOKS</h2>
				<?php
				foreach ($cartpagehooks as $key => $cartpagehook){ ?>
				<table class="form-table">
				<tr valign="top">
				<th scope="row"><?php echo $key; ?></th>
				<td><textarea name="<?php echo $cartpagehook; ?>" class="wcsh-textarea"><?php echo get_option($cartpagehook); ?></textarea></td>
				  </tr>
				</table>
    		<?php
    		}
    	}
	elseif ($active_tab == 'wcsh_checkout_page_options') {
				settings_fields( 'wcsh-settings-checkoutpage' );
				do_settings_sections( 'wcsh-settings-checkoutpage' );
				?>
				<h2>WOOCOMMERCE CHECKOUT PAGE HOOKS</h2>
				<?php
				foreach ($checkoutpagehooks as $key => $checkoutpagehook){ ?>
				<table class="form-table">
				<tr valign="top">
				<th scope="row"><?php echo $key; ?></th>
				<td><textarea name="<?php echo $checkoutpagehook; ?>" class="wcsh-textarea"><?php echo get_option($checkoutpagehook); ?></textarea></td>
				  </tr>
				</table>
    		<?php
    		}
    	}
    		elseif ($active_tab == 'wcsh_account_page_options') {
    		settings_fields( 'wcsh-settings-accountpage' );
    		do_settings_sections( 'wcsh-settings-accountpage' );
    		?>
	  		<h2>WOOCOMMERCE ACCOUNT PAGE HOOKS</h2>
	  		<?php
	  		foreach ($accountpagehooks as $key => $accountpagehook){ ?>
			<table class="form-table">
			<tr valign="top">
			<th scope="row"><?php echo $key; ?></th>
			<td><textarea name="<?php echo $accountpagehook; ?>" class="wcsh-textarea"><?php echo get_option($accountpagehook); ?></textarea></td>
			  </tr>
    		</table>
    		<?php
    		}
    	}
			elseif ($active_tab == 'wcsh_other_hooks_options') {
    		settings_fields( 'wcsh-settings-otherhooks' );
    		do_settings_sections( 'wcsh-settings-otherhooks' );
    		?>
	  		<h2>WOOCOMMERCE OTHER HOOKS</h2>
	  		<?php
	  		foreach ($otherhooks as $key => $otherhook){ ?>
			<table class="form-table">
			<tr valign="top">
			<th scope="row"><?php echo $key; ?></th>
			<td><textarea name="<?php echo $otherhook; ?>" class="wcsh-textarea"><?php echo get_option($otherhook); ?></textarea></td>
			  </tr>
    		</table>
    		<?php
    		}
    	}
    		else
    		{ 
    		settings_fields( 'wcsh-settings-shophook' );
    		do_settings_sections( 'wcsh-settings-shophook' );
    		?>
    		<h2>WOOCOMMERCE SHOP PAGE HOOKS</h2>
    		<?php
			foreach ($shophooks as $key => $shophook){	?>	  
			<table class="form-table">
			<tr valign="top">
			<th scope="row"><?php echo $key; ?></th>
			<td><textarea name="<?php echo $shophook; ?>" class="wcsh-textarea"><?php echo get_option($shophook); ?></textarea></td>
			</tr>
			</table>

	  		<?php } 
			}
	
			submit_button(); ?>
 		</form>

	<?php
			
		}
	}	
} // Check if woocommerce is active

	else
	{
function wcsh_notice() {
    ?>
    <div class="error notice">
    <p>Simple Hooks Plugin requires the WooCommerce Plugin</p>
    </div>
    <?php
}

add_action( 'admin_notices', 'wcsh_notice' );
}