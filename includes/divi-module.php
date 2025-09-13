<?php
if (!class_exists('ET_Builder_Module')) return;

class Cielo_Booking_Module extends ET_Builder_Module {
    public $slug       = 'cielo_booking_module';
    public $vb_support = 'on';

    function init() {
        $this->name = esc_html__('Cielo Booking Form', 'cielo');
    }

    function get_fields() {
        return [
            'title' => [
                'label'           => esc_html__('Title', 'cielo'),
                'type'            => 'text',
                'option_category' => 'basic_option',
            ],
        ];
    }

    function render($attrs, $content = null, $render_slug) {
        ob_start();
        echo "<h3>" . esc_html($this->props['title']) . "</h3>";
        cielo_render_booking_form();
        return ob_get_clean();
    }
}

new Cielo_Booking_Module();