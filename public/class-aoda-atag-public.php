<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.techmuzz.com
 * @since      1.0.0
 *
 * @package    Aoda_Atag
 * @subpackage Aoda_Atag/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Aoda_Atag
 * @subpackage Aoda_Atag/public
 * @author     TechMuzz <techmuzz@gmail.com>
 */
class Aoda_Atag_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Aoda_Atag_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Aoda_Atag_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/aoda-atag-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Aoda_Atag_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Aoda_Atag_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/aoda-atag-public.js', array( 'jquery' ), $this->version, false );

	}

	public static function getHost($address) {
		$parseUrl = parse_url(trim($address));
		return str_ireplace('www.', '', trim($parseUrl['host'] ? $parseUrl['host'] : array_shift(explode('/', $parseUrl['path'], 2))));
	}

	public static function appendHTML(DOMNode $parent, $source) {
		$tmpDoc = new DOMDocument();
		$tmpDoc->loadHTML($source);
		foreach ($tmpDoc->getElementsByTagName('body')->item(0)->childNodes as $node) {
			$node = $parent->ownerDocument->importNode($node, true);
			$parent->appendChild($node);
		}
		return $parent;
	}

	public function aoda_atag_the_content( $content ) {
		$options = get_option($this->plugin_name);

		if($options['switch']) {
			$domains = explode("\n", $options['domains']);
			$domains = array_filter($domains); //will filter empty values
			$domains = array_map("self::getHost", $domains);
			$domains[] = self::getHost(get_home_url());

			if(!empty($domains)) {
				$element = html_entity_decode($options['element']);
				$target = $options['target'];
				$dom = new DOMDocument;
				@$dom->loadHTML($content);
				
				foreach ($dom->getElementsByTagName('a') as $anchorTag){
					$host = self::getHost($anchorTag->getAttribute('href'));
					if(!in_array($host, $domains)) {
						if ($target != "-1") $anchorTag->setAttribute('target', $target);
						self::appendHTML($anchorTag, $element);
					}
				}
				$content = $dom->saveHtml();
			}
		}
		return $content;
	}

}
