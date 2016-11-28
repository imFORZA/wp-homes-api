<?php
/**
 * WP-Homes-API
 *
 * @package WP-Homes-API
 */

/*
* Plugin Name: WP Homes API
* Plugin URI: https://github.com/wp-api-libraries/wp-homes-api
* Description: Perform API requests to Homes in WordPress.
* Author: WP API Libraries
* Version: 1.0.0
* Author URI: https://wp-api-libraries.com
* GitHub Plugin URI: https://github.com/wp-api-libraries/wp-homes-api
* GitHub Branch: master
*/

/* Exit if accessed directly. */
if ( ! defined( 'ABSPATH' ) ) { exit; }


/* Check if class exists. */
if ( ! class_exists( 'HomesAPI' ) ) {

	/**
	 * Homes API Class.
	 */
	class HomesAPI {

		/**
		 * Construct.
		 *
		 * @access public
		 * @return void
		 */
		public function __construct() {

		}

		/**
		 * Fetch the request from the API.
		 *
		 * @access private
		 * @param mixed $request Request URL.
		 * @return $body Body.
		 */
		private function fetch( $request ) {

			$response = wp_remote_get( $request );
			$code = wp_remote_retrieve_response_code( $response );

			if ( 200 !== $code ) {
				return new WP_Error( 'response-error', sprintf( __( 'Server response code: %d', 'text-domain' ), $code ) );
			}

			$body = wp_remote_retrieve_body( $response );

			return json_decode( $body );

		}


		/**
		 * Get Homes Property Info from URL.
		 *
		 * @access public
		 * @param mixed $url URL.
		 * @return Request.
		 */
		function get_property_info( $url ) {

			if ( empty( $url ) ) {
				return new WP_Error( 'required-fields', __( 'Please provide a URL.', 'text-domain' ) );
			}

			$explode = explode('/', $url);

			// var_dump($explode);

			// return $explode['4'];

			$response = file_get_contents( $url  );

			// $body = wp_remote_retrieve_body( $response );

			var_dump($response);

			/*
			TODO: This funtion should return the following as JSON array:
			* Homes Property ID
			* Street Address
			* City
			* State
			* Zip Code
			* Example urls:
			* http://www.homes.com/property/636-california-st-el-segundo-ca-90245/id-100008918489/
			*/
		}

		/**
		 * Get Agent/Team Screenname from URL.
		 *
		 * @access public
		 * @param mixed $profile_url URL.
		 * @return void
		 */
		function get_agent_id( $url ) {

			if ( empty( $url ) ) {
				return new WP_Error( 'required-fields', __( 'Please provide a URL.', 'text-domain' ) );
			}

			$explode = explode('/', $url);

			var_dump($explode);

			/*
			TODO: This function should return an array with the following as JSON array:
			* Agent Name
			* Homes Agent Unique String
			* Agent City
			* Agent State
			* Example URLS:
			* http://www.homes.com/real-estate-agents/phyllis-boyd-desmond/id-998848/
			*/

		}
	}
}
