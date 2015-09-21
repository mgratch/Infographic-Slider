<?php
/**
 * Plugin Name: GP Reload Form
 * Description: Reload the form following an AJAX submission. Useful in situations where you would like to allow multiple form submission with refreshing the page.
 * Plugin URI: http://gravitywiz.com/
 * Version: 1.1.8
 * Author: David Smith
 * Author URI: http://gravitywiz.com/
 * License: GPL2
 * Perk: True
 */

/**
 * Saftey net for individual perks that are active when core Gravity Perks plugin is inactive.
 */
$gw_perk_file = __FILE__;
if(!require_once(dirname($gw_perk_file) . '/safetynet.php'))
	return;

class GWReloadForm extends GWPerk {

	public $version = '1.1.8';

	protected $min_gf_version = '1.7.10.1';

	public function init() {

		add_filter( 'gform_enqueue_scripts', array( $this, 'enqueue_form_scripts' ), 10, 2 );
		add_filter( 'gform_register_init_scripts', array( $this, 'register_init_scripts' ), 10, 2 );
		add_filter( 'gform_admin_pre_render', array( $this, 'add_merge_tag_support' ) );
		add_filter( 'gform_replace_merge_tags', array( $this, 'reload_form_replace_merge_tag' ), 10, 2 );

		add_filter( 'gform_form_settings', array( $this, 'form_settings_ui' ), 10, 2 );
		add_filter( 'gform_pre_form_settings_save', array( $this, 'save_form_settings' ) );

		$this->add_tooltip( $this->key( 'enable' ), '<h6>' . __( 'Automatically Reload Form', 'gravityperks' ) . '</h6>' . __( 'Automatically reload the form after it has been submitted.', 'gravityperks' ) );
		$this->add_tooltip( $this->key( 'refresh_time' ), '<h6>' . __( 'Seconds Until Reload', 'gravityperks') . '</h6>' . __( 'Specify how many seconds the confirmation message should be displayed before automatically reloading the form.', 'gravityperks' ) );

	}

	public function form_settings_ui( $form_settings, $form ) {

		$keys = array(
			'enable' => $this->key( 'enable' ),
			'refresh_time' => $this->key( 'refresh_time' )
		);
		$display = ! rgar( $form, $keys['enable'] ) ? 'display:none;' : '';

		ob_start();
		?>

		<tr class="gp-form-setting">

			<th>
				<label for="<?php echo $keys['enable']; ?>">
					<?php _e( 'Automatically Reload Form', 'gravityperks' ); ?>
					<?php gform_tooltip( $keys['enable'] ); ?>
				</label>
			</th>
			<td>

				<input type="checkbox" id="<?php echo $keys['enable']; ?>" name="<?php echo $keys['enable']; ?>" value="1" <?php checked( rgar( $form, $keys['enable'] ), true ); ?> />
				<label for="<?php echo $keys['enable']; ?>">
					<?php _e( 'Automatically Reload Form', 'gravityperks' ); ?>
					<?php gform_tooltip( $keys['enable'] ); ?>
				</label>

				<div id="<?php echo $this->key( 'settings' ); ?>" style="margin-top:10px;<?php echo $display; ?>">

					<label for="<?php echo $keys['refresh_time']; ?>" style="display:block;">
						<?php _e( 'Seconds Until Reload', 'gravityperks' ); ?> <?php gform_tooltip( $keys['refresh_time'] ) ?></label>
					<input type="number" id="<?php echo $keys['refresh_time']; ?>" name="<?php echo $keys['refresh_time']; ?>" value="<?php echo rgar( $form, $keys['refresh_time'] ); ?>">

				</div>

				<?php $this->form_settings_js( $keys ); ?>

			</td>

		</tr>

		<?php

		$section_label = __( 'GP Reload Form', 'gravityperks' );
		$form_settings[$section_label] = array( $this->slug => ob_get_clean() );

		return $form_settings;
	}

