<?php
   /*
   Plugin Name: Image Block Link Fusion Module
   Plugin URI: https://github.com/Watson-Creative/ImageBlockFusionModule
   GitHub Plugin URI: https://github.com/Watson-Creative/ImageBlockFusionModule
   description: Add module to Fusion Builder to embed gravity forms in posts
   Version: 1.0.1
   Author: Alex Tryon
   Author URI: http://www.alextryonpdx.com
   License: GPL2
   */

function fusion_element_image_link_block() {


    fusion_builder_map( array(
        'name'            => esc_attr__( 'Image Overlay Link', 'fusion-builder' ),
        'shortcode'       => 'imagelink',
        'params'          => array(
        array(
          'type'        => 'tinymce',
          'heading'     => esc_attr__( 'Link Text', 'fusion-builder' ),
          'description' => esc_attr__( 'Enter link Text and/or icon', 'fusion-builder' ),
          'param_name'  => 'element_content',
          'value'     => '',
          'placeholder' => true),
        array(
          'type'        => 'colorpickeralpha',
          'heading'     => esc_attr__( 'Select Link Text Color', 'fusion-builder' ),
          'description' => esc_attr__( 'Select link text color and opacity ', 'fusion-builder' ),
          'param_name'  => 'link_color',
          'value'       => '',),
        array(
          'type'        => 'colorpickeralpha',
          'heading'     => esc_attr__( 'Select Overlay Background Color', 'fusion-builder' ),
          'description' => esc_attr__( 'Select overlay background color and opacity (inactive state)', 'fusion-builder' ),
          'param_name'  => 'overlay_color',
          'value'       => '',),
        array(
          'type'        => 'colorpickeralpha',
          'heading'     => esc_attr__( 'Select Overlay Background Hover Color', 'fusion-builder' ),
          'description' => esc_attr__( 'Select overlay background color and opacity (hover state)', 'fusion-builder' ),
          'param_name'  => 'overlay_color_hover',
          'value'       => '',),
        array(
          'type'        => 'upload',
          'heading'     => esc_attr__( 'Background Image', 'fusion-builder' ),
          'description' => esc_attr__( 'Link block background image', 'fusion-builder' ),
          'param_name'  => 'background_image',
          'value'       => '',),
        array(
          'type'        => 'link_selector',
          'heading'     => esc_attr__( 'Link', 'fusion-builder' ),
          'description' => esc_attr__( 'Select link', 'fusion-builder' ),
          'param_name'  => 'link_url',
          'value'       => '',),
        array(
          'type'        => 'textfield',
          'heading'     => esc_attr__( 'Height', 'fusion-builder' ),
          'description' => esc_attr__( 'Element height in px... include px in value eg: "300px"', 'fusion-builder' ),
          'param_name'  => 'height',
          'value'       => '',),
         array(
          'type'        => 'textfield',
          'heading'     => esc_attr__( 'Padding', 'fusion-builder' ),
          'description' => esc_attr__( 'Element padding in valid css notation... include px/%/em in value eg: "300px, 2%"', 'fusion-builder' ),
          'param_name'  => 'padding',
          'value'       => '',)
        )
    ) );
}
add_action( 'fusion_builder_before_init', 'fusion_element_image_link_block' );

function random_password( $length = 22 ) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $password = substr( str_shuffle( $chars ), 0, $length );
    return $password;
}

function image_link( $atts, $content = null ){
    $a = shortcode_atts( array(
    'background_image' => '',
    'overlay_color' => '',
    'overlay_color_hover' => '',
    'link_url' => '',
    'element_content' => '',
    'height' => '',
    'link_color' =>''
    ), $atts);

    $id = random_password();

    $styles = '<style>
        .image-overlay-link {
            width: 100%;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            display:table;
        }
        .block-overlay {
            height: 100%;
            width: 100%;
            padding:20px;
            transition: 400ms all;
            display: table-cell;
            vertical-align: middle;
        }
        .image-overlay-link #' . $id . ' { 
          padding:' . $a["padding"] . ';
          background-color: ' . $a["overlay_color"] . ';
        }
        .image-overlay-link #' . $id . ':hover { 
          background-color: ' . $a["overlay_color_hover"] . ';
        }
        </style>';
    $block = '<div class="image-overlay-link" style="height:' . $a["height"] . '; background-image:url(' . $a["background_image"] . '")>
      <a style="color:' . $a['link_color'] . '" id="' . $id . '" class="block-overlay" href="' . $a['link_url'] . '">' . $content . '</a></div>';

    $block .= $styles;
    return $block;
}
add_shortcode('imagelink', 'image_link');












// function spacesTable(){
//   $spaces = new WP_Query( array(
//     'post_type' => 'event_space'
//   ));
//   return print_r($spaces);
// }

// add_shortcode('event_spaces_table','spacesTable');
?>