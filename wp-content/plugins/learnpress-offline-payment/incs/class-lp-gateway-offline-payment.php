<?php

/**
 * Class LP_Gateway_Offline_Payment
 *
 * @extend LP_Gateway_Abstract
 */
class LP_Gateway_Offline_Payment extends LP_Gateway_Abstract {
	/**
	 * Constructor for the gateway.
	 */
	public function __construct() {
		$this->id                 = 'offline-payment';
		$this->icon               = apply_filters( 'learn_press_offline_payment_icon', '' );
		$this->method_title       = __( 'Offline Payment', 'learn_press' );
		$this->method_description = __( 'Make a payment with cash.', 'learnpress-offline-payment' );

		// Get settings
		$this->title        = $this->_get( 'title', $this->method_title );
		$this->description  = $this->_get( 'description', $this->method_description );
		$this->instructions = $this->_get( 'instructions' );

		add_action( 'learn_press_section_payments_' . $this->id, array( $this, 'payment_settings' ) );
		add_action( 'learn_press_order_received', array( $this, 'instructions' ), 99 );
		add_filter( 'learn_press_payment_gateway_available_' . $this->id, array( $this, 'is_available' ) );
	}

	protected function _get( $name ) {
		return LP()->settings->get( $this->id . '.' . $name );
	}

	function is_available() {
		return $this->_get( 'enable' ) == 'yes';
	}

	function take_course() {
		_deprecated_function( __FUNCTION__, '1.0' );
		if ( $transaction_object = learn_press_generate_transaction_object() ) {
			$user = learn_press_get_current_user();

			$order_id = learn_press_add_transaction(
				array(
					'order_id'           => 0,
					'method'             => $this->slug,
					'method_id'          => 0,
					'status'             => 'Pending',
					'user_id'            => $user->ID,
					'transaction_object' => $transaction_object
				)
			);
			learn_press_add_message( 'success', __( 'Thank you! Your order has been completed!', 'learnpress-offline-payment' ) );
			learn_press_send_json(
				array(
					'result'   => 'success',
					'redirect' => learn_press_get_order_confirm_url( $order_id )
				)
			);

		}
		return array(
			'result'   => 'error',
			'redirect' => ''
		);
	}

	/**
	 * Process the payment and return the result
	 *
	 * @param int $order_id
	 *
	 * @return array
	 */
	public function process_payment( $order_id ) {

		$order = learn_press_get_order( $order_id );

		// Mark as processing (payment won't be taken until delivery)
		$order->update_status( 'processing', __( 'Payment to be made upon delivery.', 'learnpress-offline-payment' ) );


		// Remove cart
		LP()->cart->empty_cart();

		// Return thankyou redirect
		return array(
			'result'   => 'success',
			'redirect' => $this->get_return_url( $order )
		);
	}

	/**
	 * Output for the order received page.
	 */
	public function instructions( $order ) {
		if ( $order && ( $this->id == $order->payment_method ) && $this->instructions ) {
			echo stripcslashes( wpautop( wptexturize( $this->instructions ) ) );
		}
	}

	private function _get_field_name( $name ) {
		return $this->id . $name;
	}

	function get_settings() {
		$settings = new LP_Settings_Base();
		return
			array(
				array(
					'title'   => __( 'Enable', 'learnpress-offline-payment' ),
					'id'      => $settings->get_field_name( $this->id . '[enable]' ),
					'default' => 'no',
					'type'    => 'checkbox'
				),
				array(
					'title'   => __( 'Title', 'learnpress-offline-payment' ),
					'id'      => $settings->get_field_name( $this->id . '[title]' ),
					'default' => $this->title,
					'type'    => 'text',
					'class'   => 'regular-text'
				),
				array(
					'title'   => __( 'Description', 'learnpress-offline-payment' ),
					'id'      => $settings->get_field_name( $this->id . '[description]' ),
					'default' => $this->description,
					'type'    => 'textarea',
					'editor'  => array( 'textarea_rows' => 5 )
				),
				array(
					'title'   => __( 'Instructions', 'learnpress-offline-payment' ),
					'id'      => $settings->get_field_name( $this->id . '[instructions]' ),
					'default' => '',
					'type'    => 'textarea',
					'editor'  => array( 'textarea_rows' => 10 ),
					'desc'    => __( 'Some instructions to user, e.g: What need to do next in order to complete the order.', 'learnpress-offline-payment' )
				),
			);
	}

	function payment_settings() {
		$settings = new LP_Settings_Base();
		foreach ( $this->get_settings() as $field ) {
			$settings->output_field( $field );
		}
	}

	function get_payment_form() {
		return $this->_get( 'description' );
	}

	static function add_payment( $gateways ) {
		$gateways['offline-payment'] = 'LP_Gateway_Offline_Payment';
		return $gateways;
	}
}
