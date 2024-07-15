<?php if ( class_exists( 'EinarCore_Social_Share_Shortcode' ) ) { ?>
	<div class="qodef-e-info-item-right qodef-e-info-social-share">
		<?php
		$params = array();
        $params['layout'] = 'dropdown';
        $params['dropdown_behavior'] = 'left';
		$params['title'] = '';
		
		echo EinarCore_Social_Share_Shortcode::call_shortcode( $params ); ?>
	</div>
<?php } ?>