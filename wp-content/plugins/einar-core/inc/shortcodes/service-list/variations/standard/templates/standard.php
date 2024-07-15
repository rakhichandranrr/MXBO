<div <?php qode_framework_class_attribute( $holder_classes ); ?>>
    <div class="qodef-e-top-holder">
        <?php if ( ! empty ( $label ) ) { ?>
            <h3 class="qodef-m-label" <?php echo qode_framework_get_inline_style( $label_styles ); ?> ><?php echo esc_html( $label ); ?></h3>
        <?php } ?>
        <?php

        if ( ! empty( $button_text ) && !empty( $button_link ) ) {

            $button_params = array(
                'button_layout' => 'outlined',
                'text'          => $button_text,
                'link'          => $button_link,
                'tatget'        => $button_link_target,
            );

            echo EinarCore_Button_Shortcode::call_shortcode( $button_params );
        }
        ?>
    </div>
	<div class="qodef-wrapper-inner">
		<?php foreach ( $items as $item ) {
			$params['image'] = $item['image'];
		    $params['item_title'] = $item['item_title'];
		    $params['text_1'] = $item['text_1'];
		    $params['text_2'] = $item['text_2'];
		    $params['link']  = $item['link'];
        ?>
			<article class="qodef-e">
				<div class="qodef-e-inner">
					<?php einar_core_template_part( 'shortcodes/service-list', 'templates/parts/image', '', $params ); ?>
					<?php einar_core_template_part( 'shortcodes/service-list', 'templates/parts/title', '', $params ); ?>
					<?php einar_core_template_part( 'shortcodes/service-list', 'templates/parts/text', '', $params ); ?>
					<?php einar_core_template_part( 'shortcodes/service-list', 'templates/parts/button', '', $params ); ?>
					<?php einar_core_template_part( 'shortcodes/service-list', 'templates/parts/link', '', $params ); ?>
				</div>
			</article>
		<?php } ?>
	</div>
</div>
