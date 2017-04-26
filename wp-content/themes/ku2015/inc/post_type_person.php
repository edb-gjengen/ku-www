<?php
class BasePostType {
    const NONCE_NAME = 'ku_nonce';

    public $fields = [];
    public $html_fields = [];
    public $choice_fields = [];

    private function output_html_form($post_id, $key, $label) {
        ?>
        <tr>
            <td colspan="2"><strong><label for="<?php echo $key; ?>"><?php echo $label; ?></label></strong><br><br>
                <?php
                wp_editor($this->get_html($post_id, $key),
                    'ku-person-section',
                    $settings=array('textarea_name' => $key));
                ?>
            </td>
        </tr>
        <?php
    }

    private function get_html($post_id, $key) {
        return htmlspecialchars_decode(get_post_meta($post_id, $key, true));
    }

    private function output_field_form($post_id, $key, $label) {
        ?>
        <tr>
            <td><strong><label for="<?php echo $key; ?>"><?php echo $label; ?></label></strong></td>
            <td><input id="<?php echo $key; ?>" name="<?php echo $key; ?>" type="text" value="<?php echo get_post_meta($post_id, $key, true); ?>"></td>
        </tr>
        <?php
    }

    private function output_choice_field_form($post_id, $key, $label, $choices) {
        $val = get_post_meta($post_id, $key, true);
        $options = '';
        foreach ($choices as $c_val=>$c_label) {
            $selected = $val == $c_val ? ' selected' : '';
            $options .= "<option value=\"$c_val\"$selected>$c_label</option>";
        }
        ?>
        <tr>
            <td><strong><label for="<?php echo $key; ?>"><?php echo $label; ?></label></strong></td>
            <td><select id="<?php echo $key; ?>" name="<?php echo $key; ?>"><?php echo $options; ?></td>
        </tr>
        <?php
    }

    function output_details_form($post) {
        wp_nonce_field($this::NONCE_NAME, $this::NONCE_NAME);
        ?>
        <table class="form-table">
            <?php
            foreach($this->fields as $key=>$label):
                if( in_array($key, $this->html_fields) ) {
                    $this->output_html_form($post->ID, $key, $label);
                }
                elseif( in_array($key, array_keys($this->choice_fields)) ) {
                    $choices = $this->choice_fields[$key];
                    $this->output_choice_field_form($post->ID, $key, $label, $choices);
                } else {
                    $this->output_field_form($post->ID, $key, $label);
                }
            endforeach;
            ?>
        </table>
        <?php
    }
    function save_details($post_id) {
        // Bail if save_post did not init on product detail screen or if nonce failed
        if ( !array_key_exists($this::NONCE_NAME, $_POST) || !wp_verify_nonce($_POST[$this::NONCE_NAME], $this::NONCE_NAME)) {
            return;
        }

        // Bail if this is an auto save
        if( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) { return; }

        foreach(array_keys($this->fields) as $key) {
            if ( !empty($_POST[$key]) ) {

                if( in_array($key, $this->html_fields) ) {
                    $data = wpautop(htmlspecialchars($_POST[$key]));
                } else {
                    $data = $_POST[$key];
                }
                update_post_meta($post_id, $key, $data);
            }
        }
    }
}


class KUPerson extends BasePostType {
    const POSITION = '_ku_person_position';
    const EMAIL = '_ku_person_email';

    const POST_TYPE = 'person';

    function __construct() {
        $this->fields = array(
            $this::POSITION => __('Position', 'ku'),
            $this::EMAIL => __('Email', 'ku'),
        );

        $this->register_post_type();
        add_action('add_meta_boxes', array($this, 'add_details_meta_box'));
        add_action('save_post', array($this, 'save_details'));
        add_action('the_post', array($this, 'the_post' ));
    }

    function add_details_meta_box() {
        add_meta_box(
            'ku-person-section-id',
            __('Person details', 'ku'),
            array($this, 'output_details_form'),
            $this::POST_TYPE,
            'advanced',
            'high'
        );
    }

    function the_post($post) {
        if( get_post_type() !== $this::POST_TYPE) {
            return; // do nothing
        }

        /* Set some handy shortcuts for easier templating */
        $post_id = get_the_ID();
        $post->position = get_post_meta($post_id, $this::POSITION, true);
        $post->email = get_post_meta($post_id, $this::EMAIL, true);
    }

    function register_post_type() {
        $labels = array(
            'name'                => _x( 'Persons', 'Post Type General Name', 'ku' ),
            'singular_name'       => _x( 'Person', 'Post Type Singular Name', 'ku' ),
            'menu_name'           => __( 'Persons', 'ku' ),
            'parent_item_colon'   => __( 'Parent person:', 'ku' ),
            'all_items'           => __( 'All persons', 'ku' ),
            'view_item'           => __( 'View person', 'ku' ),
            'add_new_item'        => __( 'Add New person', 'ku' ),
            'add_new'             => __( 'New person', 'ku' ),
            'edit_item'           => __( 'Edit person', 'ku' ),
            'update_item'         => __( 'Update person', 'ku' ),
            'search_items'        => __( 'Search persons', 'ku' ),
            'not_found'           => __( 'No persons found', 'ku' ),
            'not_found_in_trash'  => __( 'No persons found in Trash', 'ku' ),
        );

        $args = array(
            'label'               => __( 'person', 'ku' ),
            'description'         => __( 'person information pages', 'ku' ),
            'labels'              => $labels,
            'supports'            => array( 'title', 'editor', 'page-attributes', 'thumbnail'),
//            'taxonomies'          => array( 'category' ),
            'hierarchical'        => false,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => true,
            'show_in_admin_bar'   => true,
            'menu_position'       => 5,
//            'menu_icon'           => '',
            'can_export'          => true,
            'has_archive'         => true,
            'exclude_from_search' => false,
            'publicly_queryable'  => true,
            'capability_type'     => 'page',
        );

        register_post_type($this::POST_TYPE, $args);
    }
}