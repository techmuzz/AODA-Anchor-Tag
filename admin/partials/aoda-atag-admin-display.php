<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://www.techmuzz.com
 * @since      1.0.0
 *
 * @package    Aoda_Atag
 * @subpackage Aoda_Atag/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap">

    <h2><?php echo esc_html( get_admin_page_title() ); ?></h2>

    <form method="post" name="cleanup_options" action="options.php">

    <?php
        //Grab all options
        $options = get_option($this->plugin_name);

        $switch = $options['switch'];
        $domains = $options['domains'];
        $element = $options['element'];
    ?>

    <?php
        settings_fields($this->plugin_name);
        do_settings_sections($this->plugin_name);
    ?>

    <!-- switch -->
    <fieldset>
        <legend class="screen-reader-text">
            <span>Check to turn it on</span>
        </legend>
        <label for="<?php echo $this->plugin_name; ?>-cleanup">
            <input type="checkbox" id="<?php echo $this->plugin_name; ?>-switch" name="<?php echo $this->plugin_name; ?>[switch]" value="1" <?php checked($switch, 1); ?> />
            <span><?php esc_attr_e('Switch to turn on or off', $this->plugin_name); ?></span>
        </label>
    </fieldset>

    <!-- domains to exclude -->
    <fieldset>
        <p>Give comma seperated domains to exclude</p>
        <legend class="screen-reader-text"><span><?php _e('Domains to exclude', $this->plugin_name); ?></span></legend>
        <textarea class="regular-text" id="<?php echo $this->plugin_name; ?>-domains" name="<?php echo $this->plugin_name; ?>[domains]" ><?php if(!empty($domains)) echo $domains; ?></textarea>
    </fieldset>

    <!-- element to append -->
    <fieldset>
        <p>HTML element to append to anchor content</p>
        <legend class="screen-reader-text"><span><?php _e('HTML element', $this->plugin_name); ?></span></legend>
        <textarea class="regular-text" id="<?php echo $this->plugin_name; ?>-element" name="<?php echo $this->plugin_name; ?>[element]" ><?php if(!empty($element)) echo $element; ?></textarea>
    </fieldset>

    <?php submit_button('Save all changes', 'primary','submit', TRUE); ?>

    </form>

</div>