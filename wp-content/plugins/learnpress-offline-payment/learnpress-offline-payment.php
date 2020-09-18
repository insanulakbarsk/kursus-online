<?php
/*
Plugin Name: LearnPress - Offline Payment
Plugin URI: http://thimpress.com/learnpress
Description: Make a payment with cash.
Author: ThimPress
Version: 3.0.1
Author URI: http://thimpress.com
Tags: learnpress
Text Domain: learnpress-offline-payment
Domain Path: /languages/
*/

// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;

define( 'LP_ADDON_OFFLINE_PAYMENT_FILE', __FILE__ );
define( 'LP_ADDON_OFFLINE_PAYMENT_VER', '3.0.1' );
define( 'LP_ADDON_OFFLINE_PAYMENT_REQUIRE_VER', '3.0.0' );


/**
 * Class LP_Addon_Offline_Payment_Preload
 */
class LP_Addon_Offline_Payment_Preload {

	/**
	 * LP_Addon_Offline_Payment_Preload constructor.
	 */
	public function __construct() {
		add_action( 'learn-press/ready', array( $this, 'load' ) );
		add_action( 'admin_notices', array( $this, 'admin_notices' ) );
	}

	/**
	 * Load addon
	 */
	public function load() {
		LP_Addon::load( 'LP_Addon_Offline_Payment', 'inc/load.php', __FILE__ );
		remove_action( 'admin_notices', array( $this, 'admin_notices' ) );
	}

	/**
	 * Admin notice
	 */
	public function admin_notices() {
		?>
        <div class="error">
            <p><?php echo wp_kses(
					sprintf(
						__( '<strong>%s</strong> addon version %s requires %s version %s or higher is <strong>installed</strong> and <strong>activated</strong>.', 'learnpress-offline-payment' ),
						__( 'LearnPress Offline Payment', 'learnpress-offline-payment' ),
						LP_ADDON_OFFLINE_PAYMENT_VER,
						sprintf( '<a href="%s" target="_blank"><strong>%s</strong></a>', admin_url( 'plugin-install.php?tab=search&type=term&s=learnpress' ), __( 'LearnPress', 'learnpress-offline-payment' ) ),
						LP_ADDON_OFFLINE_PAYMENT_REQUIRE_VER
					),
					array(
						'a'      => array(
							'href'  => array(),
							'blank' => array()
						),
						'strong' => array()
					)
				); ?>
            </p>
        </div>
		<?php
	}
}

new LP_Addon_Offline_Payment_Preload();