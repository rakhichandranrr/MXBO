<div <?php qode_framework_class_attribute( $holder_classes ); ?> <?php qode_framework_inline_style( $holder_styles ); ?>>
	<div class="qodef-m-inner">
        <span class="qodef-m-featured-badge">
            <?php esc_html_e('Good choice', 'einar-core');?>
        </span>
		<?php einar_core_template_part( 'shortcodes/pricing-items', 'templates/parts/title', '', $params ); ?>
        <?php einar_core_template_part( 'shortcodes/pricing-items', 'templates/parts/period', '', $params ); ?>
        <?php einar_core_template_part( 'shortcodes/pricing-items', 'templates/parts/price', '', $params ); ?>
        <div class="qodef-m-content-holder">
            <?php einar_core_template_part( 'shortcodes/pricing-items', 'templates/parts/content', '', $params ); ?>
            <?php einar_core_template_part( 'shortcodes/pricing-items', 'templates/parts/button', '', $params ); ?>
        </div>
	</div>
    <div class="qodef-m-image-holder">
        <?php einar_core_template_part( 'shortcodes/pricing-items', 'templates/parts/image', '', $params ); ?>
    </div>
</div>
