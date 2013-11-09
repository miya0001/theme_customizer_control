<?php

if (!class_exists('Megumi_ThemeCustomizerControl')):
class Megumi_ThemeCustomizerControl extends WP_Customize_Control {

    /**
     * @access public
     * @var    string
     */
    public $label_after = '';

    protected function render_content() {
        switch( $this->type ) {
            case 'text':
                ?>
                <label>
                    <span class="customize-control-title"><?php echo $this->label; ?></span>
                    <input type="text" value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); ?> />
                    <div><?php echo $this->label_after; ?></div>
                </label>
                <?php
                break;
            case 'checkbox':
                ?>
                <label>
                    <input type="checkbox" value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); checked( $this->value() ); ?> />
                    <?php echo $this->label; ?>
                    <div><?php echo $this->label_after; ?></div>
                </label>
                <?php
                break;
            case 'radio':
                if ( empty( $this->choices ) )
                    return;

                $name = '_customize-radio-' . $this->id;

                ?>
                <span class="customize-control-title"><?php echo $this->label; ?></span>
                <?php
                foreach ( $this->choices as $value => $label ) :
                    ?>
                    <label>
                        <input type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" <?php $this->link(); checked( $this->value(), $value ); ?> />
                        <?php echo esc_html( $label ); ?><br/>
                        <div><?php echo $this->label_after; ?></div>
                    </label>
                    <?php
                endforeach;
                break;
            case 'select':
                if ( empty( $this->choices ) )
                    return;

                ?>
                <label>
                    <span class="customize-control-title"><?php echo $this->label; ?></span>
                    <select <?php $this->link(); ?>>
                        <?php
                        foreach ( $this->choices as $value => $label )
                            echo '<option value="' . esc_attr( $value ) . '"' . selected( $this->value(), $value, false ) . '>' . $label . '</option>';
                        ?>
                    </select>
                    <div><?php echo $this->label_after; ?></div>
                </label>
                <?php
                break;
            case 'dropdown-pages':
                $dropdown = wp_dropdown_pages(
                    array(
                        'name'              => '_customize-dropdown-pages-' . $this->id,
                        'echo'              => 0,
                        'show_option_none'  => __( '&mdash; Select &mdash;' ),
                        'option_none_value' => '0',
                        'selected'          => $this->value(),
                    )
                );

                // Hackily add in the data link parameter.
                $dropdown = str_replace( '<select', '<select ' . $this->get_link(), $dropdown );

                printf(
                    '<label class="customize-control-select"><span class="customize-control-title">%s</span> %s<div>%s</div></label>',
                    $this->label,
                    $dropdown,
                    $this->label_after
                );
                break;
        }
    }

} // end class
endif;

// eof
