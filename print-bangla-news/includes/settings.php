<?php
/**
 * Generated by the WordPress Option Page generator
 * at http://jeremyhixon.com/wp-tools/option-page/
 */

class PrintOptions {
    private $print_Options_options;

    public function __construct() {
        add_action( 'admin_menu', array( $this, 'print_Options_add_plugin_page' ) );
        add_action( 'admin_init', array( $this, 'print_Options_page_init' ) );
    }

    public function print_Options_add_plugin_page() {
        add_menu_page(
            'Print Options', // page_title
            'Print Options', // menu_title
            'manage_options', // capability
            'print-Options', // menu_slug
            array( $this, 'print_Options_create_admin_page' ), // function
            'dashicons-printer', // icon_url
            2 // position
        );
    }

    public function print_Options_create_admin_page() {
        $this->print_Options_options = get_option( 'print_Options_option_name' ); ?>

        <div class="wrap">
            <h2>Print Options</h2>
            <p></p>
            <?php settings_errors(); ?>

            <form method="post" class="print-option-form" action="options.php">
                <?php
                    settings_fields( 'print_Options_option_group' );
                    do_settings_sections( 'print-Options-admin' );
                    submit_button();
                ?>
            </form>
        </div>
    <?php }

    public function print_Options_page_init() {
        register_setting(
            'print_Options_option_group', // option_group
            'print_Options_option_name', // option_name
            array( $this, 'print_Options_sanitize' ) // sanitize_callback
        );

        add_settings_section(
            'print_Options_setting_section', // id
            'Settings', // title
            array( $this, 'print_Options_section_info' ), // callback
            'print-Options-admin' // page
        );

        add_settings_field(
            'header_banner_0', // id
            'Header Banner', // title
            array( $this, 'header_banner_0_callback' ), // callback
            'print-Options-admin', // page
            'print_Options_setting_section' // section
        );

        add_settings_field(
            'editor_information_1', // id
            'Editor Information', // title
            array( $this, 'editor_information_1_callback' ), // callback
            'print-Options-admin', // page
            'print_Options_setting_section' // section
        );

        add_settings_field(
            'copyright_2', // id
            'Copyright', // title
            array( $this, 'copyright_2_callback' ), // callback
            'print-Options-admin', // page
            'print_Options_setting_section' // section
        );

        add_settings_field(
            'design_3', // id
            'Print Page Style', // title
            array( $this, 'design_3_callback' ), // callback
            'print-Options-admin', // page
            'print_Options_setting_section' // section
        );

        add_settings_field(
            'epaper_col_4', // id
            'Epaper Colum', // title
            array( $this, 'epaper_col_4_callback' ), // callback
            'print-Options-admin', // page
            'print_Options_setting_section' // section
        );
    }

    public function print_Options_sanitize($input) {
        $sanitary_values = array();
        if ( isset( $input['header_banner_0'] ) ) {
            $sanitary_values['header_banner_0'] = sanitize_text_field( $input['header_banner_0'] );
        }

        if ( isset( $input['editor_information_1'] ) ) {
            $sanitary_values['editor_information_1'] = esc_textarea( $input['editor_information_1'] );
        }

        if ( isset( $input['copyright_2'] ) ) {
            $sanitary_values['copyright_2'] = sanitize_text_field( $input['copyright_2'] );
        }

        if ( isset( $input['design_3'] ) ) {
            $sanitary_values['design_3'] = $input['design_3'];
        }
        if ( isset( $input['epaper_col_4'] ) ) {
            $sanitary_values['epaper_col_4'] = $input['epaper_col_4'];
        }

        return $sanitary_values;
    }

    public function print_Options_section_info() {
        
    }

    public function header_banner_0_callback() {
        $input = '<img id="pv_d" src=""> <br>' ;
    $input .= '<input id="upload_image_button" type="button" class="button-primary" value="Insert Image" /> <input id="remove-banner" type="button" class="button-danger button-primary" value="Remove" />';
        printf(
            '<input class="regular-text" type="hidden" name="print_Options_option_name[header_banner_0]" id="header_banner_0" value="%s"> <br>'.$input,
            isset( $this->print_Options_options['header_banner_0'] ) ? esc_attr( $this->print_Options_options['header_banner_0']) : ''
        );
    }

    public function editor_information_1_callback() {
        printf(
            '<textarea class="large-text" rows="5" name="print_Options_option_name[editor_information_1]" id="editor_information_1">%s</textarea>',
            isset( $this->print_Options_options['editor_information_1'] ) ? esc_attr( $this->print_Options_options['editor_information_1']) : ''
        );
    }

    public function copyright_2_callback() {

        printf(
            '<input class="regular-text" type="text" name="print_Options_option_name[copyright_2]" id="copyright_2" value="%s">',
            isset( $this->print_Options_options['copyright_2'] ) ? esc_attr( $this->print_Options_options['copyright_2']) : ''
        );
    }

    public function design_3_callback() {
        ?> <select name="print_Options_option_name[design_3]" id="design_3">
            <?php $selected = (isset( $this->print_Options_options['design_3'] ) && $this->print_Options_options['design_3'] === 'online') ? 'selected' : '' ; ?>
            <option value="online" <?php echo $selected; ?>> Online Style</option>
            <?php $selected = (isset( $this->print_Options_options['design_3'] ) && $this->print_Options_options['design_3'] === 'epaper') ? 'selected' : '' ; ?>
            <option value="epaper" <?php echo $selected; ?>> Epaper Style</option>
        </select> <?php
    }

    public function epaper_col_4_callback() {
        ?> <select name="print_Options_option_name[epaper_col_4]" id="design_3">
            <?php $selected = (isset( $this->print_Options_options['epaper_col_4'] ) && $this->print_Options_options['epaper_col_4'] === '2') ? 'selected' : '' ; ?>
            <option value="2" <?php echo $selected; ?>> 2 Colums</option>
            <?php $selected = (isset( $this->print_Options_options['epaper_col_4'] ) && $this->print_Options_options['epaper_col_4'] === '3') ? 'selected' : '' ; ?>
            <option value="3" <?php echo $selected; ?>> 3 Colums</option>
        </select> <?php
    }




}
if ( is_admin() )
    $print_Options = new PrintOptions();

/* 
 * Retrieve this value with:
 * $print_Options_options = get_option( 'print_Options_option_name' ); // Array of All Options
 * $header_banner_0 = $print_Options_options['header_banner_0']; // Header Banner
 * $editor_information_1 = $print_Options_options['editor_information_1']; // Editor Information
 * $copyright_2 = $print_Options_options['copyright_2']; // Copyright
 * $design_3 = $print_Options_options['design_3']; // design
 */
