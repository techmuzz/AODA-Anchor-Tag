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
<div id="ajax-saving">
    <img src="<?php echo plugin_dir_url( dirname( __FILE__ ) ) . 'images/ajax-loader.gif'; ?>" alt="loading" id="loading" />
</div>
<div class="aoda-atag-content">
    <div class="form-v1-content">
        <div class="wizard-form">
            <form class="form-register" id="aoda-atag-options" method="post" name="aoda_atag_options" action="options.php">
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
                <input type="hidden" id="siteUrl" name="<?php echo $this->plugin_name;?>[siteUrl]" value="<?php echo parse_url(get_home_url(), PHP_URL_HOST); ?>" />
                <div id="form-total">
                    <!-- SECTION 1 -->
                    <h2>
                        <span class="step-text">Configure Anchor tag</span>
                    </h2>
                    <section>
                        <div class="inner">
                            <div class="wizard-header">
                                <h3 class="heading">Configure Anchor tag</h3>
                                <p>Choose options to update anchor tag in post/article.</p>
                            </div>
                            <div class="form-row">
                                <div class="form-holder form-holder-2">
                                    <fieldset>
                                        <legend>Target</legend>
                                        <select id="<?php echo $this->plugin_name; ?>-target" name="<?php echo $this->plugin_name; ?>[target]" >
                                            <option value="-1" <? echo (($target=="-1") ? "selected" : ""); ?>>Select Target</option>
                                            <option value="_blank" <? echo ($target=="_blank" ? "selected" : ""); ?>>_blank</option>
                                            <option value="_self" <? echo ($target=="_self" ? "selected" : ""); ?>>_self</option>
                                            <option value="_parent" <? echo ($target=="_parent" ? "selected" : ""); ?>>_parent</option>
                                            <option value="_top" <? echo ($target=="_top" ? "selected" : ""); ?>>_top</option>
                                            <option value="framename" <? echo ($target=="framename" ? "selected" : ""); ?>>framename</option>
                                        </select>
                                    </fieldset>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-holder form-holder-2">
                                    <fieldset>
                                        <legend>Exclude Domains</legend>
                                        <label>Note: All internal links are excluded by default</label>
                                        <textarea id="<?php echo $this->plugin_name; ?>-domains" name="<?php echo $this->plugin_name; ?>[domains]" placeholder="Give domains to exclude as seperate line. Current site's domain is already included (<?php echo parse_url(get_home_url(), PHP_URL_HOST); ?>)"><?php if(!empty($domains)) echo $domains; ?></textarea>
                                    </fieldset>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-holder form-holder-2">
                                    <fieldset>
                                        <legend>HTML to append</legend>
                                        <textarea id="<?php echo $this->plugin_name; ?>-element" name="<?php echo $this->plugin_name; ?>[element]" placeholder='<img src="https://techmuzz.com/favicon.ico" />' ><?php if(!empty($element)) echo $element; ?></textarea>
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- SECTION 2 -->
                    <h2>
                        <span class="step-text">Preview & Apply</span>
                    </h2>
                    <section>
                        <div class="inner">
                            <div class="wizard-header">
                                <h3 class="heading">Preview & Apply</h3>
                                <p>Note: CSS in your website can impact the output.</p>
                            </div>
                            <div class="form-row">
                                <div class="form-holder form-holder-2">
                                    <fieldset>
                                        <legend>Example Text</legend>
                                        <p id="exampleText">This is the best <a href="https://www.google.com" target="_blank">website</a> in this world.</p>
                                    </fieldset>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-holder form-holder-2">
                                    <fieldset>
                                        <legend>Output Text</legend>
                                        <p id="outputText">This is the best <a href="https://www.google.com" target="_blank">website</a> in this world.</p>
                                    </fieldset>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-holder">
                                    <fieldset>
                                        <legend>Apply Changes</legend>
                                        <label class="switch">
                                            <input type="checkbox" id="<?php echo $this->plugin_name; ?>-switch" name="<?php echo $this->plugin_name; ?>[switch]" value="1" <?php checked($switch, 1); ?> />
                                            <span class="slider round"></span>
                                        </label>
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </form>
        </div>
    </div>
</div>