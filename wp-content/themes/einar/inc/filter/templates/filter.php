<?php if ( isset( $enable_filter ) && 'yes' === $enable_filter ) {
	$filter_items = einar_get_filter_items( $params );
	?>
	<div class="qodef-m-filter">
		<?php if ( ! empty( $filter_items ) ) { ?>
			<div class="qodef-m-filter-items qodef-m-filter-category">
				<a class="qodef-m-filter-item qodef--active" href="#" data-taxonomy="<?php echo esc_attr( $taxonomy_filter ); ?>" data-filter="*">
					<span class="qodef-m-filter-item-name"><?php esc_html_e( 'Show All', 'einar' ); ?></span>
				</a>
				<?php
				foreach ( $filter_items as $item ) {
					$filter_value = is_numeric( $item->slug ) ? $item->term_id : $item->slug;
					?>
					<a class="qodef-m-filter-item" href="#" data-taxonomy="<?php echo esc_attr( $taxonomy_filter ); ?>" data-filter="<?php echo esc_attr( $filter_value ); ?>">
						<span class="qodef-m-filter-item-name"><?php echo esc_html( $item->name ); ?></span>
					</a>
				<?php } ?>
			</div>
            <div class="qodef-m-filter-items qodef-m-filter-columns">
                <a class="qodef-m-filter-columns-item" href="#" data-columns="3">
					<span class="qodef-m-filter-item-name">
						<svg xmlns="http://www.w3.org/2000/svg" width="26" height="6" viewBox="0 0 26 6"><defs><style>.filter-3{fill:#fff;}</style></defs>
                            <circle class="filter-3" cx="3" cy="3" r="3"/>
                            <circle class="filter-3" cx="13" cy="3" r="3"/>
                            <circle class="filter-3" cx="23" cy="3" r="3"/></svg>
					</span>
                </a>
                <a class="qodef-m-filter-columns-item" href="#" data-columns="5">
					<span class="qodef-m-filter-item-name">
						<svg xmlns="http://www.w3.org/2000/svg" width="46" height="6" viewBox="0 0 46 6"><defs><style>.filter-5{fill:#fff;}</style></defs>
                            <circle class="filter-5" cx="3" cy="3" r="3"/>
                            <circle class="filter-5" cx="13" cy="3" r="3"/>
                            <circle class="filter-5" cx="23" cy="3" r="3"/>
                            <circle class="filter-5" cx="33" cy="3" r="3"/>
                            <circle class="filter-5" cx="43" cy="3" r="3"/>
                        </svg>
					</span>
                </a>

                <a class="qodef-m-filter-columns-item" href="#" data-columns="6">
					<span class="qodef-m-filter-item-name">
						<svg xmlns="http://www.w3.org/2000/svg" width="56" height="6" viewBox="0 0 56 6"><defs><style>.filter-6{fill:#fff;}</style></defs>
                            <circle class="filter-6" cx="3" cy="3" r="3"/>
                            <circle class="filter-6" cx="13" cy="3" r="3"/>
                            <circle class="filter-6" cx="23" cy="3" r="3"/>
                            <circle class="filter-6" cx="33" cy="3" r="3"/>
                            <circle class="filter-6" cx="43" cy="3" r="3"/>
                            <circle class="filter-6" cx="53" cy="3" r="3"/>
                        </svg>
					</span>
                </a>
            </div>
		<?php } ?>
	</div>
	<?php
	// Include loading spinner
	if ( ! isset( $pagination_type ) || 'no-pagination' === $pagination_type ) {
		einar_render_svg_icon( 'spinner', 'qodef-filter-pagination-spinner' );
	}
	?>
<?php } ?>
