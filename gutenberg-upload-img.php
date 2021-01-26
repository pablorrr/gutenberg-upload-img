<?php

/**
 * Plugin Name: Gutenberg Upload Img
 * Plugin URI: https://github.com/WordPress/gutenberg-examples
 * Description: This is a plugin demonstrating how to register new blocks for the Gutenberg editor.
 * Version: 1.1.0
 * Author: Pablozzz
 *
 */

defined( 'ABSPATH' ) || exit;

/**
 * Load all translations for our plugin from the MO file.
*/

class GutenbergUplImg{

    public function __construct()
    {
        add_action( 'init', [$this,'gutenberg_upl_img'] );
        add_action( 'init',[$this,'_gutenberg_img_upl_register_block']  );
    }


  public  function gutenberg_upl_img() {
        load_plugin_textdomain( 'gutenberg-examples', false, basename( __DIR__ ) . '/languages' );
    }

    /**
     * Registers all block assets so that they can be enqueued through Gutenberg in
     * the corresponding context.
     *
     * Passes translations to JavaScript.
     */
  public  function _gutenberg_img_upl_register_block() {

        if ( ! function_exists( 'register_block_type' ) ) {
            // Gutenberg is not active.
            return;
        }

        wp_register_script(
            'gutenberg-img-upl',
            plugins_url( 'block.js', __FILE__ ),
            array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor', 'underscore' ),
            filemtime( plugin_dir_path( __FILE__ ) . 'block.js' )
        );

        wp_register_style(
            'gutenberg-img-upl',
            plugins_url( 'style.css', __FILE__ ),
            array( ),
            filemtime( plugin_dir_path( __FILE__ ) . 'style.css' )
        );

        register_block_type( 'gutenberg-img-upl/gutenberg-img-upl', array(
            'style' => 'gutenberg-img-upl',
            'editor_script' => 'gutenberg-img-upl',
        ) );

        if ( function_exists( 'wp_set_script_translations' ) ) {
            /**
             * May be extended to wp_set_script_translations( 'my-handle', 'my-domain',
             * plugin_dir_path( MY_PLUGIN ) . 'languages' ) ). For details see
             * https://make.wordpress.org/core/2018/11/09/new-javascript-i18n-support-in-wordpress/
             */
            wp_set_script_translations( 'gutenberg-img-upl', 'gutenberg-examples' );
        }

    }
}
$GutenbergUplImg = new GutenbergUplImg();
