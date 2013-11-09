# Megumi_ThemeCustomizerControl() Class

Class for theme customizer custom control.  
This class allows to use html brefore and after form fields.

## How to install in your project.

### Add composer.json like below

    {
        "require": {
            "megumi/theme_customizer_control": "dev-master"
        }
    }

### Download this package in your project.

    composer install

### Load this class.

    require(dirname(__FILE__).'/vendor/autoload.php');

## Example

    $wp_customize->add_section('themename_color_scheme', array(
        'title'    => __('Color Scheme', 'themename'),
        'priority' => 120,
    ));

    $wp_customize->add_setting('setting_name', array(
        'default'        => 'This is default!',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
    ));

    $wp_customize->add_control(new Megumi_CustomizeControl(
        $wp_customize,
        'uniq_id_for_the_control',
        array(
            'settings' => 'setting_name',
            'label'    => 'This is label',
            'section'  => 'themename_color_scheme',
            'type'     => 'text',
            'choices'  => $themes,
            'label_after' => 'This is label displayed after this control'
        )
    ));

## License

GPL2
