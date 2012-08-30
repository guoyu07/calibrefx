<?php

/**
 * CalibreFx
 *
 * WordPress Themes Framework by CalibreWorks Team
 *
 * @package		CalibreFx
 * @author		CalibreWorks Team
 * @copyright           Copyright (c) 2012, Suntech Inti Perkasa.
 * @license		Commercial
 * @link		http://www.calibrefx.com
 * @since		Version 1.0
 * @filesource 
 *
 * WARNING: This file is part of the core CalibreFx framework. DO NOT edit
 * this file under any circumstances. 
 *
 * This File will handle admin area settings dashboard
 *
 * @package CalibreFx
 */
abstract class CFX_Admin {

    /**
     * Hold pagehook value when menu is registered
     *
     * @var string
     */
    public $pagehook;

    /**
     * ID of the admin menu and settings page.
     *
     * @var string
     */
    public $page_id;

    /**
     * Name of the settings field in the options table.
     *
     * @var string
     */
    public $settings_field;

    /**
     * Hold default settings of the settings option
     *
     * @var string
     */
    public $default_settings;
    
    /**
     * Hold model object
     *
     * @var object
     */
    public $_model;

    /**
     * Initialize our admin area
     * 
     */
    public function initialize() {

        $this->settings_field = $this->_model->get_settings_field();
        
        //define our security filter
        $this->security_filters();
        
        add_action('admin_init', array($this, 'register_settings'));
        add_action('admin_notices', array($this, 'notices'));
        add_action('admin_init', array($this, 'settings_init'));

        /** Add a sanitizer/validator */
        add_filter('pre_update_option_' . $this->settings_field, array(&$this, 'save'), 10, 2);
    }

    /**
     * Register Our Security Filters
     *
     * $return void
     */
    abstract public function security_filters();
    
    /**
     * Register our meta boxes
     *
     * $return null
     */
    abstract public function meta_boxes();

    /**
     * Register our meta sections
     *
     * $return null
     */
    abstract public function meta_sections();

    /**
     * Save our settings option
     *
     * $return array
     */
    public function save($_newvalue, $_oldvalue) {
        //We merge newvalue and oldvalue
        if (calibrefx_get_option('reset', $this->_model)) {
            return $_newvalue;
        }
        
        //Get the value from post settings
        $_newvalue = $_POST[$this->settings_field];
        
        //merge value from old settings
        $_newvalue = array_merge($_oldvalue, $_newvalue);
        
        //We merge with default value too
        $_newvalue = array_merge((array)$this->default_settings, $_newvalue);

        if(!empty($_newvalue)){
            //We sanitizing
            $CFX = & calibrefx_get_instance();
            $_newvalue = $CFX->security->sanitize_input($this->settings_field, $_newvalue);
        }
        
        return $_newvalue;
    }

    /**array_merge
     * Register the settings option in wp_options.
     *
     * @return null Returns early if not on the correct admin page.
     */
    public function register_settings() {

        /** If this page doesn't store settings, no need to register them */
        if (!$this->settings_field)
            return;

        register_setting($this->settings_field, $this->settings_field);
        add_option($this->settings_field, $this->default_settings);

        if (!isset($_REQUEST['page']) || $_REQUEST['page'] != $this->page_id)
            return;

        if (calibrefx_get_option('reset', $this->_model)) {
            if (update_option($this->settings_field, $this->default_settings))
                calibrefx_admin_redirect($this->page_id, array('reset' => 'true'));
            else
                calibrefx_admin_redirect($this->page_id, array('error' => 'true'));
            exit;
        }
    }

    /**
     * Display notices on the save or reset of settings.
     *
     * @since 1.8.0
     *
     * @return null Returns early if not on the correct admin page.
     */
    public function notices() {

        if (!isset($_REQUEST['page']) || $_REQUEST['page'] != $this->page_id)
            return;

        if (isset($_REQUEST['settings-updated']) && $_REQUEST['settings-updated'] == 'true')
            echo '<div id="message" class="updated"><p><strong>' . __('Settings saved.', 'calibrefx') . '</strong></p></div>';
        elseif (isset($_REQUEST['reset']) && 'true' == $_REQUEST['reset'])
            echo '<div id="message" class="updated"><p><strong>' . __('Settings reset.', 'calibrefx') . '</strong></p></div>';
        elseif (isset($_REQUEST['error']) && $_REQUEST['error'] == 'true')
            echo '<div id="message" class="updated"><p><strong>' . __('Settings not saved. Error occured.', 'calibrefx') . '</strong></p></div>';
    }

    public function settings_init() {
        add_action('load-' . $this->pagehook, array($this, 'scripts'));
        add_action('load-' . $this->pagehook, array($this, 'styles'));
        add_action('load-' . $this->pagehook, array($this, 'meta_sections'));
        add_action('load-' . $this->pagehook, array($this, 'meta_boxes'));
    }

    public function scripts() {
        wp_enqueue_script('common');
        wp_enqueue_script('wp-lists');
        wp_enqueue_script('postbox');
    }

    public function styles() {
        wp_enqueue_style('calibrefx_admin_css');
    }

