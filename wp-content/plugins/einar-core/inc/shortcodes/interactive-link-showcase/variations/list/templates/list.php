<div <?php qode_framework_class_attribute( $holder_classes ); ?> <?php qode_framework_inline_style( $holder_styles ); ?>>
	<div class="qodef-m-items">
		<?php
        foreach ( $items as $item ) { ?>
        <?php
            if (!empty($item['item_link'])) {
        ?>
			<a itemprop="url" class="qodef-m-item qodef-e" href="<?php echo esc_url( $item['item_link'] ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
        <?php
            }
        else { ?>
                <span class="qodef-m-item qodef-e">
        <?php
            }
        ?>
            <span class="qodef-e-title"><?php echo esc_html( $item['item_title'] ); ?></span>
            <?php
                if (!empty($item['item_link'])) {
            ?>
            <span class="qodef-interactive-link-list-arrow">
                <svg xmlns="http://www.w3.org/2000/svg" width="128" height="51" viewBox="0 0 128 51"><title>arrow-big</title><rect y="24" width="115" height="2"/><path d="M111,13C104,6,99,0,99,0H96s6,11,11,18l5,7-5,7c-5,7-11,18-11,18h3s5-6,12-13c9-9,17-11,17-11V24S120,22,111,13Z"/></svg>
            </span>
            <?php
                }
            ?>
        <?php
            if (!empty($item['item_link'])) {
        ?>
			</a>
        <?php
        }
        else { ?>
            </span>
        <?php
            }
        ?>
		<?php
        } ?>
	</div>
</div>
