<?php

/**
 * The main plugin controller
 *
 * @package code.talks plugin Controller
 * @subpackage Main Plugin Controller
 * @since 0.1
 */

class CtCodeTalksController {
    var $version = '1.0';
    public static function good_nonce($nonce, $nonce_id) {
        if (!$nonce) {
            return false;
        }
        if (!wp_verify_nonce($nonce, $nonce_id)) {
            return false;
        }
        return true;
    }
    public function __construct() {
        add_action('wp', array($this, 'init'));
        add_action('wp_enqueue_scripts', array($this, 'register_styles'));
        add_action('wp_enqueue_scripts', array($this, 'register_scripts'));
    }

    function init() {
        add_shortcode('codetalks_logo', array($this, 'codetalks_logo_shortcode'));
    }

    public function register_styles() {
        wp_register_style('codetalks_ui_style', plugins_url("static/css/layout.css", dirname(__FILE__)), array(), $this->version, "all");
    }

    public function register_scripts() {
    }

    public function codetalks_logo_shortcode($attrs = array()) {
        wp_enqueue_style('codetalks_ui_style');
        $defaults = array();
        $options = shortcode_atts($defaults, $attrs);
        return $this->codetalks_logo_ui_html($options);
    }
    function codetalks_logo_ui_html($options) {
        $out = '
            <div id="codetalks-logo-div" class="codetalks-logo-div">
                Popcorn, Nachos und Code!
                <br/>
                Hamburg 29. und 30. September 2016 - <a class="codetalks-logo-link-a" href="https://www.codetalks.de" title="code.talks" target="_blank">code.talks</a>
                <br/>
                <a class="codetalks-logo-link-a codetalks-logo-link-a-with-image" href="https://www.codetalks.de" title="code.talks" target="_blank">
	                <img class="code-talks-logo-image" src='.plugins_url("static/images/codetalks-logo-2016-cymk-420x126.png", dirname(__FILE__)).' alt="code.talks" width="300" height="90" class="alignleft size-medium" />
                </a>
            </div>
            ';
        return $out;
    }
}
