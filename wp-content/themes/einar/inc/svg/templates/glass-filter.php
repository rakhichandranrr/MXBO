<svg class="<?php echo esc_attr( $class ); ?>" width="100px" height="100px" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg" color-interpolation-filters="sRGB">
	<defs>
		<filter x="0%" y="0%" width="100%" height="100%">
			<feTurbulence type="fractalNoise" baseFrequency=".034 .008" seed="2" result="noise" numOctaves="2"></feTurbulence>
			<feDisplacementMap in="SourceGraphic" in2="noise" scale="0" xChannelSelector="R" yChannelSelector="B" result="displacement"></feDisplacementMap>
			<feMerge>
				<feMergeNode in="SourceGraphic"></feMergeNode>
				<feMergeNode in="displacement"></feMergeNode>
			</feMerge>
		</filter>
	</defs>
</svg>