    public function dashboard() {
        global $calibrefx_sections, $calibrefx_current_section;
        
        ?>
        <div id="calibrefx-theme-settings-page" class="wrap calibrefx-metaboxes">
            <form method="post" action="options.php">
                <?php wp_nonce_field('closedpostboxes', 'closedpostboxesnonce', false); ?>
                <?php wp_nonce_field('meta-box-order', 'meta-box-order-nonce', false); ?>
                <?php settings_fields($this->settings_field); // important! ?>
                <input type="hidden" name="<?php echo $this->settings_field; ?>[calibrefx_version]>" value="<?php echo esc_attr(calibrefx_get_option('calibrefx_version', $this->_model)); ?>" />
                <input type="hidden" name="<?php echo $this->settings_field; ?>[calibrefx_db_version]>" value="<?php echo esc_attr(calibrefx_get_option('calibrefx_db_version', $this->_model)); ?>" />
                <div class="calibrefx-header">
                    <div class="calibrefx-option-logo">
                        <a target="_blank" href="http://www.calibrefx.com" title="CalibreFx v<?php echo FRAMEWORK_VERSION; ?>">&nbsp;</a>
                    </div>
                    <div class="calibrefx-version">
                        <span>v<?php calibrefx_option('calibrefx_version'); ?> ( Code Name : <?php echo FRAMEWORK_CODENAME; ?>)</span>
                    </div>
                    <div class="calibrefx-ability">
                        <a class="calibrefx-general" href="<?php echo admin_url("admin.php?page=calibrefx&ability=basic&section=" . $calibrefx_current_section); ?>"><?php _e('Basic', 'calibrefx'); ?></a>
                        <a class="calibrefx-professor" href="<?php echo admin_url("admin.php?page=calibrefx&ability=professor&section=" . $calibrefx_current_section); ?>"><?php _e('Professor', 'calibrefx'); ?></a>
                    </div>
                </div>
                <div class="calibrefx-content">
                    <div class="calibrefx-submit-button">
                        <input type="submit" class="button-primary calibrefx-h2-button" value="<?php _e('Save Settings', 'calibrefx') ?>" />
                        <input type="submit" class="button-highlighted calibrefx-h2-button" name="<?php echo $this->settings_field; ?>[reset]" value="<?php _e('Reset Settings', 'calibrefx'); ?>" onclick="return calibrefx_confirm('<?php echo esc_js(__('Are you sure you want to reset?', 'calibrefx')); ?>');" />
                    </div>
                    <div class="metabox-holder">
                        <div class="calibrefx-tab">
                            <ul class="calibrefx-tab-option">
                                <?php
                                foreach ($calibrefx_sections as $section) {
                                    $current_class = ($calibrefx_current_section === $section['slug']) ? 'class="current"' : '';
                                    $section_link = admin_url('admin.php?page=' . $this->page_id . '&section=' . $section['slug']);
                                    echo "<li $current_class><a href='$section_link'>" . $section['title'] . "</a><span></span></li>";
                                }
                                ?>
                            </ul>
                            <div class="calibrefx-option">
                                <h2><?php echo $calibrefx_sections[$calibrefx_current_section]['title']; ?></h2>
                                <div class="postbox-container main-postbox">
                                    <?php
                                    calibrefx_do_meta_sections($calibrefx_current_section, $this->pagehook, 'main', null);
                                    ?>
                                </div>

                                <div class="postbox-container side-postbox">
                                    <?php
                                    calibrefx_do_meta_sections($calibrefx_current_section, $this->pagehook, 'side', null);
                                    ?>
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </div>
                    <div class="calibrefx-submit-button calibrefx-bottom">
                        <input type="submit" class="button-primary calibrefx-h2-button" value="<?php _e('Save Settings', 'calibrefx') ?>" />
                        <input type="submit" class="button-highlighted calibrefx-h2-button" name="<?php echo $this->settings_field; ?>[reset]" value="<?php _e('Reset Settings', 'calibrefx'); ?>" onclick="return calibrefx_confirm('<?php echo esc_js(__('Are you sure you want to reset?', 'calibrefx')); ?>');" />
                    </div>

                </div>
            </form>
        </div>
        <script type="text/javascript">
            //<![CDATA[
            jQuery(document).ready( function($) {
                // close postboxes that should be closed
                $('.if-js-closed').removeClass('if-js-closed').addClass('closed');
                // postboxes setup
                postboxes.add_postbox_toggles('<?php echo $this->pagehook; ?>');
                            
                postboxes._mark_area = function() {
                    var visible = $('div.postbox:visible').length, side = $('#post-body #side-sortables');

                    $('#<?php echo $this->pagehook; ?> .meta-box-sortables:visible').each(function(n, el){
                        var t = $(this);

                        if ( visible == 1 || t.children('.postbox:visible').length )
                            t.removeClass('empty-container');
                        else
                            t.addClass('empty-container');
                    });

                    if ( side.length ) {
                        if ( side.children('.postbox:visible').length )
                            side.removeClass('empty-container');
                        else if ( $('#postbox-container-1').css('width') == '280px' )
                            side.addClass('empty-container');
                    }
                };
                postboxes._mark_area();
            });
            //]]>
        </script>
        <?php
    }

}