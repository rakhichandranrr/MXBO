<div class="qodef-m-image-holder" <?php qode_framework_inline_attr($slider_attr, 'data-options'); ?>>
    <div class="swiper-wrapper">
        <?php foreach ($items as $image_item) : ?>
            <div class="swiper-slide">
                <?php echo wp_get_attachment_image($image_item['main_image'], 'full'); ?>

                <div class="qodef-m-headline">
                    <?php if (! empty($image_item['info_title'])) { ?>
                        <h1 class="qodef-m-title">
                            <span class="qodef-m-title-inner">
                                <?php if (! empty($image_item['info_title'])) { ?>
                                    <?php echo qode_framework_wp_kses_html('content', $image_item['info_title']); ?>
                                <?php } ?>
                                <?php if (! empty($image_item['info_title_superscript'])) { ?>
                                    <sup class="qodef-m-title-sup"><?php echo qode_framework_wp_kses_html('content', $image_item['info_title_superscript']); ?></sup>
                                <?php } ?>
                            </span>
                        </h1>
                    <?php } ?>
                </div>

                <div class="qodef-m-headline-bottom">
                    <?php if (! empty($image_item['info_title_bottom']) || ! empty($image_item['info_title_bottom_two'])) { ?>
                        <h1 class="qodef-m-title">
                            <?php if (! empty($image_item['info_title_bottom'])) { ?>
                                <span class="qodef-m-title-one">
                                    <span class="qodef-m-title-one-inner">
	                                    <?php echo qode_framework_wp_kses_html('content', $image_item['info_title_bottom']); ?>
                                    </span>
                                </span>
                            <?php } ?>
                            <?php if (! empty($image_item['info_title_bottom_two'])) { ?>
                                <span class="qodef-m-title-two">
	                                <span class="qodef-m-title-two-inner"><?php echo qode_framework_wp_kses_html('content', $image_item['info_title_bottom_two']); ?></span>
                                </span>
                            <?php } ?>
                        </h1>
                    <?php } ?>
                </div>

                <?php
                if (! empty($image_item['info_description'])) {
                    ?>
                    <h6 class="qodef-m-info-description"><?php echo qode_framework_wp_kses_html('content', $image_item['info_description']); ?></h6>
                    <?php
                }
                ?>

                <?php if (! empty($image_item['item_link'])) { ?>
                    <a class="qodef-m-link" itemprop="url" href="<?php echo esc_url($image_item['item_link']); ?>"
                       target="<?php echo esc_attr($link_target); ?>"></a>
                <?php } ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>
