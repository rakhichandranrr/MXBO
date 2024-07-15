<?php $i = 0; ?>
<?php $j = 0; ?>

<div class="qodef-interactive-banners <?php echo esc_attr($holder_classes); ?>" <?php if( ! empty( $banners_height ) ) { echo 'style="height:' . $banners_height . ';"'; } ?>>
	<div class="qodef-ib-content-holder">
		<?php foreach ($items as $item) { ?>
			<div class="qodef-ib-item" data-index="<?php echo esc_attr($j);?>">
                <div class="qodef-m-image">
                    <?php echo wp_get_attachment_image( $item['item_image'], 'full' ); ?>
                </div>
				<div class="qodef-ib-item-inner">
                    <div class="qodef-ib-item-top-holder">
                        <div class="qodef-ib-item-number">
                            <p> <?php echo esc_html($item['number']); ?> </p>
                        </div>
                        <div class="qodef-ib-item-title">
                            <h4>
                                <?php if(!empty($item['link'])){?>
                                    <a href="<?php echo esc_attr($item['link']); ?>" target="<?php echo esc_attr($item['link_target']); ?>">
                                <?php } ?>
                                <?php echo esc_html($item['title']); ?>
                                <?php if(!empty($item['link'])){?>
                                    </a>
                                <?php } ?>
                            </h4>
                        </div>
                        <div class="qodef-ib-additional-link">
                            <h5>
                                <?php if(!empty($item['additional_link'])){?>
                                <a href="<?php echo esc_attr($item['additional_link']); ?>" target="<?php echo esc_attr($item['additional_link_target']); ?>">
                                    <?php } ?>
                                    <?php echo esc_html($item['additional_link_text']); ?>
                                    <?php if(!empty($item['additional_link'])){?>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="128" height="50" viewBox="0 0 128 50"><rect y="24" width="115" height="2"/><path d="M111,13C104,6,99,0,99,0H96s6,11,11,18l5,7-5,7c-5,7-11,18-11,18h3s5-6,12-13c9-9,17-11,17-11V24S120,22,111,13Z"/></svg>
                                </a>
                            <?php } ?>
                            </h5>
                        </div>
                    </div>
					<div class="qodef-ib-item-description">
						<p> <?php echo esc_html($item['description_1']); ?> </p>
                        <p> <?php echo esc_html($item['description_2']); ?> </p>
                        <p> <?php echo esc_html($item['description_3']); ?> </p>
					</div>
					<?php if(!empty($item['link'])){?>
						<a class='qode-e-link' href="<?php echo esc_attr($item['link']); ?>" target="<?php echo esc_attr($item['link_target']); ?>"></a>
					<?php } ?>
				</div>
			</div>
			<?php $j++; ?>
			<?php if($j == 5){
				break;
			} ?>
		<?php } ?>
	</div>
</div>
