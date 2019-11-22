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
        $target = $options['target'];
    ?>

    <?php
        settings_fields($this->plugin_name);
        do_settings_sections($this->plugin_name);
    ?>

    <!-- hidden fields -->
    <fieldset>
        <input type="hidden" id="siteUrl" name="<?php echo $this->plugin_name;?>[siteUrl]" value="<?php echo parse_url(get_home_url(), PHP_URL_HOST); ?>" />
    </fieldset>

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

    <!-- override anchor tag target attribute -->
    <fieldset>
        <p>Select target for anchor tag target attribute to override</p>
        <legend class="screen-reader-text"><span><?php _e('Override Target attribute', $this->plugin_name); ?></span></legend>
        <select class="regular-text" id="<?php echo $this->plugin_name; ?>-target" name="<?php echo $this->plugin_name; ?>[target]" >
            <option value="-1" <? echo (($target=="-1") ? "selected" : ""); ?>>Select Target</option>
            <option value="_blank" <? echo ($target=="_blank" ? "selected" : ""); ?>>_blank</option>
            <option value="_self" <? echo ($target=="_self" ? "selected" : ""); ?>>_self</option>
            <option value="_parent" <? echo ($target=="_parent" ? "selected" : ""); ?>>_parent</option>
            <option value="_top" <? echo ($target=="_top" ? "selected" : ""); ?>>_top</option>
            <option value="framename" <? echo ($target=="framename" ? "selected" : ""); ?>>framename</option>
        </select>
    </fieldset>

    <!-- domains to exclude -->
    <fieldset>
        <p>Give domains to exclude as seperate line. Current site's domain is already included (<?php echo parse_url(get_home_url(), PHP_URL_HOST); ?>)</p>
        <legend class="screen-reader-text"><span><?php _e('Domains to exclude', $this->plugin_name); ?></span></legend>
        <textarea class="regular-text" id="<?php echo $this->plugin_name; ?>-domains" name="<?php echo $this->plugin_name; ?>[domains]" ><?php if(!empty($domains)) echo $domains; ?></textarea>
    </fieldset>

    <!-- element to append -->
    <fieldset>
        <p>HTML element to append to anchor content</p>
        <legend class="screen-reader-text"><span><?php _e('HTML element', $this->plugin_name); ?></span></legend>
        <textarea class="regular-text" id="<?php echo $this->plugin_name; ?>-element" name="<?php echo $this->plugin_name; ?>[element]" placeholder='<img src="https://techmuzz.com/favicon.ico" />' ><?php if(!empty($element)) echo $element; ?></textarea>
        <h3>Example</h3><input id="refreshExampleButton" type="button" class="button" value="<?php _e( 'Refresh Example', $this->plugin_name); ?>" />
        <p id="exampleText">This is the best <a href="https://www.google.com" target="_blank">website</a> in this world.</p>
        <p id="outputText">This is the best <a href="https://www.google.com">website</a> in this world.</p>
    </fieldset>

    <?php submit_button('Save changes', 'primary','submit', TRUE); ?>

    </form>

</div>