	public function form_settings_js( $keys ) {
		?>

		<script type="text/javascript">

			(function($){

				// # UI EVENTS

				$( '#<?php echo $keys['enable']; ?>' ).click(function(){
					toggleSettings( $(this).is(':checked') );
				});

				// # HELPERS

				function toggleSettings( isChecked ) {

					var enableCheckbox = jQuery('#<?php echo $keys['enable']; ?>');
					var settingsContainer = jQuery('#<?php echo $this->key( 'settings' ); ?>');

					if( isChecked ) {
						enableCheckbox.prop( 'checked', true );
						settingsContainer.slideDown();
					} else {
						enableCheckbox.prop( 'checked', false );
						settingsContainer.slideUp();
					}

				}

			})(jQuery);

		</script>

	<?php
	}

	public function save_form_settings( $form ) {
		$form[$this->key( 'enable' )] = rgpost( $this->key( 'enable' ) );
		$form[$this->key( 'refresh_time' )] = $form[$this->key( 'enable' )] ? rgpost( $this->key( 'refresh_time' ) ) : '';
		return $form;
	}

	public function enqueue_form_scripts( $form ) {

		if( $this->is_applicable_form( $form ) ) {
			wp_enqueue_script( 'gpreloadform', $this->get_base_url() . '/scripts/gp-reload-form.js', array( 'jquery' ), $this->version );
		}

	}

	public function register_init_scripts( $form ) {

		if( ! $this->is_applicable_form( $form ) ) {
			return;
		}

		$spinner_url  = apply_filters( "gform_ajax_spinner_url_{$form['id']}", apply_filters( 'gform_ajax_spinner_url', GFCommon::get_base_url() . '/images/spinner.gif', $form ), $form );
		$refresh_time = rgar( $form, $this->key( 'refresh_time' ) );

		$args = array(
			'formId'      => $form['id'],
			'spinnerUrl'  => $spinner_url,
			'refreshTime' => $refresh_time ? $refresh_time : 0
		);

		$script = 'window.gwrf_' . $form['id'] . ' = new gwrf( ' . json_encode( $args ) . ' );';
        $slug   = sprintf( 'gpreloadform_%d', $form['id'] );

        GFFormDisplay::add_init_script( $form['id'], $slug, GFFormDisplay::ON_PAGE_RENDER, $script );

	}

	/**
	 * Adds field merge tags to the merge tag drop downs.
	 */
	function add_merge_tag_support( $form ) {
		?>

		<script type="text/javascript">

			gform.addFilter( 'gform_merge_tags', 'gprfMergeTags' );

			function gprfMergeTags( mergeTags, elementId, hideAllFields, excludeFieldTypes, isPrepop, option ) {

				if( elementId == 'form_confirmation_message' ) {
					mergeTags.ungrouped.tags.push( {
						label: '<?php _e( 'Reload Form Link', 'gravityperks' ); ?>',
						tag: '{reload_form}'
					} );
				}

				return mergeTags;
			}

		</script>

		<?php
		return $form;
	}

	public function reload_form_replace_merge_tag($text, $form) {

		preg_match_all('/{(reload_form):?([\s\w.,!?\'"]*)}/mi', $text, $matches, PREG_SET_ORDER);

		if(empty($matches))
			return $text;

		$link_text = rgar($matches[0], 2) ? rgar($matches[0], 2) : 'Reload Form';
		$reload_link = '<a href="" class="gws-reload-form">' . $link_text . '</a>';
		$text = str_replace(rgar($matches[0], 0), $reload_link, $text);

		return $text;
	}

	public function is_applicable_form( $form ) {

		if( rgar( $form, $this->key( 'enable' ) ) ) {
			return true;
		}

		foreach( $form['confirmations'] as $confirmation ) {
			if( $this->has_merge_tag( 'reload_form', rgar( $confirmation, 'message' ) ) ) {
				return true;
			}
		}

		return false;
	}

	function documentation() {
		return array( 'type' => 'url', 'value' => 'http://gravitywiz.com/documentation/gp-reload-form/' );
	}

}