(function ( $ ) {
	'use strict';

	// This case is important when theme is not active
	if ( typeof qodef !== 'object' ) {
		window.qodef = {};
	}

	window.qodefCore                = {};
	qodefCore.shortcodes            = {};
	qodefCore.listShortcodesScripts = {
		qodefSwiper: qodef.qodefSwiper,
		qodefPagination: qodef.qodefPagination,
		qodefFilter: qodef.qodefFilter,
		qodefMasonryLayout: qodef.qodefMasonryLayout,
		qodefJustifiedGallery: qodef.qodefJustifiedGallery,
		qodefCustomCursor: qodefCore.qodefCustomCursor,
	};

	qodefCore.body         = $( 'body' );
	qodefCore.html         = $( 'html' );
	qodefCore.windowWidth  = $( window ).width();
	qodefCore.windowHeight = $( window ).height();
	qodefCore.scroll       = 0;

	$( document ).ready(
		function () {
			qodefCore.scroll = $( window ).scrollTop();
			qodefInlinePageStyle.init();
			qodefUncoverSection.init();
			qodefStickyColumn.init();
			qodefAppear.init();
		}
	);

	$( window ).resize(
		function () {
			qodefCore.windowWidth  = $( window ).width();
			qodefCore.windowHeight = $( window ).height();
			qodefStickyColumn.init();
		}
	);

	$( window ).scroll(
		function () {
			qodefCore.scroll = $( window ).scrollTop();
		}
	);

	$( window ).load(
		function () {
			qodefScrollItem.init();
			qodefCursorItem.init();
			qodefGlassHover.init();
		}
	);

	qodef.body.on(
		'einar_trigger_swiper_is_initialized',
		function () {

		}
	);

	$( document ).on(
		'einar_trigger_get_new_posts',
		function () {
			qodefAppear.init();
			qodefGlassHover.init();
		}
	);

	/**
	 * Check element to be in the viewport
	 */
	var qodefIsInViewport = {
		check: function ( $element, callback, onlyOnce, callbackOnExit ) {
			if ( $element.length ) {
				var offset = typeof $element.data( 'viewport-offset' ) !== 'undefined' ? $element.data( 'viewport-offset' ) : 0.1; // When item is 10% in the viewport

				var observer = new IntersectionObserver(
					function ( entries ) {
						// isIntersecting is true when element and viewport are overlapping
						// isIntersecting is false when element and viewport don't overlap
						if ( entries[0].isIntersecting === true ) {
							callback.call( $element );

							// Stop watching the element when it's initialize
							if ( onlyOnce !== false ) {
								observer.disconnect();
							}
						} else if ( callbackOnExit && onlyOnce === false ) {
							callbackOnExit.call( $element );
						}
					},
					{ threshold: [offset] }
				);

				observer.observe( $element[0] );
			}
		},
	};

	qodefCore.qodefIsInViewport = qodefIsInViewport;

	var qodefScroll = {
		disable: function () {
			if ( window.addEventListener ) {
				window.addEventListener(
					'wheel',
					qodefScroll.preventDefaultValue,
					{ passive: false }
				);
			}

			// window.onmousewheel = document.onmousewheel = qodefScroll.preventDefaultValue;
			document.onkeydown = qodefScroll.keyDown;
		},
		enable: function () {
			if ( window.removeEventListener ) {
				window.removeEventListener(
					'wheel',
					qodefScroll.preventDefaultValue,
					{ passive: false }
				);
			}
			window.onmousewheel = document.onmousewheel = document.onkeydown = null;
		},
		preventDefaultValue: function ( e ) {
			e = e || window.event;
			if ( e.preventDefault ) {
				e.preventDefault();
			}
			e.returnValue = false;
		},
		keyDown: function ( e ) {
			var keys = [37, 38, 39, 40];
			for ( var i = keys.length; i--; ) {
				if ( e.keyCode === keys[i] ) {
					qodefScroll.preventDefaultValue( e );
					return;
				}
			}
		}
	};

	qodefCore.qodefScroll = qodefScroll;

	var qodefPerfectScrollbar = {
		init: function ( $holder ) {
			if ( $holder.length ) {
				qodefPerfectScrollbar.qodefInitScroll( $holder );
			}
		},
		qodefInitScroll: function ( $holder ) {
			var $defaultParams = {
				wheelSpeed: 0.6,
				suppressScrollX: true
			};

			var $ps = new PerfectScrollbar(
				$holder[0],
				$defaultParams
			);

			$( window ).resize(
				function () {
					$ps.update();
				}
			);
		}
	};

	qodefCore.qodefPerfectScrollbar = qodefPerfectScrollbar;

	/*
	 *  Add uncovering section
	 */
	var qodefUncoverSection = {
		init: function () {
			this.holder = $( '#qodef-custom-section--uncover' );

			if ( this.holder.length && ! qodefCore.html.hasClass( 'touchevents' ) && qodef.windowWidth > 1024 ) {
				qodefUncoverSection.addClass( this.holder );
				qodefUncoverSection.setHeight( this.holder );

				$( window ).resize(
					function () {
						qodefUncoverSection.setHeight( qodefUncoverSection.holder );
					}
				);
			}
		},
		setHeight: function ( $holder ) {
			$holder.css(
				'height',
				'auto'
			);

			var sectionHeight = $holder.outerHeight();

			if ( sectionHeight > 0 ) {
				$( '#qodef-page-content' ).css(
					{ 'margin-bottom': sectionHeight }
				);
				$holder.css(
					'height',
					sectionHeight
				);
			}

			document.addEventListener(
				'scroll',
				function () {
					var scrolledNearBottomOfPage = document.documentElement.scrollHeight - qodefCore.scroll - qodefCore.windowHeight < 100;

					if ( scrolledNearBottomOfPage ) {
						$holder.css(
							'z-index',
							'2'
						);
					} else {
						$holder.css(
							'z-index',
							'0'
						);
					}
				},
				{
					passive: true
				}
			);
		},
		addClass: function () {
			qodefCore.body.addClass( 'qodef-page-has-custom-section--uncover' );
		},
	};

	qodefCore.qodefUncoverSection = qodefUncoverSection;

	var qodefInlinePageStyle = {
		init: function () {
			this.holder = $( '#einar-core-page-inline-style' );

			if ( this.holder.length ) {
				var style = this.holder.data( 'style' );

				if ( style.length ) {
					$( 'head' ).append( '<style type="text/css">' + style + '</style>' );
				}
			}
		}
	};

	var qodefStickyColumn = {
		init: function () {
			var stickyColumnHolder = $( '.qodef-sticky-column--enable' );

			if ( stickyColumnHolder.length ) {
				stickyColumnHolder.each(
					function () {
						var height = $( this ).height();

						$( this ).css(
							'top',
							'calc(50% - ' + (height / 2) + 'px )'
						);
					}
				);
			}
		}
	};

	qodefCore.qodefStickyColumn = qodefStickyColumn;

	/**
	 * Init scroll item
	 */
	var qodefScrollItem = {
		init: function () {
			var $items = $( '.qodef-scroll-item' );

			if ( $items.length ) {
				$items.each(
					function () {
						var $currentItem       = $( this ),
							$defaultMin        = -35,
							$defaultMax        = -50,
							$defaultSmoothness = 30;

						var $min        = parseInt( $( this ).attr( 'data-parallax-min' ) ? $( this ).attr( 'data-parallax-min' ) : $defaultMin ),
							$max        = parseInt( $( this ).attr( 'data-parallax-max' ) ? $( this ).attr( 'data-parallax-max' ) : $defaultMax ),
							$y          = Math.floor( Math.random() * ($max - $min) + $min ),
							$smoothness = parseInt( $( this ).attr( 'data-parallax-smoothness' ) ? $( this ).attr( 'data-parallax-smoothness' ) : $defaultSmoothness );

						if ( $currentItem.hasClass( 'qodef-grid-item' ) ) {
							$currentItem.children( '.qodef-e-inner' ).attr(
								'data-parallax',
								'{"y": ' + $y + ', "smoothness": ' + $smoothness + '}'
							);
						} else {
							$currentItem.attr(
								'data-parallax',
								'{"y": ' + $y + ', "smoothness": ' + $smoothness + '}'
							);
						}
					}
				);
			}

			qodefScrollItem.initScroll();
		},
		initScroll: function () {
			var parallaxInstances = $( '[data-parallax]' );

			if ( parallaxInstances.length && ! qodefCore.html.hasClass( 'touchevents' ) && typeof ParallaxScroll === 'object' ) {
				ParallaxScroll.init(); //initialization removed from plugin js file to have it run only on non-touch devices
			}
		},
	};

	qodefCore.qodefScrollItem = qodefScrollItem;

	/**
	 * Init cursor item
	 */
	var qodefCursorItem = {
		init: function () {
			var $items = $( '.qodef-cursor-item' );

			if ( $items.length ) {
				$items.each(
					function () {
						var $currentItem = $( this );

						qodefCursorItem.initCursor( $currentItem );
					}
				);

				window.addEventListener(
					'mousemove',
					function ( e ) {
						qodefCore.mousePos = {
							x: e.clientX,
							y: e.clientY,
						};
					}
				);
			}
		},
		initCursor: function ( $currentItem ) {
			var $defaultXMin       = 10,
				$defaultXMax       = 40,
				$defaultYMin       = 10,
				$defaultYMax       = 50,
				$defaultSmoothness = 0.04;

			qodefCore.mousePos = {
				x: qodefCore.windowWidth / 2,
				y: qodefCore.windowHeight / 2
			};

			// Map number x from range [a, b] to [c, d]
			var map = ( x, a, b, c, d ) => (x - a) * (d - c) / (b - a) + c;

			// Linear interpolation
			var lerp = ( a, b, n ) => (1 - n) * a + n * b;

			var translationVals = { tX: 0, tY: 0 },
				xStart          = gsap.utils.random(
					$defaultXMin,
					$defaultXMax,
					10
				),
				yStart          = gsap.utils.random(
					$defaultYMin,
					$defaultYMax,
					10
				);

			var moveAnimation;

			// infinite loop
			var render = function () {
				// Calculate the amount to move.
				// Using linear interpolation to smooth things out.
				// Translation values will be in the range of [-start, start] for a cursor movement from 0 to the window's width/height
				translationVals.tX = lerp(
					translationVals.tX,
					map(
						qodefCore.mousePos.x,
						0,
						qodefCore.windowWidth,
						-xStart,
						xStart
					),
					$defaultSmoothness
				);
				translationVals.tY = lerp(
					translationVals.tY,
					map(
						qodefCore.mousePos.y,
						0,
						qodefCore.windowHeight,
						-yStart,
						yStart
					),
					$defaultSmoothness
				);

				gsap.set(
					$currentItem,
					{
						x: translationVals.tX,
						y: translationVals.tY
					}
				);

				moveAnimation = requestAnimationFrame( render );
			};

			moveAnimation = requestAnimationFrame( render );

			qodefCore.qodefIsInViewport.check(
				$currentItem,
				function () {
					moveAnimation = requestAnimationFrame( render );
				},
				false,
				function () {
					cancelAnimationFrame( moveAnimation );
				}
			);
		}
	};

	qodefCore.qodefCursorItem = qodefCursorItem;

	/**
	 * Init animation on appear
	 */
	var qodefAppear = {
		init: function () {
			this.holder = $( '.qodef--has-appear:not(.qodef--appeared), .qodef--custom-appear:not(.qodef--appeared)' );

			if ( this.holder.length ) {
				this.holder.each(
					function () {
						var $holder      = $( this ),
							appearDelay = $( this ).attr( 'data-appear-delay' );

						qodefCore.qodefIsInViewport.check(
							$holder,
							() => {
								qodef.qodefWaitForImages.check(
									$holder,
									function () {
										if ( appearDelay ) {
											setTimeout(
												() => {
													$holder.addClass( 'qodef--appeared' );
												},
												appearDelay
											);
										} else {
											$holder.addClass( 'qodef--appeared' );
										}
									}
								);
							}
						);
					}
				);
			}
		},
	};

	qodefCore.qodefAppear = qodefAppear;

	/**
	 * Init Section Line Animation
	 */
	var qodefGlassHover = {
		init: function () {
			this.holder = $( '.qodef-portfolio-list.qodef-hover-animation--glass-effect .qodef-e')

			if ( this.holder.length && ! qodefCore.html.hasClass( 'touchevents' )) {
				this.holder.each(
					function () {
						let $thisHolder = $( this );

						qodefGlassHover.checkHTML( $thisHolder );
					}
				);
			}
		},
		checkHTML: function ( $holder ) {
			if ( ! $holder.find( '.qodef-svg--glass-filter' ).length ) {
				const $glassFilter = qodefGlobal.vars.glassFilter;

				$holder.prepend( $glassFilter );
			}

			let uniqueId = `qodef-glass-filter-${parseInt(Math.random() * 1000)}`,
				filter = $holder.find('filter');

			filter.attr('id', uniqueId);

			qodefGlassHover.initEffect( $holder );
		},
		initEffect: function ( $holder ) {
			let filter               = $holder.find('filter'),
				filterId             = filter.attr("id"),
				displacementMap      = filter.find('feDisplacementMap')[0],
				displacementMapScale = { val: 0 },
				$img = $holder.find('img,video');


			let tl = gsap.timeline(
				{
					paused: true,
					onStart: () => {
						gsap.set(
							$img,
							{
								filter: 'url(#' + filterId + ')',
							}
						);
					},
					onReverseComplete: () => {
						gsap.set(
							$img,
							{
								filter: 'none'
							}
						);
					},
					onUpdate: () => {
						displacementMap.setAttribute('scale', displacementMapScale.val);
					}
				}
			);

			tl
			.to(
				displacementMapScale,
				{
					startAt: {
						val: 0
					},
					val: 80,
					duration: .5,
					ease: 'none',
				},
				'0'
			)
			.to(
				$img,
				{
					z: 1.001
				},
				'0'
			)


			$holder.on(
				'mouseenter',
				function () {
					tl.timeScale(1).play();
				}
			)
			.on(
				'mouseleave',
				function () {
					tl.timeScale(1).reverse();
				}
			);
		},
	};

	qodefCore.qodefGlassHover = qodefGlassHover;

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefBackToTop.init();
		}
	);

	var qodefBackToTop = {
		init: function () {
			this.holder = $( '#qodef-back-to-top' );

			if ( this.holder.length ) {
				// Scroll To Top
				this.holder.on(
					'click',
					function ( e ) {
						e.preventDefault();
						qodefBackToTop.animateScrollToTop();
					}
				);

				qodefBackToTop.showHideBackToTop();
			}
		},
		animateScrollToTop: function () {
			var startPos = qodef.scroll,
				newPos   = qodef.scroll,
				step     = .9,
				animationFrameId;

			var startAnimation = function () {
				if ( newPos === 0 ) {
					return;
				}

				newPos < 0.0001 ? newPos = 0 : null;

				var ease = qodefBackToTop.easingFunction( (startPos - newPos) / startPos );
				$( 'html, body' ).scrollTop( startPos - (startPos - newPos) * ease );
				newPos = newPos * step;

				animationFrameId = requestAnimationFrame( startAnimation );
			};

			startAnimation();

			$( window ).one(
				'wheel touchstart',
				function () {
					cancelAnimationFrame( animationFrameId );
				}
			);
		},
		easingFunction: function ( n ) {
			return 0 == n ? 0 : Math.pow( 1024, n - 1 );
		},
		showHideBackToTop: function () {
			$( window ).scroll(
				function () {
					var $thisItem = $( this ),
						b         = $thisItem.scrollTop(),
						c         = $thisItem.height(),
						d;

					if ( b > 0 ) {
						d = b + c / 2;
					} else {
						d = 1;
					}

					if ( d < 1e3 ) {
						qodefBackToTop.addClass( 'off' );
					} else {
						qodefBackToTop.addClass( 'on' );
					}
				}
			);
		},
		addClass: function ( a ) {
			this.holder.removeClass( 'qodef--off qodef--on' );

			if ( a === 'on' ) {
				this.holder.addClass( 'qodef--on' );
			} else {
				this.holder.addClass( 'qodef--off' );
			}
		}
	};

})( jQuery );

(function ($) {
	'use strict';

	$( document ) .ready(
		function () {
			qodefCustomCursor.init();
			qodefCustomDotCursor.init();
		}
	);

	// $(window).on(
	// 	'elementor/frontend/init',
	// 	function () {
	// 		qodefCustomCursor.init();
	// 	}
	// );

	var qodefCustomCursor = {
		cursorApended: false,
		init         : function () {
			const $dragSelectors = $( '.qodef--drag-cursor' );

			if ($dragSelectors.length) {
				const customCursor = qodefGlobal.vars.dragCursor;

				if (false === qodefCustomCursor.cursorApended) {
					qodefCore.html.append( '<div class="qodef-m-custom-cursor qodef-m"><div class="qodef-m-custom-cursor-inner">' + customCursor + '</div></div>' );
					qodefCustomCursor.cursorApended = true;
				}
				const $cursorHolder = $( '.qodef-m-custom-cursor' );

				if ( ! qodefCore.html.hasClass( 'touchevents' ) ) {
					function handleMoveCursor(event) {
						$cursorHolder.css(
							{
								top : event.clientY - 7, // half of svg height
								left: event.clientX - 45.5, // half of svg width
							}
						);
					}

					document.addEventListener( 'pointermove', handleMoveCursor );

					// reset cursor selectors
					const resetCursorSelectors =
							'.qodef--drag-cursor .swiper-button-prev,' +
							'.qodef--drag-cursor .swiper-button-next,' +
							'.qodef--drag-cursor .swiper-pagination,' +
							'.qodef--drag-cursor .qodef-e-content a,' + // port/blog list link around image
							'.qodef--drag-cursor .product a:not(.woocommerce-loop-product__link),' + // product list link around image
							'.qodef--drag-cursor .qodef-e-post-link,' + // port/blog/product list link overlay
							'.qodef--drag-cursor .qodef-e-hotspot',
						$resetCursorSelectors  = $( resetCursorSelectors );

					$resetCursorSelectors.css(
						{
							cursor: 'pointer',
						}
					);

					$( document ).on(
						'mouseenter',
						resetCursorSelectors,
						function () {
							$cursorHolder.addClass( 'qodef--hide' );
						}
					).on(
						'mouseleave',
						resetCursorSelectors,
						function () {
							$cursorHolder.removeClass( 'qodef--hide' );
						}
					);

					// drag cursor selectors
					const dragSelectors = '.qodef--drag-cursor';

					$( document ).on(
						'mouseenter',
						dragSelectors,
						function () {
							$cursorHolder.addClass( 'qodef--show' );
						}
					).on(
						'mouseleave',
						dragSelectors,
						function () {
							$cursorHolder.removeClass( 'qodef--show' );
						}
					);
				}
			}
		},
	};

	qodefCore.qodefCustomCursor = qodefCustomCursor;

	var qodefCustomDotCursor = {
		cursorApended: false,
		init         : function () {
			const $dotSelectors = $( '.qodef--dot-cursor' );

			if ( $dotSelectors.length ) {
				const customDotCursor = qodefGlobal.vars.dotCursor;

				if (false === qodefCustomDotCursor.cursorApended) {
					qodefCore.html.append( '<div class="qodef-m-custom-dot-cursor qodef-m"><div class="qodef-m-custom-dot-cursor-inner">' + customDotCursor + '</div></div>' );
					qodefCustomDotCursor.cursorApended = true;
				}
				const $cursorDotHolder = $( '.qodef-m-custom-dot-cursor' );

				if ( ! qodefCore.html.hasClass( 'touchevents' ) ) {
					function handleMoveCursor(event) {
						$cursorDotHolder.css(
							{
								top : event.clientY - 10, // half of svg height
								left: event.clientX - 10, // half of svg width
							}
						);
					}

					document.addEventListener( 'pointermove', handleMoveCursor );

					// reset cursor selectors
					const resetDotCursorSelectors =
							  '.qodef--dot-cursor .swiper-button-prev,' +
							  '.qodef--dot-cursor .swiper-button-next,' +
							  '.qodef--dot-cursor .swiper-pagination,' +
							  '.qodef--dot-cursor .qodef-e-hotspot',
						  $resetDotCursorSelectors  = $( resetDotCursorSelectors );

					$resetDotCursorSelectors.css(
						{
							cursor: 'pointer',
						}
					);

					$( document ).on(
						'mouseenter',
						resetDotCursorSelectors,
						function () {
							$cursorDotHolder.addClass( 'qodef--hide' );
						}
					).on(
						'mouseleave',
						resetDotCursorSelectors,
						function () {
							$cursorDotHolder.removeClass( 'qodef--hide' );
						}
					);

					// drag cursor selectors
					const dotSelectors = '.qodef--dot-cursor';

					$( document ).on(
						'mouseenter',
						dotSelectors,
						function () {
							$cursorDotHolder.addClass( 'qodef--show' );
						}
					).on(
						'mouseleave',
						dotSelectors,
						function () {
							$cursorDotHolder.removeClass( 'qodef--show' );
						}
					);
				}
			}
		},
	};

	qodefCore.qodefCustomDotCursor = qodefCustomDotCursor;

})( jQuery );

(function ( $ ) {
	'use strict';

	$( window ).on(
		'load',
		function () {
			qodefUncoverFooter.init();
		}
	);

	var qodefUncoverFooter = {
		holder: '',
		init: function () {
			this.holder = $( '#qodef-page-footer.qodef--uncover' );

			if ( this.holder.length && ! qodefCore.html.hasClass( 'touchevents' ) ) {
				qodefUncoverFooter.addClass();
				qodefUncoverFooter.setHeight( this.holder );

				$( window ).resize(
					function () {
						qodefUncoverFooter.setHeight( qodefUncoverFooter.holder );
					}
				);
			}
		},
		setHeight: function ( $holder ) {
			$holder.css( 'height', 'auto' );

			var footerHeight = $holder.outerHeight();

			if ( footerHeight > 0 ) {
				$( '#qodef-page-outer' ).css(
					{
						'margin-bottom': footerHeight,
						'background-color': qodefCore.body.css( 'backgroundColor' )
					}
				);

				$holder.css( 'height', footerHeight );
			}
		},
		addClass: function () {
			qodefCore.body.addClass( 'qodef-page-footer--uncover' );
		}
	};

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefFullscreenMenu.init();
		}
	);

	$( window ).on(
		'resize',
		function () {
			qodefFullscreenMenu.handleHeaderWidth( 'resize' );
		}
	);

	var qodefFullscreenMenu = {
		init: function () {
			var $fullscreenMenuOpener = $( 'a.qodef-fullscreen-menu-opener' ),
				$menuItems            = $( '#qodef-fullscreen-area nav ul li a' ),
				$menuVideos           = $menuItems.find( '.qodef-video--autoplay' ),
				$menuContainer        = $( '#qodef-fullscreen-area .qodef-content-container' ),
				$menuList             = $( '#qodef-fullscreen-area nav ul li' );

			if ( $fullscreenMenuOpener.length ) {
				// prevent header changing width when fullscreen menu is open
				qodefFullscreenMenu.handleHeaderWidth( 'init' );

				// open popup menu
				$fullscreenMenuOpener.on(
					'click',
					function ( e ) {
						e.preventDefault();
						var $thisOpener = $( this );

						if ( ! qodefCore.body.hasClass( 'qodef-fullscreen-menu--opened' ) ) {
							qodefFullscreenMenu.openFullscreen( $thisOpener );

							$( document ).keyup(
								function ( e ) {
									if ( e.keyCode === 27 ) {
										qodefFullscreenMenu.closeFullscreen( $thisOpener );
									}
								}
							);
						} else {
							qodefFullscreenMenu.closeFullscreen( $thisOpener );
						}
					}
				);

				$menuVideos.each(
					function () {
						var $item = $( this );
						$menuContainer.append( $item.get() );
					}
				);

				$menuList.on(
					'mouseenter',
					function () {
						var $thisItem = this,
							$id 	  = $thisItem.id.replace( /\D/g,'' ); // regex matches all non-digits

						$menuVideos.each(
							function () {
								var $item = $( this );
								if (  parseInt( $item.attr( 'id' ) ) === parseInt( $id ) ) {
									$item.addClass( 'qodef--active' );
								} else {
									$item.removeClass( 'qodef--active' );
								}
							}
						);
					}
				);

				// open dropdowns
				$menuItems.on(
					'tap click',
					function ( e ) {
						var $thisItem = $( this );

						if ( $thisItem.parent().hasClass( 'menu-item-has-children' ) ) {
							e.preventDefault();
							qodefFullscreenMenu.clickItemWithChild( $thisItem );
						} else if ( $thisItem.attr( 'href' ) !== 'http://#' && $thisItem.attr( 'href' ) !== '#' ) {
							qodefFullscreenMenu.closeFullscreen( $fullscreenMenuOpener );
						}
					}
				);
			}
		},
		openFullscreen: function ( $opener ) {
			$opener.addClass( 'qodef--opened' );
			qodefCore.body.removeClass( 'qodef-fullscreen-menu-animate--out' ).addClass( 'qodef-fullscreen-menu--opened qodef-fullscreen-menu-animate--in' );
			qodefCore.qodefScroll.disable();
		},
		closeFullscreen: function ( $opener ) {
			$opener.removeClass( 'qodef--opened' );
			qodefCore.body.removeClass( 'qodef-fullscreen-menu--opened qodef-fullscreen-menu-animate--in' ).addClass( 'qodef-fullscreen-menu-animate--out' );
			qodefCore.qodefScroll.enable();
			$( 'nav.qodef-fullscreen-menu ul.sub_menu' ).slideUp( 200 );
		},
		clickItemWithChild: function ( thisItem ) {
			var $thisItemParent  = thisItem.parent(),
				$thisItemSubMenu = $thisItemParent.find( '.sub-menu' ).first();

			if ( $thisItemSubMenu.is( ':visible' ) ) {
				$thisItemSubMenu.slideUp( 300 );
				$thisItemParent.removeClass( 'qodef--opened' );
			} else {
				$thisItemSubMenu.slideDown( 300 );
				$thisItemParent.addClass( 'qodef--opened' ).siblings().find( '.sub-menu' ).slideUp( 400 );
			}
		},
		handleHeaderWidth: function ( state ) {
			var $header               = $( '#qodef-page-header' );
			var $fullscreenMenuOpener = $( 'a.qodef-fullscreen-menu-opener' );

			if ( $header.length && $fullscreenMenuOpener.length ) {
				// if desktop device
				if ( qodefCore.windowWidth > 1024 ) {
					// if page height is greater than window height, scroll bar is visible
					if ( qodefCore.body.height() > qodefCore.windowHeight ) {
						// on resize reset previously set inline width
						if ( 'resize' === state ) {
							$header.css( { 'width': '' } );
						}
						$header.width( $header.width() );
					}
				} else {
					// reset previously set inline width
					$header.css( { 'width': '' } );
				}
			}
		}
	};

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefHeaderScrollAppearance.init();
		}
	);

	var qodefHeaderScrollAppearance = {
		appearanceType: function () {
			return qodefCore.body.attr( 'class' ).indexOf( 'qodef-header-appearance--' ) !== -1 ? qodefCore.body.attr( 'class' ).match( /qodef-header-appearance--([\w]+)/ )[1] : '';
		},
		init: function () {
			var appearanceType = this.appearanceType();

			if ( appearanceType !== '' && appearanceType !== 'none' ) {
				qodefCore[appearanceType + 'HeaderAppearance']();
			}
		}
	};

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
	    function () {
            qodefMobileHeaderAppearance.init();
        }
	);

	/*
	 **	Init mobile header functionality
	 */
	var qodefMobileHeaderAppearance = {
		init: function () {
			if ( qodefCore.body.hasClass( 'qodef-mobile-header-appearance--sticky' ) ) {

				var docYScroll1   = qodefCore.scroll,
					displayAmount = qodefGlobal.vars.mobileHeaderHeight + qodefGlobal.vars.adminBarHeight,
					$pageOuter    = $( '#qodef-page-outer' );

				qodefMobileHeaderAppearance.showHideMobileHeader( docYScroll1, displayAmount, $pageOuter );

				$( window ).scroll(
				    function () {
                        qodefMobileHeaderAppearance.showHideMobileHeader( docYScroll1, displayAmount, $pageOuter );
                        docYScroll1 = qodefCore.scroll;
                    }
				);

				$( window ).resize(
				    function () {
                        $pageOuter.css( 'padding-top', 0 );
                        qodefMobileHeaderAppearance.showHideMobileHeader( docYScroll1, displayAmount, $pageOuter );
                    }
				);
			}
		},
		showHideMobileHeader: function ( docYScroll1, displayAmount, $pageOuter ) {
			if ( qodefCore.windowWidth <= 1200 ) {
				if ( qodefCore.scroll > displayAmount * 2 ) {
					//set header to be fixed
					qodefCore.body.addClass( 'qodef-mobile-header--sticky' );

					//add transition to it
					setTimeout(
						function () {
							qodefCore.body.addClass( 'qodef-mobile-header--sticky-animation' );
						},
						300
					); //300 is duration of sticky header animation

					//add padding to content so there is no 'jumping'
					$pageOuter.css( 'padding-top', qodefGlobal.vars.mobileHeaderHeight );
				} else {
					//unset fixed header
					qodefCore.body.removeClass( 'qodef-mobile-header--sticky' );

					//remove transition
					setTimeout(
						function () {
							qodefCore.body.removeClass( 'qodef-mobile-header--sticky-animation' );
						},
						300
					); //300 is duration of sticky header animation

					//remove padding from content since header is not fixed anymore
					$pageOuter.css( 'padding-top', 0 );
				}

				if ( (qodefCore.scroll > docYScroll1 && qodefCore.scroll > displayAmount) || (qodefCore.scroll < displayAmount * 3) ) {
					//show sticky header
					qodefCore.body.removeClass( 'qodef-mobile-header--sticky-display' );
				} else {
					//hide sticky header
					qodefCore.body.addClass( 'qodef-mobile-header--sticky-display' );
				}
			}
		}
	};

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefNavMenu.init();
		}
	);

	var qodefNavMenu = {
		init: function () {
			qodefNavMenu.dropdownBehavior();
			qodefNavMenu.wideDropdownPosition();
			qodefNavMenu.dropdownPosition();
		},
		dropdownBehavior: function () {
			var $menuItems = $( '.qodef-header-navigation > ul > li' );

			$menuItems.each(
				function () {
					var $thisItem = $( this );

					if ( $thisItem.find( '.qodef-drop-down-second' ).length ) {
						qodef.qodefWaitForImages.check(
							$thisItem,
							function () {
								var $dropdownHolder      = $thisItem.find( '.qodef-drop-down-second' ),
									$dropdownMenuItem    = $dropdownHolder.find( '.qodef-drop-down-second-inner ul' ),
									dropDownHolderHeight = $dropdownMenuItem.outerHeight();

								if ( navigator.userAgent.match( /(iPod|iPhone|iPad)/ ) ) {
									$thisItem.on(
										'touchstart mouseenter',
										function () {
											$dropdownHolder.css(
												{
													'height': dropDownHolderHeight,
													'overflow': 'visible',
													'visibility': 'visible',
													'opacity': '1',
												}
											);
										}
									).on(
										'mouseleave',
										function () {
											$dropdownHolder.css(
												{
													'height': '0px',
													'overflow': 'hidden',
													'visibility': 'hidden',
													'opacity': '0',
												}
											);
										}
									);
								} else {
									if ( qodefCore.body.hasClass( 'qodef-drop-down-second--animate-height' ) ) {
										var animateConfig = {
											interval: 0,
											over: function () {
												setTimeout(
													function () {
														$dropdownHolder.addClass( 'qodef-drop-down--start' ).css(
															{
																'visibility': 'visible',
																'height': '0',
																'opacity': '1',
															}
														);
														$dropdownHolder.stop().animate(
															{
																'height': dropDownHolderHeight,
															},
															400,
															'linear',
															function () {
																$dropdownHolder.css( 'overflow', 'visible' );
															}
														);
													},
													100
												);
											},
											timeout: 100,
											out: function () {
												$dropdownHolder.stop().animate(
													{
														'height': '0',
														'opacity': 0,
													},
													100,
													function () {
														$dropdownHolder.css(
															{
																'overflow': 'hidden',
																'visibility': 'hidden',
															}
														);
													}
												);

												$dropdownHolder.removeClass( 'qodef-drop-down--start' );
											}
										};

										$thisItem.hoverIntent( animateConfig );
									} else {
										var config = {
											interval: 0,
											over: function () {
												setTimeout(
													function () {
														$dropdownHolder.addClass( 'qodef-drop-down--start' ).stop().css( { 'height': dropDownHolderHeight } );
													},
													150
												);
											},
											timeout: 150,
											out: function () {
												$dropdownHolder.stop().css( { 'height': '0' } ).removeClass( 'qodef-drop-down--start' );
											}
										};

										$thisItem.hoverIntent( config );
									}
								}
							}
						);
					}
				}
			);
		},
		wideDropdownPosition: function () {
			var $menuItems = $( '.qodef-header-navigation > ul > li.qodef-menu-item--wide' );

			if ( $menuItems.length ) {
				$menuItems.each(
					function () {
						var $menuItem        = $( this );
						var $menuItemSubMenu = $menuItem.find( '.qodef-drop-down-second' );

						if ( $menuItemSubMenu.length ) {
							$menuItemSubMenu.css( 'left', 0 );

							var leftPosition = $menuItemSubMenu.offset().left;

							if ( qodefCore.body.hasClass( 'qodef--boxed' ) ) {
								//boxed layout case
								var boxedWidth = $( '.qodef--boxed #qodef-page-wrapper' ).outerWidth();
								leftPosition   = leftPosition - (qodefCore.windowWidth - boxedWidth) / 2;
								$menuItemSubMenu.css( { 'left': -leftPosition, 'width': boxedWidth } );

							} else if ( qodefCore.body.hasClass( 'qodef-drop-down-second--full-width' ) ) {
								//wide dropdown full width case
								$menuItemSubMenu.css( { 'left': -leftPosition, 'width': qodefCore.windowWidth } );
							} else {
								//wide dropdown in grid case
								$menuItemSubMenu.css( { 'left': -leftPosition + (qodefCore.windowWidth - $menuItemSubMenu.width()) / 2 } );
							}
						}
					}
				);
			}
		},
		dropdownPosition: function () {
			var $menuItems = $( '.qodef-header-navigation > ul > li.qodef-menu-item--narrow.menu-item-has-children' );

			if ( $menuItems.length ) {
				$menuItems.each(
					function () {
						var $thisItem         = $( this ),
							menuItemPosition  = $thisItem.offset().left,
							$dropdownHolder   = $thisItem.find( '.qodef-drop-down-second' ),
							$dropdownMenuItem = $dropdownHolder.find( '.qodef-drop-down-second-inner ul' ),
							dropdownMenuWidth = $dropdownMenuItem.outerWidth(),
							menuItemFromLeft  = $( window ).width() - menuItemPosition;

						if ( qodef.body.hasClass( 'qodef--boxed' ) ) {
							//boxed layout case
							var boxedWidth   = $( '.qodef--boxed #qodef-page-wrapper' ).outerWidth();
							menuItemFromLeft = boxedWidth - menuItemPosition;
						}

						var dropDownMenuFromLeft;

						if ( $thisItem.find( 'li.menu-item-has-children' ).length > 0 ) {
							dropDownMenuFromLeft = menuItemFromLeft - dropdownMenuWidth;
						}

						$dropdownHolder.removeClass( 'qodef-drop-down--right' );
						$dropdownMenuItem.removeClass( 'qodef-drop-down--right' );
						if ( menuItemFromLeft < dropdownMenuWidth || dropDownMenuFromLeft < dropdownMenuWidth ) {
							$dropdownHolder.addClass( 'qodef-drop-down--right' );
							$dropdownMenuItem.addClass( 'qodef-drop-down--right' );
						}
					}
				);
			}
		}
	};

})( jQuery );

(function ( $ ) {
	'use strict';

	$( window ).on(
		'load',
		function () {
			qodefParallaxBackground.init();
		}
	);

	/**
	 * Init global parallax background functionality
	 */
	var qodefParallaxBackground = {
		init: function ( settings ) {
			this.$sections = $( '.qodef-parallax' );

			// Allow overriding the default config
			$.extend(
				this.$sections,
				settings
			);

			if ( this.$sections.length) {
				this.$sections.each(
					function () {
						if (!$( this ).hasClass('qodef-parallax--init')){//added from elementor js
							qodefParallaxBackground.ready($( this ));
						}
					}
				);
			}
		},
		ready: function ( $section ) {
			qodef.qodefWaitForImages.check(
				$section,
				function () {
					qodefParallaxBackground.animateParallax( $section );
				}
			);
		},
		animateParallax: function ( $section ) {

			var $parallaxHolder = $section.find('.qodef-parallax-img-holder'),
				maxY =  $parallaxHolder.outerHeight() - $section.outerHeight();

			gsap.to(
				$parallaxHolder,
				{
					opacity: 1,
				}
			)

			const tl = gsap.timeline({
				scrollTrigger: {
					trigger: $section,
					scrub: 1.4,//change between 1 and 2 to get more or less smooth effect
					start: () => {
						return "top bottom"
					},
					end: () => {
						return "bottom top";
					},
					// markers: true,//debugging
				}
			});

			tl.to(
				$parallaxHolder,
				{
					y: -maxY,
				}
			)
		}
	};

	qodefCore.qodefParallaxBackground = qodefParallaxBackground;

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefReview.init();
		}
	);

	var qodefReview = {
		init: function () {
			var ratingHolder = $( '#qodef-page-comments-form .qodef-rating-inner' );

			var addActive = function ( stars, ratingValue ) {
				for ( var i = 0; i < stars.length; i++ ) {
					var star = stars[i];

					if ( i < ratingValue ) {
						$( star ).addClass( 'active' );
					} else {
						$( star ).removeClass( 'active' );
					}
				}
			};

			ratingHolder.each(
				function () {
					var thisHolder  = $( this ),
						ratingInput = thisHolder.find( '.qodef-rating' ),
						ratingValue = ratingInput.val(),
						stars       = thisHolder.find( '.qodef-star-rating' );

					addActive( stars, ratingValue );

					stars.on(
						'click',
						function () {
							ratingInput.val( $( this ).data( 'value' ) ).trigger( 'change' );
						}
					);

					ratingInput.change(
						function () {
							ratingValue = ratingInput.val();

							addActive( stars, ratingValue );
						}
					);
				}
			);
		}
	};

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefSideArea.init();
		}
	);

	var qodefSideArea = {
		init: function () {
			var $sideAreaOpener = $( 'a.qodef-side-area-opener' ),
				$sideAreaClose  = $( '#qodef-side-area-close' ),
				$sideArea       = $( '#qodef-side-area' );

			qodefSideArea.openerHoverColor( $sideAreaOpener );

			// Open Side Area
			$sideAreaOpener.on(
				'click',
				function ( e ) {
					e.preventDefault();

					if ( ! qodefCore.body.hasClass( 'qodef-side-area--opened' ) ) {
						qodefSideArea.openSideArea();

						$( document ).keyup(
							function ( e ) {
								if ( e.keyCode === 27 ) {
									qodefSideArea.closeSideArea();
								}
							}
						);
					} else {
						qodefSideArea.closeSideArea();
					}
				}
			);

			$sideAreaClose.on(
				'click',
				function ( e ) {
					e.preventDefault();
					qodefSideArea.closeSideArea();
				}
			);

			if ( $sideArea.length && typeof qodefCore.qodefPerfectScrollbar === 'object' ) {
				qodefCore.qodefPerfectScrollbar.init( $sideArea );
			}
		},
		openSideArea: function () {
			var $wrapper      = $( '#qodef-page-wrapper' );
			var currentScroll = $( window ).scrollTop();

			$( '.qodef-side-area-cover' ).remove();
			$wrapper.prepend( '<div class="qodef-side-area-cover"/>' );
			qodefCore.body.removeClass( 'qodef-side-area-animate--out' ).addClass( 'qodef-side-area--opened qodef-side-area-animate--in' );

			$( '.qodef-side-area-cover' ).on(
				'click',
				function ( e ) {
					e.preventDefault();
					qodefSideArea.closeSideArea();
				}
			);

			$( window ).scroll(
				function () {
					if ( Math.abs( qodefCore.scroll - currentScroll ) > 400 ) {
						qodefSideArea.closeSideArea();
					}
				}
			);
		},
		closeSideArea: function () {
			qodefCore.body.removeClass( 'qodef-side-area--opened qodef-side-area-animate--in' ).addClass( 'qodef-side-area-animate--out' );
		},
		openerHoverColor: function ( $opener ) {
			if ( typeof $opener.data( 'hover-color' ) !== 'undefined' ) {
				var hoverColor    = $opener.data( 'hover-color' );
				var originalColor = $opener.css( 'color' );

				$opener.on(
					'mouseenter',
					function () {
						$opener.css( 'color', hoverColor );
					}
				).on(
					'mouseleave',
					function () {
						$opener.css( 'color', originalColor );
					}
				);
			}
		}
	};

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
		function() {
			qodefSpinner.init();
		}
	);

	$( window ).on(
		'load',
		function () {
			qodefSpinner.windowLoaded = true;

			if (document.visibilityState === 'visible') {
				qodefSpinner.fadeOutLoader();
			} else {
				document.addEventListener("visibilitychange", function() {
					if (document.visibilityState === 'visible') {
						qodefSpinner.fadeOutLoader();
					}
				});
			}
		}
	);

	$( window ).on(
		'elementor/frontend/init',
		function () {
			var isEditMode = Boolean( elementorFrontend.isEditMode() );

			if ( isEditMode ) {
				qodefSpinner.init( isEditMode );
			}
		}
	);

	var qodefSpinner = {
		holder: '',
		windowLoaded: false,
		init: function ( isEditMode ) {
			this.holder = $( '#qodef-page-spinner:not(.qodef--custom-spinner):not(.qodef-layout--textual)' );

			if ( this.holder.length ) {
				qodefSpinner.animateSpinner( isEditMode );
				qodefSpinner.fadeOutAnimation();
			}
		},
		animateSpinner: function ( isEditMode ) {

			if ( isEditMode ) {
				qodefSpinner.fadeOutLoader();
			}
		},
		fadeOutLoader: function ( speed, delay, easing ) {
			var $holder = qodefSpinner.holder.length ? qodefSpinner.holder : $( '#qodef-page-spinner:not(.qodef--custom-spinner):not(.qodef-layout--textual)' );

			speed  = speed ? speed : 600;
			delay  = delay ? delay : 0;
			easing = easing ? easing : 'swing';

			$holder.delay( delay ).fadeOut( speed, easing );

			$( window ).on(
				'bind',
				'pageshow',
				function ( event ) {
					if ( event.originalEvent.persisted ) {
						$holder.fadeOut( speed, easing );
					}
				}
			);
		},
		fadeOutAnimation: function () {

			// Check for fade out animation
			if ( qodefCore.body.hasClass( 'qodef-spinner--fade-out' ) ) {
				var $pageHolder = $( '#qodef-page-wrapper' ),
					$linkItems  = $( 'a' );

				// If back button is pressed, then show content to avoid state where content is on display:none
				window.addEventListener(
					'pageshow',
					function ( event ) {
						var historyPath = event.persisted || (typeof window.performance !== 'undefined' && window.performance.navigation.type === 2);
						if ( historyPath && ! $pageHolder.is( ':visible' ) ) {
							$pageHolder.show();
						}
					}
				);

				$linkItems.on(
					'click',
					function ( e ) {
						var $clickedLink = $( this );

						if (
							e.which === 1 && // check if the left mouse button has been pressed
							$clickedLink.attr( 'href' ).indexOf( window.location.host ) >= 0 && // check if the link is to the same domain
							! $clickedLink.hasClass( 'remove' ) && // check is WooCommerce remove link
							$clickedLink.parent( '.product-remove' ).length <= 0 && // check is WooCommerce remove link
							$clickedLink.parents( '.woocommerce-product-gallery__image' ).length <= 0 && // check is product gallery link
							typeof $clickedLink.data( 'rel' ) === 'undefined' && // check pretty photo link
							typeof $clickedLink.attr( 'rel' ) === 'undefined' && // check VC pretty photo link
							! $clickedLink.hasClass( 'lightbox-active' ) && // check is lightbox plugin active
							(typeof $clickedLink.attr( 'target' ) === 'undefined' || $clickedLink.attr( 'target' ) === '_self') && // check if the link opens in the same window
							$clickedLink.attr( 'href' ).split( '#' )[0] !== window.location.href.split( '#' )[0] // check if it is an anchor aiming for a different page
						) {
							e.preventDefault();

							$pageHolder.fadeOut(
								600,
								'easeOutSine',
								function () {
									window.location = $clickedLink.attr( 'href' );
								}
							);
						}
					}
				);
			}
		}
	};

	qodefCore.qodefSpinner = qodefSpinner;

})( jQuery );

(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.einar_core_accordion = {};

	$( document ).ready(
		function () {
			qodefAccordion.init();
		}
	);

	var qodefAccordion = {
		init: function () {
			var $holder = $( '.qodef-accordion' );

			if ( $holder.length ) {
				$holder.each(
					function () {
						qodefAccordion.initItem( $( this ) );
					}
				);
			}
		},
		initItem: function ( $currentItem ) {
			if ( $currentItem.hasClass( 'qodef-behavior--accordion' ) ) {
				qodefAccordion.initAccordion( $currentItem );
			}

			if ( $currentItem.hasClass( 'qodef-behavior--toggle' ) ) {
				qodefAccordion.initToggle( $currentItem );
			}

			$currentItem.addClass( 'qodef--init' );
		},
		initAccordion: function ( $accordion ) {
			$accordion.accordion(
				{
					animate: 'swing',
					collapsible: true,
					active: 0,
					icons: '',
					heightStyle: 'auto',
				}
			);
		},
		initToggle: function ( $toggle ) {
			var $toggleAccordionTitle = $toggle.find( '.qodef-accordion-title' );

			$toggleAccordionTitle.off().on(
				'mouseenter',
				function () {
					$( this ).addClass( 'ui-state-hover' );
				}
			).on(
				'mouseleave',
				function () {
					$( this ).removeClass( 'ui-state-hover' );
				}
			).on(
				'click',
				function ( e ) {
					e.preventDefault();
					e.stopImmediatePropagation();

					var $thisTitle = $( this );

					if ( $thisTitle.hasClass( 'ui-state-active' ) ) {
						$thisTitle.removeClass( 'ui-state-active' );
						$thisTitle.next().removeClass( 'ui-accordion-content-active' ).slideUp( 300 );
					} else {
						$thisTitle.addClass( 'ui-state-active' );
						$thisTitle.next().addClass( 'ui-accordion-content-active' ).slideDown( 400 );
					}
				}
			);
		}
	};

	qodefCore.shortcodes.einar_core_accordion.qodefAccordion = qodefAccordion;

})( jQuery );

(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.einar_core_animated_text_image_slider = {};

	$( document ).ready(
		function () {
			qodefAnimatedTextImageSlider.init();
		}
	);

	var qodefAnimatedTextImageSlider = {
		init: function () {
			this.holder = $( '.qodef-animated-text-image-slider' );

			if ( this.holder.length ) {
				this.holder.each(
					function () {
						var $thisHolder = $( this );
						qodefAnimatedTextImageSlider.createSlider( $thisHolder );
						qodefAnimatedTextImageSlider.fullHeightSliderCalc( $thisHolder );

						$( window ).resize(
							function () {
								qodefAnimatedTextImageSlider.fullHeightSliderCalc( $thisHolder );
							}
						);
					}
				);
			}
		},
		createSlider: function ( $holder ) {
			var $swiperHolder     = $holder.find( '.qodef-m-image-holder' );
			var $paginationHolder = $holder.find( '.swiper-pagination' );

			var sliderOptions  = typeof $swiperHolder.data( 'options' ) !== 'undefined' ? $swiperHolder.data( 'options' ) : {},
				slidesPerView  = 1,
				loop           = sliderOptions.loop !== undefined && sliderOptions.loop !== '' ? sliderOptions.loop : true,
				autoplay       = sliderOptions.autoplay !== undefined && sliderOptions.autoplay !== '' ? sliderOptions.autoplay : true,
				speed          = sliderOptions.speed !== undefined && sliderOptions.speed !== '' ? parseInt(
					sliderOptions.speed,
					10
				) : 5000,
				speedAnimation = sliderOptions.speedAnimation !== undefined && sliderOptions.speedAnimation !== '' ? parseInt(
					sliderOptions.speedAnimation,
					10
				) : 1000,
				spaceBetween   = 0,
				centeredSlides = false,
				nextNavigation = $holder.find( '.swiper-button-next' ),
				prevNavigation = $holder.find( '.swiper-button-prev' );

			if ( autoplay === true ) {
				autoplay = {
					delay: speed,
					disableOnInteraction: false
				};
			}

			var $swiper = new Swiper(
				$swiperHolder,
				{
					slidesPerView: slidesPerView,
					centeredSlides: centeredSlides,
					spaceBetween: spaceBetween,
					autoplay: autoplay,
					loop: loop,
					speed: speedAnimation,
					navigation: { nextEl: nextNavigation, prevEl: prevNavigation },
					pagination: {
						el: $paginationHolder,
						type: 'bullets',
						renderBullet: function (index) {

							var transition = autoplay.delay + speedAnimation;

							if (autoplay === false) {
								transition = 0;
							}
							var number = ( index + 1 ) < 10 ? ( index + 1 ) : ( index + 1 );

							if (autoplay.delay && speedAnimation) {
								return '<span class="swiper-pagination-bullet"><span class="qodef-swiper-number">' + number + '</span><span class="qodef-swiper-line-below"><span class="qodef-swiper-line-over" style="animation-duration: ' + transition + 'ms;"></span></span></span>';
							} else {
								return '<span class="swiper-pagination-bullet"><span class="qodef-swiper-number">' + number + '</span><span class="qodef-swiper-line-below"><span class="qodef-swiper-line-over"></span></span></span>';
							}
						},
						clickable: true
					},
					on: {
						init: function () {
							$swiperHolder.addClass( 'qodef-swiper--initialized' );

							setTimeout(
								function () {
									var paginationWidth = $holder.find( '.swiper-pagination' ).outerWidth();

									$holder.addClass( 'qodef--init' );
								},
								500
							);
						},
						slideChange: function slideChange() {
							var swiper      = this;
							var activeIndex = swiper.activeIndex;
						}
					}
				}
			);
		},
		fullHeightSliderCalc: function ( $holder ) {
			var windowHeight       = (window.innerHeight || document.documentElement.clientHeight);
			var sliderHeight       = '';
			var headerHeight       = qodefGlobal.vars.headerHeight;
			var mobileHeaderHeight = qodefGlobal.vars.mobileHeaderHeight;
			var topAreaHeight      = qodefGlobal.vars.topAreaHeight;

			if ( $holder.hasClass( 'qodef-full-height-slider--yes' ) && qodefCore.windowWidth > 1024 ) {

				if ( qodefCore.body.hasClass( 'qodef-header--vertical' ) || qodefCore.body.hasClass( 'qodef-header--vertical-sliding' ) ) {
					headerHeight  = 0;
					topAreaHeight = 0;
				}

				if ( $holder.hasClass( 'qodef-full-height-without-header' ) ) {
					sliderHeight = windowHeight - qodefGlobal.vars.adminBarHeight;
				} else {
					sliderHeight = windowHeight - headerHeight - topAreaHeight - qodefGlobal.vars.adminBarHeight;
				}

				if ( qodefCore.body.hasClass( 'qodef--passepartout' ) ) {
					var passepartoutSize = parseInt( qodefCore.body.css( 'padding-top' ) );

					sliderHeight -= passepartoutSize;
				}

			} else if ( $holder.hasClass( 'qodef-full-height-slider--yes' ) && qodefCore.windowWidth <= 1024 ) {
				sliderHeight = windowHeight - mobileHeaderHeight - qodefGlobal.vars.adminBarHeight;
			} else {
				sliderHeight = 'auto';
			}

			$holder.height( sliderHeight );
		}
	};

	qodefCore.shortcodes.einar_core_animated_text_image_slider.qodefAnimatedTextImageSlider = qodefAnimatedTextImageSlider;

})( jQuery );

(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.einar_core_button = {};

	$( document ).ready(
		function () {
			qodefButton.init();
		}
	);

	var qodefButton = {
		init: function () {
			this.buttons = $( '.qodef-button' );

			if ( this.buttons.length ) {
				this.buttons.each(
					function () {
						qodefButton.initItem( $( this ) );
					}
				);
			}
		},
		initItem: function ( $currentItem ) {
			qodefButton.buttonHoverColor( $currentItem );
			qodefButton.buttonHoverBgColor( $currentItem );
			qodefButton.buttonHoverBorderColor( $currentItem );
		},
		buttonHoverColor: function ( $button ) {
			if ( typeof $button.data( 'hover-color' ) !== 'undefined' ) {
				var hoverColor    = $button.data( 'hover-color' );
				var originalColor = $button.css( 'color' );

				$button.on(
					'mouseenter touchstart',
					function () {
						qodefButton.changeColor( $button, 'color', hoverColor );
					}
				);
				$button.on(
					'mouseleave touchend',
					function () {
						qodefButton.changeColor( $button, 'color', originalColor );
					}
				);
			}
		},
		buttonHoverBgColor: function ( $button ) {
			if ( typeof $button.data( 'hover-background-color' ) !== 'undefined' ) {
				var hoverBackgroundColor    = $button.data( 'hover-background-color' );
				var originalBackgroundColor = $button.css( 'background-color' );

				$button.on(
					'mouseenter touchstart',
					function () {
						qodefButton.changeColor( $button, 'background-color', hoverBackgroundColor );
					}
				);
				$button.on(
					'mouseleave touchend',
					function () {
						qodefButton.changeColor( $button, 'background-color', originalBackgroundColor );
					}
				);
			}
		},
		buttonHoverBorderColor: function ( $button ) {
			if ( typeof $button.data( 'hover-border-color' ) !== 'undefined' ) {
				var hoverBorderColor    = $button.data( 'hover-border-color' );
				var originalBorderColor = $button.css( 'borderTopColor' );

				$button.on(
					'mouseenter touchstart',
					function () {
						qodefButton.changeColor( $button, 'border-color', hoverBorderColor );
					}
				);
				$button.on(
					'mouseleave touchend',
					function () {
						qodefButton.changeColor( $button, 'border-color', originalBorderColor );
					}
				);
			}
		},
		changeColor: function ( $button, cssProperty, color ) {
			$button.css( cssProperty, color );
		}
	};

	qodefCore.shortcodes.einar_core_button.qodefButton = qodefButton;

})( jQuery );

(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.einar_core_countdown = {};

	$( document ).ready(
		function () {
			qodefCountdown.init();
		}
	);

	var qodefCountdown = {
		init: function () {
			this.countdowns = $( '.qodef-countdown' );

			if ( this.countdowns.length ) {
				this.countdowns.each(
					function () {
						qodefCountdown.initItem( $( this ) );
					}
				);
			}
		},
		initItem: function ( $currentItem ) {
			var $countdownElement = $currentItem.find( '.qodef-m-date' ),
				dateFormats       = ['week', 'day', 'hour', 'minute', 'second'],
				options           = qodefCountdown.generateOptions( $currentItem, dateFormats );

			qodefCountdown.initCountdown( $countdownElement, options, dateFormats );
		},
		generateOptions: function ( $countdown, dateFormats ) {
			var options = {};

			options.date = typeof $countdown.data( 'date' ) !== 'undefined' ? $countdown.data( 'date' ) : null;

			for ( var i = 0; i < dateFormats.length; i++ ) {
				var label       = dateFormats[i] + 'Label',
					labelPlural = dateFormats[i] + 'LabelPlural';

				options[label]       = typeof $countdown.data( dateFormats[i] + '-label' ) !== 'undefined' ? $countdown.data( dateFormats[i] + '-label' ) : '';
				options[labelPlural] = typeof $countdown.data( dateFormats[i] + '-label-plural' ) !== 'undefined' ? $countdown.data( dateFormats[i] + '-label-plural' ) : '';
			}

			return options;
		},
		initCountdown: function ( $countdownElement, options, dateFormats ) {
			var countDownDate = new Date( options.date ).getTime();

			// Update the count down every 1 second
			var x = setInterval(
				function () {

					// Get today's date and time
					var now = new Date().getTime();

					// Find the distance between now and the count down date
					var distance = countDownDate - now;

					// Time calculations for days, hours, minutes and seconds
					this.weeks   = Math.floor( distance / (1000 * 60 * 60 * 24 * 7) );
					this.days    = Math.floor( (distance % (1000 * 60 * 60 * 24 * 7)) / (1000 * 60 * 60 * 24) );
					this.hours   = Math.floor( (distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60) );
					this.minutes = Math.floor( (distance % (1000 * 60 * 60)) / (1000 * 60) );
					this.seconds = Math.floor( (distance % (1000 * 60)) / 1000 );

					for ( var i = 0; i < dateFormats.length; i++ ) {
						var dateName = dateFormats[i] + 's';
						qodefCountdown.initiateDate( $countdownElement, this[dateName], dateFormats[i], options );
					}

					// If the count down is finished, write some text
					if ( distance < 0 ) {
						clearInterval( x );
						qodefCountdown.afterClearInterval( $countdownElement, dateFormats, options );
					}
				},
				1000
			);
		},
		initiateDate: function ( $countdownElement, date, dateFormat, options ) {
			var $holder = $countdownElement.find( '.qodef-' + dateFormat + 's' );

			$holder.find( '.qodef-label' ).html( ( 1 === date ) ? options[dateFormat + 'Label'] : options[dateFormat + 'LabelPlural'] );

			date = (date < 10) ? '0' + date : date;

			$holder.find( '.qodef-digit' ).html( date );
		},
		afterClearInterval: function( $countdownElement, dateFormats, options ) {
			for ( var i = 0; i < dateFormats.length; i++ ) {
				var $holder = $countdownElement.find( '.qodef-' + dateFormats[i] + 's' );

				$holder.find( '.qodef-label' ).html( options[dateFormats[i] + 'LabelPlural'] );
				$holder.find( '.qodef-digit' ).html( '00' );
			}
		}
	};

	qodefCore.shortcodes.einar_core_countdown.qodefCountdown = qodefCountdown;

})( jQuery );

(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.einar_core_counter = {};

	$( document ).ready(
		function () {
			qodefCounter.init();
		}
	);

	var qodefCounter = {
		init: function () {
			this.counters = $( '.qodef-counter' );

			if ( this.counters.length ) {
				this.counters.each(
					function () {
						qodefCounter.initItem( $( this ) );
					}
				);
			}
		},
		initItem: function ( $currentItem ) {
			var $counterElement = $currentItem.find( '.qodef-m-digit' ),
				options         = qodefCounter.generateOptions( $currentItem );

			qodefCore.qodefIsInViewport.check(
				$currentItem,
				function () {
					qodefCounter.counterScript( $counterElement, options );
				},
			);
		},
		generateOptions: function ( $counter ) {
			var options   = {};
			options.start = typeof $counter.data( 'start-digit' ) !== 'undefined' && $counter.data( 'start-digit' ) !== '' ? $counter.data( 'start-digit' ) : 0;
			options.end   = typeof $counter.data( 'end-digit' ) !== 'undefined' && $counter.data( 'end-digit' ) !== '' ? $counter.data( 'end-digit' ) : null;
			options.step  = typeof $counter.data( 'step-digit' ) !== 'undefined' && $counter.data( 'step-digit' ) !== '' ? $counter.data( 'step-digit' ) : 1;
			options.delay = typeof $counter.data( 'step-delay' ) !== 'undefined' && $counter.data( 'step-delay' ) !== '' ? parseInt( $counter.data( 'step-delay' ), 10 ) : 100;
			options.txt   = typeof $counter.data( 'digit-label' ) !== 'undefined' && $counter.data( 'digit-label' ) !== '' ? $counter.data( 'digit-label' ) : '';

			return options;
		},
		counterScript: function ( $counterElement, options ) {
			var defaults = {
				start: 0,
				end: null,
				step: 1,
				delay: 50,
				txt: '',
			};

			var settings = $.extend( defaults, options || {} );
			var nb_start = settings.start;
			var nb_end   = settings.end;

			$counterElement.text( nb_start + settings.txt );

			// Timer
			// Launches every "settings.delay"
			var counterInterval = setInterval(
				function () {
					// Definition of conditions of arrest
					if ( nb_end !== null && nb_start >= nb_end ) {
						return;
					}

					// incrementation
					nb_start = nb_start + settings.step;

					// Check is ended
					if ( nb_start >= nb_end ) {
						nb_start = nb_end;

						clearInterval( counterInterval );
					}

					// display
					$counterElement.text( nb_start + settings.txt );
				},
				settings.delay
			);
		}
	};

	qodefCore.shortcodes.einar_core_counter.qodefCounter = qodefCounter;
	qodefCore.shortcodes.einar_core_counter.qodefAppear     = qodefCore.qodefAppear;

})( jQuery );

(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.einar_core_custom_font = {};

	$( window ).on(
		'load',
		function () {
			qodefCustomFont.init();
		}
	);

	var qodefCustomFont = {
		init: function () {
			this.customfonts = $( '.qodef-custom-font' );

			if ( this.customfonts.length ) {
				this.customfonts.each( function () {
					var $thisCustomFont = $( this );

					qodefCustomFont.typeOutEffect( $thisCustomFont );
				} );
			}
		},
		typeOutEffect: function ( $thisCustomFont ) {
			var $typed = $thisCustomFont.find( '.qodef-cf-typed' );

			if ( $typed.length ) {

				$typed.each( function () {

					var $thisTyped        = $( this ),
						$typedWrap        = $thisTyped.parent( '.qodef-cf-typed-wrap' ),
						$customFontHolder = $typedWrap.parent( '.qodef-custom-font' ),
						$strings          = $typedWrap.data( 'strings' );

					var options = {
						strings: $strings,
						typeSpeed: 90,
						backDelay: 700,
						loop: true,
						contentType: 'text',
						loopCount: false,
						cursorChar: '|'
					};

					if ( ! $thisTyped.hasClass( 'qodef--initialized' ) ) {

						var typed = new Typed(
							$thisTyped[0],
							options
						);
						$thisTyped.addClass( 'qodef--initialized' );
					}
				} );
			}
		}
	};

	qodefCore.shortcodes.einar_core_custom_font.qodefCustomFont = qodefCustomFont;
	qodefCore.shortcodes.einar_core_custom_font.qodefAppear     = qodefCore.qodefAppear;

})( jQuery );

(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.einar_core_dual_image = {};

	$( window ).on(
		'load',
		function () {
			qodefDualImage.init();
		}
	);

	var qodefDualImage = {
		init: function () {
			this.$sections = $( '.qodef-dual-image' );

			if ( this.$sections.length) {
				this.$sections.each(
					function () {
						qodefDualImage.ready($( this ));
					}
				);
			}
		},
		ready: function ( $section ) {
			qodef.qodefWaitForImages.check(
				$section,
				function () {
					qodefDualImage.animateParallax( $section );
				}
			);
		},
		animateParallax: function ( $section ) {

			var $frontImage = $section.find('.qodef-m-image-front'),
				maxX =  $section.outerWidth() - $frontImage.outerWidth(),
				$backImage = $section.find('.qodef-m-image');


			const tl = gsap.timeline({
				scrollTrigger: {
					trigger: $section,
					scrub: 1.2,//change between 1 and 2 to get more or less smooth effect
					start: () => {
						return "top-=125 top"
					},
					end: () => {
						return "bottom top";
					},
					// markers: true,//debugging
				}
			});

			tl
			.to(
				$frontImage,
				{
					x: `${maxX/2}`,
				}
			)
			.to(
				$backImage,
				{
					scale: 1.3,
					rotate: 20,
					ease: 'power3.out'
				},
				'<'
			)
		}
	};

	qodefCore.shortcodes.einar_core_dual_image.qodefDualImage = qodefDualImage;

})( jQuery );

(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.einar_core_google_map = {};

	$( document ).ready(
		function () {
			qodefGoogleMap.init();
		}
	);

	var qodefGoogleMap = {
		init: function () {
			this.holder = $( '.qodef-google-map' );

			if ( this.holder.length ) {
				this.holder.each(
					function () {
						qodefGoogleMap.initItem( $( this ) );
					}
				);
			}
		},
		initItem: function ( $currentItem ) {
			if ( typeof window.qodefGoogleMap !== 'undefined' ) {
				window.qodefGoogleMap.init( $currentItem.find( '.qodef-m-map' ) );
			}
		},
	};

	qodefCore.shortcodes.einar_core_google_map.qodefGoogleMap = qodefGoogleMap;

})( jQuery );

(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.einar_core_icon = {};

	$( document ).ready(
		function () {
			qodefIcon.init();
		}
	);

	var qodefIcon = {
		init: function () {
			this.icons = $( '.qodef-icon-holder' );

			if ( this.icons.length ) {
				this.icons.each(
					function () {
						qodefIcon.initItem( $( this ) );
					}
				);
			}
		},
		initItem: function ( $currentItem ) {
			qodefIcon.iconHoverColor( $currentItem );
			qodefIcon.iconHoverBgColor( $currentItem );
			qodefIcon.iconHoverBorderColor( $currentItem );
		},
		iconHoverColor: function ( $iconHolder ) {
			if ( typeof $iconHolder.data( 'hover-color' ) !== 'undefined' ) {
				var spanHolder    = $iconHolder.find( 'span' ).length ? $iconHolder.find( 'span' ) : $iconHolder;
				var originalColor = spanHolder.css( 'color' );
				var hoverColor    = $iconHolder.data( 'hover-color' );

				$iconHolder.on(
					'mouseenter',
					function () {
						qodefIcon.changeColor(
							spanHolder,
							'color',
							hoverColor
						);
					}
				);
				$iconHolder.on(
					'mouseleave',
					function () {
						qodefIcon.changeColor(
							spanHolder,
							'color',
							originalColor
						);
					}
				);
			}
		},
		iconHoverBgColor: function ( $iconHolder ) {
			if ( typeof $iconHolder.data( 'hover-background-color' ) !== 'undefined' ) {
				var hoverBackgroundColor    = $iconHolder.data( 'hover-background-color' );
				var originalBackgroundColor = $iconHolder.css( 'background-color' );

				$iconHolder.on(
					'mouseenter',
					function () {
						qodefIcon.changeColor(
							$iconHolder,
							'background-color',
							hoverBackgroundColor
						);
					}
				);
				$iconHolder.on(
					'mouseleave',
					function () {
						qodefIcon.changeColor(
							$iconHolder,
							'background-color',
							originalBackgroundColor
						);
					}
				);
			}
		},
		iconHoverBorderColor: function ( $iconHolder ) {
			if ( typeof $iconHolder.data( 'hover-border-color' ) !== 'undefined' ) {
				var hoverBorderColor    = $iconHolder.data( 'hover-border-color' );
				var originalBorderColor = $iconHolder.css( 'borderTopColor' );

				$iconHolder.on(
					'mouseenter',
					function () {
						qodefIcon.changeColor(
							$iconHolder,
							'border-color',
							hoverBorderColor
						);
					}
				);
				$iconHolder.on(
					'mouseleave',
					function () {
						qodefIcon.changeColor(
							$iconHolder,
							'border-color',
							originalBorderColor
						);
					}
				);
			}
		},
		changeColor: function ( iconElement, cssProperty, color ) {
			iconElement.css(
				cssProperty,
				color
			);
		}
	};

	qodefCore.shortcodes.einar_core_icon.qodefIcon = qodefIcon;

})( jQuery );

(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.einar_core_image_gallery                    = {};
	qodefCore.shortcodes.einar_core_image_gallery.qodefSwiper        = qodef.qodefSwiper;
	qodefCore.shortcodes.einar_core_image_gallery.qodefMasonryLayout = qodef.qodefMasonryLayout;
	qodefCore.shortcodes.einar_core_image_gallery.qodefMagnificPopup = qodef.qodefMagnificPopup;
	qodefCore.shortcodes.einar_core_image_gallery.qodefCustomCursor  = qodefCore.qodefCustomCursor;

})( jQuery );

(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.einar_core_image_with_text                    = {};
	qodefCore.shortcodes.einar_core_image_with_text.qodefMagnificPopup = qodef.qodefMagnificPopup;
	qodefCore.shortcodes.einar_core_image_with_text.qodefAppear        = qodefCore.qodefAppear;

})( jQuery );

(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.einar_core_interactive_link_showcase = {};

})( jQuery );

(function ($) {
    "use strict";
    
    qodefCore.shortcodes.einar_core_list_item = {};
    qodefCore.shortcodes.einar_core_list_item.qodefAppear = qodef.qodefAppear;
	qodefCore.shortcodes.einar_core_list_item.qodefSplitting = qodef.qodefSplitting;

})(jQuery);
(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.einar_core_progress_bar = {};

	$( document ).ready(
		function () {
			qodefProgressBar.init();
		}
	);

	/**
	 * Init progress bar shortcode functionality
	 */
	var qodefProgressBar = {
		init: function () {
			this.holder = $( '.qodef-progress-bar' );

			if ( this.holder.length ) {
				this.holder.each(
					function () {
						qodefProgressBar.initItem( $( this ) );
					}
				);
			}
		},
		initItem: function ( $currentItem ) {
			var layout = $currentItem.data( 'layout' );

			qodefCore.qodefIsInViewport.check(
				$currentItem,
				function () {
					$currentItem.addClass( 'qodef--init' );

					var $container = $currentItem.find( '.qodef-m-canvas' ),
						data       = qodefProgressBar.generateBarData( $currentItem, layout ),
						number     = $currentItem.data( 'number' ) / 100;

					switch (layout) {
						case 'circle':
							qodefProgressBar.initCircleBar( $container, data, number );
							break;
						case 'semi-circle':
							qodefProgressBar.initSemiCircleBar( $container, data, number );
							break;
						case 'line':
							data = qodefProgressBar.generateLineData( $currentItem, number );
							qodefProgressBar.initLineBar( $container, data );
							break;
						case 'custom':
							qodefProgressBar.initCustomBar( $container, data, number );
							break;
					}
				},
			);
		},
		generateBarData: function ( thisBar, layout ) {
			var activeWidth   = thisBar.data( 'active-line-width' );
			var activeColor   = thisBar.data( 'active-line-color' );
			var inactiveWidth = thisBar.data( 'inactive-line-width' );
			var inactiveColor = thisBar.data( 'inactive-line-color' );
			var easing        = 'linear';
			var duration      = typeof thisBar.data( 'duration' ) !== 'undefined' && thisBar.data( 'duration' ) !== '' ? parseInt( thisBar.data( 'duration' ), 10 ) : 1600;
			var textColor     = thisBar.data( 'text-color' );

			return {
				strokeWidth: activeWidth,
				color: activeColor,
				trailWidth: inactiveWidth,
				trailColor: inactiveColor,
				easing: easing,
				duration: duration,
				svgStyle: {
					width: '100%',
					height: '100%'
				},
				text: {
					style: {
						color: textColor
					},
					autoStyleContainer: false
				},
				from: {
					color: inactiveColor
				},
				to: {
					color: activeColor
				},
				step: function ( state, bar ) {
					if ( layout !== 'custom' ) {
						bar.setText( Math.round( bar.value() * 100 ) + '%' );
					}
				},
			};
		},
		generateLineData: function ( thisBar, number ) {
			var height         = thisBar.data( 'active-line-width' );
			var activeColor    = thisBar.data( 'active-line-color' );
			var inactiveHeight = thisBar.data( 'inactive-line-width' );
			var inactiveColor  = thisBar.data( 'inactive-line-color' );
			var duration       = typeof thisBar.data( 'duration' ) !== 'undefined' && thisBar.data( 'duration' ) !== '' ? parseInt( thisBar.data( 'duration' ), 10 ) : 1600;
			var textColor      = thisBar.data( 'text-color' );

			return {
				percentage: number * 100,
				duration: duration,
				fillBackgroundColor: activeColor,
				backgroundColor: inactiveColor,
				height: height,
				inactiveHeight: inactiveHeight,
				followText: thisBar.hasClass( 'qodef-percentage--floating' ),
				textColor: textColor,
			};
		},
		initCircleBar: function ( $container, data, number ) {
			if ( qodefProgressBar.checkBar( $container ) ) {
				var $bar = new ProgressBar.Circle( $container[0], data );

				$bar.animate( number );
			}
		},
		initSemiCircleBar: function ( $container, data, number ) {
			if ( qodefProgressBar.checkBar( $container ) ) {
				var $bar = new ProgressBar.SemiCircle( $container[0], data );

				$bar.animate( number );
			}
		},
		initCustomBar: function ( $container, data, number ) {
			if ( qodefProgressBar.checkBar( $container ) ) {
				var $bar = new ProgressBar.Path( $container[0], data );

				$bar.set( 0 );
				$bar.animate( number );
			}
		},
		initLineBar: function ( $container, data ) {
			$container.LineProgressbar( data );
		},
		checkBar: function ( $container ) {
			// check if svg is already in container, elementor fix
			return ! $container.find( 'svg' ).length;
		}
	};

	qodefCore.shortcodes.einar_core_progress_bar.qodefProgressBar = qodefProgressBar;

})( jQuery );

(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.einar_core_single_image = {};

	qodefCore.shortcodes.einar_core_single_image.qodefAppear     = qodefCore.qodefAppear;

})( jQuery );

(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.einar_core_swapping_image_gallery = {};

	$( document ).ready(
		function () {
			qodefSwappingImageGallery.init();
		}
	);

	var qodefSwappingImageGallery = {
		init: function () {
			this.holder = $( '.qodef-swapping-image-gallery' );

			if ( this.holder.length ) {
				this.holder.each(
					function () {
						qodefSwappingImageGallery.initItem( $( this ) );
					}
				);
			}
		},
		initItem: function ( $currentItem ) {
			var $swiperHolder     = $currentItem.find( '.qodef-m-image-holder' );
			var $paginationHolder = $currentItem.find( '.qodef-m-thumbnails-holder .qodef-grid-inner' );
			var spaceBetween      = 0;
			var slidesPerView     = 1;
			var centeredSlides    = false;
			var loop              = false;
			var autoplay          = true;
			var speed             = 3000;
			var speedAnimation 	  = 800;

			var $swiper = new Swiper(
				$swiperHolder[0],
				{
					slidesPerView: slidesPerView,
					centeredSlides: centeredSlides,
					spaceBetween: spaceBetween,
					autoplay: autoplay,
					loop: loop,
					speed: speedAnimation,
					pagination: {
						el: $paginationHolder[0],
						type: 'custom',
						clickable: true,
						bulletClass: 'qodef-m-thumbnail',
					},
					on: {
						init: function () {
							$swiperHolder.addClass( 'qodef-swiper--initialized' );
							$paginationHolder.find( '.qodef-m-thumbnail' ).eq( 0 ).addClass( 'qodef--active' );
						},
						slideChange: function slideChange() {
							var swiper      = this;
							var activeIndex = swiper.activeIndex;
							$paginationHolder.find( '.qodef--active' ).removeClass( 'qodef--active' );
							$paginationHolder.find( '.qodef-m-thumbnail' ).eq( activeIndex ).addClass( 'qodef--active' );
						}
					},
				}
			);
		},
	};

	qodefCore.shortcodes.einar_core_swapping_image_gallery.qodefSwappingImageGallery = qodefSwappingImageGallery;

})( jQuery );

(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.einar_core_tabs = {};

	$( document ).ready(
		function () {
			qodefTabs.init();
		}
	);

	var qodefTabs                = {
		init: function () {
			this.holder = $( '.qodef-tabs' );

			if ( this.holder.length ) {
				this.holder.each(
					function () {
						qodefTabs.initItem( $( this ) );
					}
				);
			}
		},
		initItem: function ( $currentItem ) {
			$currentItem.children( '.qodef-tabs-content' ).each(
				function ( index ) {
					index = index + 1;

					var $that    = $( this ),
						link     = $that.attr( 'id' ),
						$navItem = $that.parent().find( '.qodef-tabs-navigation li:nth-child(' + index + ') a' ),
						navLink  = $navItem.attr( 'href' );

					link = '#' + link;

					if ( link.indexOf( navLink ) > -1 ) {
						$navItem.attr(
							'href',
							link
						);
					}
				}
			);

			$currentItem.addClass( 'qodef--init' ).tabs();
			qodef.windowWidth > 680 && qodefTabs.bgAnimation($currentItem.find('.qodef-tabs-navigation'), '.ui-state-active');
		},
		setHeight( $holder ) {
			var $navigation      = $holder.find( '.qodef-tabs-navigation' ),
				$content         = $holder.find( '.qodef-tabs-content' ),
				navHeight,
				contentHeight,
				maxContentHeight = 0;

			if ( $navigation.length ) {
				navHeight = $navigation.outerHeight( true );
			}

			if ( $content.length ) {
				$content.each(
					function () {
						contentHeight 	 = $( this ).outerHeight( true );
						maxContentHeight = contentHeight > maxContentHeight ? contentHeight : maxContentHeight;
					}
				)
			}

			$holder.height( navHeight + maxContentHeight );
		},
		bgAnimation: function($holder, activeClass) {
			$holder.append('<span class="qodef--item-bg"></span>');

			var tabLine = $holder.find('.qodef--item-bg'),
				tabItems = $holder.find('li'),
				initialOffset = tabItems.filter(activeClass).left,
				tabsHolderOffset = $holder.offset().left;

			tabLine.css('width', Math.ceil(tabItems.filter(activeClass).outerWidth()) + 2);

			//initial positioning
			tabLine.css('left',  Math.floor(initialOffset - tabsHolderOffset - 1));

			//fx on
			tabItems.mouseenter(function() {
				var tabItem = $(this),
					tabItemWidth = Math.ceil(tabItem.outerWidth() + 2),
					tabItemOffset = Math.floor(tabItem.offset().left - tabsHolderOffset - 1);

				tabLine.css('width', tabItemWidth);
				tabLine.css('left', tabItemOffset);
			});

			//fx off
			tabItems.mouseleave(function(){
				tabLine.css('width', Math.ceil(tabItems.filter(activeClass).outerWidth()) + 2);
				tabLine.css('left',  Math.floor(tabItems.filter(activeClass).offset().left - tabsHolderOffset) - 1);
			});
		},
	};

	qodefCore.shortcodes.einar_core_tabs.qodefTabs = qodefTabs;

})( jQuery );

(function ($) {
	'use strict';

	qodefCore.shortcodes.einar_core_text_marquee = {};

	$(document).ready(
		function () {
			qodefTextMarquee.init();
		}
	);

	$(window).resize(
		function () {
			qodefTextMarquee.init();
		}
	);

	var qodefTextMarquee = {
		init               : function () {
			this.holder = $('.qodef-text-marquee');

			if (this.holder.length) {
				this.holder.each(
					function () {
						qodefTextMarquee.prepareContent($(this));
						qodefTextMarquee.calculateWidthRatio($(this));
					}
				);
			}
		},
		prepareContent     : function ($currentItem) {
			var $contentInnerCopy = $currentItem.find('.qodef--copy');

			// remove holder init class
			$currentItem.removeClass('qodef--init');

			// remove duplicated content
			if ($contentInnerCopy.length) {
				$contentInnerCopy.remove();
			}
		},
		calculateWidthRatio: function ($currentItem) {
			var $content = $currentItem.find('.qodef-m-content'),
				$contentInner = $content.find('.qodef-m-content-inner'),
				multiplyCoef = $contentInner.outerWidth() > 0 ? Math.ceil($content.outerWidth() / $contentInner.outerWidth()) : 1,
				i;

			if ($contentInner.html().length) {
				// duplicate content at least once
				for (i = 0; i < multiplyCoef; i++) {
					qodefTextMarquee.duplicateContent($content, $contentInner);
				}
			}

			// add holder init class
			$currentItem.addClass('qodef--init');
		},
		duplicateContent   : function ($content, $contentInner) {
			$contentInner.clone().appendTo($content).addClass('qodef--copy');
		},
	};

	qodefCore.shortcodes.einar_core_text_marquee.qodefTextMarquee = qodefTextMarquee;

})(jQuery);

(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.einar_core_video_button                    = {};
	qodefCore.shortcodes.einar_core_video_button.qodefMagnificPopup = qodef.qodefMagnificPopup;

})( jQuery );

(function ($) {
    "use strict";

	qodefCore.shortcodes.einar_core_video_holder = {};
	qodefCore.shortcodes.einar_core_video_holder.qodefAppear = qodef.qodefAppear ;

})(jQuery);
(function ( $ ) {
	'use strict';

	$( window ).on(
		'load',
		function () {
			qodefStickySidebar.init();
		}
	);

	var qodefStickySidebar = {
		init: function () {
			var info = $( '.widget_einar_core_sticky_sidebar' );

			if ( info.length && qodefCore.windowWidth > 1024 ) {
				info.wrapper = info.parents( '#qodef-page-sidebar' );
				info.offsetM = info.offset().top - info.wrapper.offset().top;
				info.adj     = 15;

				qodefStickySidebar.callStack( info );

				$( window ).on(
					'resize',
					function () {
						if ( qodefCore.windowWidth > 1024 ) {
							qodefStickySidebar.callStack( info );
						}
					}
				);

				$( window ).on(
					'scroll',
					function () {
						if ( qodefCore.windowWidth > 1024 ) {
							qodefStickySidebar.infoPosition( info );
						}
					}
				);
			}
		},
		calc: function ( info ) {
			var content = $( '.qodef-page-content-section' ),
				headerH = qodefCore.body.hasClass( 'qodef-header-appearance--none' ) ? 0 : parseInt( qodefGlobal.vars.headerHeight, 10 );

			// If posts not found set content to have the same height as the sidebar
			if ( qodefCore.windowWidth > 1024 && content.height() < 100 ) {
				content.css( 'height', info.wrapper.height() - content.height() );
			}

			info.start = content.offset().top;
			info.end   = content.outerHeight();
			info.h     = info.wrapper.height();
			info.w     = info.outerWidth();
			info.left  = info.offset().left;
			info.top   = headerH + qodefGlobal.vars.adminBarHeight - info.offsetM;
			info.data( 'state', 'top' );
		},
		infoPosition: function ( info ) {
			if ( qodefCore.scroll < info.start - info.top && qodefCore.scroll + info.h && info.data( 'state' ) !== 'top' ) {
				gsap.to(
					info.wrapper,
					.1,
					{
						y: 5,
					}
				);
				gsap.to(
					info.wrapper,
					.3,
					{
						y: 0,
						delay: .1,
					}
				);
				info.data( 'state', 'top' );
				info.wrapper.css(
					{
						'position': 'static',
					}
				);
			} else if ( qodefCore.scroll >= info.start - info.top && qodefCore.scroll + info.h + info.adj <= info.start + info.end &&
				info.data( 'state' ) !== 'fixed' ) {
				var c = info.data( 'state' ) === 'top' ? 1 : -1;
				info.data( 'state', 'fixed' );
				info.wrapper.css(
					{
						'position': 'fixed',
						'top': info.top,
						'left': info.left,
						'width': info.w,
					}
				);
				gsap.fromTo(
					info.wrapper,
					.2,
					{
						y: 0
					},
					{
						y: c * 10,
						ease: Power4.easeInOut
					}
				);
				gsap.to(
					info.wrapper,
					.2,
					{
						y: 0,
						delay: .2,
					}
				);
			} else if ( qodefCore.scroll + info.h + info.adj > info.start + info.end && info.data( 'state' ) !== 'bottom' ) {
				info.data( 'state', 'bottom' );
				info.wrapper.css(
					{
						'position': 'absolute',
						'top': info.end - info.h - info.adj,
						'left': 'auto',
						'width': info.w,
					}
				);
				gsap.fromTo(
					info.wrapper,
					.1,
					{
						y: 0
					},
					{
						y: -5,
					}
				);
				gsap.to(
					info.wrapper,
					.3,
					{
						y: 0,
						delay: .1,
					}
				);
			}
		},
		callStack: function ( info ) {
			this.calc( info );
			this.infoPosition( info );
		}
	};

})( jQuery );

(function ( $ ) {
	'use strict';

	var shortcode = 'einar_core_blog_list';

	qodefCore.shortcodes[shortcode] = {};

	if ( typeof qodefCore.listShortcodesScripts === 'object' ) {
		$.each(
			qodefCore.listShortcodesScripts,
			function ( key, value ) {
				qodefCore.shortcodes[shortcode][key] = value;
			}
		);
	}

	qodefCore.shortcodes[shortcode].qodefResizeIframes = qodef.qodefResizeIframes;

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefSimpleTabbedNavMenu.init();
		}
	);

	var qodefSimpleTabbedNavMenu = {

		init: function () {
				var $holder = $( '.qodef-header--simple-tabbed #qodef-page-header' );

			if ( $holder.length ) {
				$holder.each(
					function () {
						qodefSimpleTabbedNavMenu.initItem( $( this ) );
					}
				);
			}
		},

		initItem: function ( $currentHeader ) {
			var $logo 	  	  = $currentHeader.find( '#qodef-page-header-inner .qodef-header-logo-link' );
			var $menuItem 	  = $currentHeader.find( '#qodef-page-header-inner .qodef-header-navigation > ul > li' );
			var $widget   	  = $currentHeader.find( '#qodef-page-header-inner .qodef-widget-holder.qodef--one' );
			var $fsOpener     = $currentHeader.find( 'a.qodef-fullscreen-menu-opener' );
			var headerInnert  = $currentHeader.find( '#qodef-page-header-inner' );
			var $substitution = headerInnert.innerWidth() - headerInnert.width(); // side padding

			if ( $fsOpener.length ) {
				$substitution += $fsOpener.outerWidth();
			}

			if ( $widget.length ) {
				$substitution += $widget.outerWidth();
			}

			var $width = $( window ).width() - $logo.outerWidth() - $substitution;

			$menuItem.css( 'width', 'calc( ' + $width / ( $menuItem.length ) + 'px )' );
		},

	};

})( jQuery );

(function ( $ ) {
	'use strict';

	var fixedHeaderAppearance = {
		showHideHeader: function ( $pageOuter, $header ) {
			if ( qodefCore.windowWidth > 1024 ) {
				if ( qodefCore.scroll <= 0 ) {
					qodefCore.body.removeClass( 'qodef-header--fixed-display' );
					$pageOuter.css( 'padding-top', '0' );
					$header.css( 'margin-top', '0' );
				} else {
					qodefCore.body.addClass( 'qodef-header--fixed-display' );
					$pageOuter.css( 'padding-top', parseInt( qodefGlobal.vars.headerHeight + qodefGlobal.vars.topAreaHeight ) + 'px' );
					$header.css( 'margin-top', parseInt( qodefGlobal.vars.topAreaHeight ) + 'px' );
				}
			}
		},
		init: function () {

			if ( ! qodefCore.body.hasClass( 'qodef-header--vertical' ) ) {
				var $pageOuter = $( '#qodef-page-outer' ),
					$header    = $( '#qodef-page-header' );

				fixedHeaderAppearance.showHideHeader( $pageOuter, $header );

				$( window ).scroll(
					function () {
						fixedHeaderAppearance.showHideHeader( $pageOuter, $header );
					}
				);

				$( window ).resize(
					function () {
						$pageOuter.css( 'padding-top', '0' );
						fixedHeaderAppearance.showHideHeader( $pageOuter, $header );
					}
				);
			}
		}
	};

	qodefCore.fixedHeaderAppearance = fixedHeaderAppearance.init;

})( jQuery );

(function ( $ ) {
	'use strict';

	var stickyHeaderAppearance = {
		header: '',
		docYScroll: 0,
		init: function () {
			var displayAmount = stickyHeaderAppearance.displayAmount();

			// Set variables
			stickyHeaderAppearance.header 	  = $( '.qodef-header-sticky' );
			stickyHeaderAppearance.docYScroll = $( document ).scrollTop();

			// Set sticky visibility
			stickyHeaderAppearance.setVisibility( displayAmount );

			$( window ).scroll(
				function () {
					stickyHeaderAppearance.setVisibility( displayAmount );
				}
			);
		},
		displayAmount: function () {
			if ( qodefGlobal.vars.qodefStickyHeaderScrollAmount !== 0 ) {
				return parseInt( qodefGlobal.vars.qodefStickyHeaderScrollAmount, 10 );
			} else {
				return parseInt( qodefGlobal.vars.headerHeight + qodefGlobal.vars.adminBarHeight, 10 );
			}
		},
		setVisibility: function ( displayAmount ) {
			var isStickyHidden = qodefCore.scroll < displayAmount;

			if ( stickyHeaderAppearance.header.hasClass( 'qodef-appearance--up' ) ) {
				var currentDocYScroll = $( document ).scrollTop();

				isStickyHidden = (currentDocYScroll > stickyHeaderAppearance.docYScroll && currentDocYScroll > displayAmount) || (currentDocYScroll < displayAmount);

				stickyHeaderAppearance.docYScroll = $( document ).scrollTop();
			}

			stickyHeaderAppearance.showHideHeader( isStickyHidden );
		},
		showHideHeader: function ( isStickyHidden ) {
			if ( isStickyHidden ) {
				qodefCore.body.removeClass( 'qodef-header--sticky-display' );
			} else {
				qodefCore.body.addClass( 'qodef-header--sticky-display' );
			}
		},
	};

	qodefCore.stickyHeaderAppearance = stickyHeaderAppearance.init;

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefSideAreaMobileHeader.init();
		}
	);

	var qodefSideAreaMobileHeader = {
		init: function () {
			var $holder = $( '#qodef-side-area-mobile-header' );

			if ( $holder.length && qodefCore.body.hasClass( 'qodef-mobile-header--side-area' ) ) {
				var $navigation = $holder.find( '.qodef-m-navigation' );

				qodefSideAreaMobileHeader.initOpenerTrigger( $holder, $navigation );
				qodefSideAreaMobileHeader.initNavigationClickToggle( $navigation );

				if ( typeof qodefCore.qodefPerfectScrollbar === 'object' ) {
					qodefCore.qodefPerfectScrollbar.init( $holder );
				}
			}
		},
		initOpenerTrigger: function ( $holder, $navigation ) {
			var $openerIcon = $( '.qodef-side-area-mobile-header-opener' ),
				$closeIcon  = $holder.children( '.qodef-m-close' );
			var $sidearea = $( '.qodef-side-area-cover' );

			if ( $openerIcon.length && $navigation.length ) {
				$openerIcon.on(
					'tap click',
					function ( e ) {
						e.stopPropagation();
						e.preventDefault();

						if ( $holder.hasClass( 'qodef--opened' ) ) {
							$holder.removeClass( 'qodef--opened' );
							$sidearea.removeClass( 'qodef--opened' );
						} else {
							$holder.addClass( 'qodef--opened' );
							$sidearea.addClass( 'qodef--opened' );
						}
					}
				);
			}

			$closeIcon.on(
				'tap click',
				function ( e ) {
					e.stopPropagation();
					e.preventDefault();

					if ( $holder.hasClass( 'qodef--opened' ) ) {
						$holder.removeClass( 'qodef--opened' );
						$sidearea.removeClass( 'qodef--opened' );
					}
				}
			);
		},
		initNavigationClickToggle: function ( $navigation ) {
			var $menuItems = $navigation.find( 'ul li.menu-item-has-children' );

			$menuItems.each(
				function () {
					var $thisItem        = $( this ),
						$elementToExpand = $thisItem.find( ' > .qodef-drop-down-second, > ul' ),
						$dropdownOpener  = $thisItem.find( '> .qodef-menu-item-arrow' ),
						slideUpSpeed     = 'fast',
						slideDownSpeed   = 'slow';

					$thisItem.on(
						'click tap',
						function ( e ) {
							e.stopPropagation();

							if ( $elementToExpand.is( ':visible' ) ) {
								$thisItem.removeClass( 'qodef-menu-item--open' );
								$elementToExpand.slideUp( slideUpSpeed );
							} else if ( $dropdownOpener.parent().parent().children().hasClass( 'qodef-menu-item--open' ) && $dropdownOpener.parent().parent().parent().hasClass( 'qodef-vertical-menu' ) ) {
								$thisItem.parent().parent().children().removeClass( 'qodef-menu-item--open' );
								$thisItem.parent().parent().children().find( ' > .qodef-drop-down-second' ).slideUp( slideUpSpeed );

								$thisItem.addClass( 'qodef-menu-item--open' );
								$elementToExpand.slideDown( slideDownSpeed );
							} else {

								if ( ! $thisItem.parents( 'li' ).hasClass( 'qodef-menu-item--open' ) ) {
									$menuItems.removeClass( 'qodef-menu-item--open' );
									$menuItems.find( ' > .qodef-drop-down-second, > ul' ).slideUp( slideUpSpeed );
								}

								if ( $thisItem.parent().parent().children().hasClass( 'qodef-menu-item--open' ) ) {
									$thisItem.parent().parent().children().removeClass( 'qodef-menu-item--open' );
									$thisItem.parent().parent().children().find( ' > .qodef-drop-down-second, > ul' ).slideUp( slideUpSpeed );
								}

								$thisItem.addClass( 'qodef-menu-item--open' );
								$elementToExpand.slideDown( slideDownSpeed );
							}
						}
					);
				}
			);
		},
	};

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefSearchCoversHeader.init();
		}
	);

	var qodefSearchCoversHeader = {
		init: function () {
			var $searchOpener = $( 'a.qodef-search-opener' ),
				$searchForm   = $( '.qodef-search-cover-form' ),
				$searchClose  = $searchForm.find( '.qodef-m-close' );

			if ( $searchOpener.length && $searchForm.length ) {
				$searchOpener.on(
					'click',
					function ( e ) {
						e.preventDefault();
						qodefSearchCoversHeader.openCoversHeader( $searchForm );
					}
				);
				$searchClose.on(
					'click',
					function ( e ) {
						e.preventDefault();
						qodefSearchCoversHeader.closeCoversHeader( $searchForm );
					}
				);
			}
		},
		openCoversHeader: function ( $searchForm ) {
			qodefCore.body.addClass( 'qodef-covers-search--opened qodef-covers-search--fadein' );
			qodefCore.body.removeClass( 'qodef-covers-search--fadeout' );

			setTimeout(
				function () {
					$searchForm.find( '.qodef-m-form-field' ).focus();
				},
				600
			);
		},
		closeCoversHeader: function ( $searchForm ) {
			qodefCore.body.removeClass( 'qodef-covers-search--opened qodef-covers-search--fadein' );
			qodefCore.body.addClass( 'qodef-covers-search--fadeout' );

			setTimeout(
				function () {
					$searchForm.find( '.qodef-m-form-field' ).val( '' );
					$searchForm.find( '.qodef-m-form-field' ).blur();
					qodefCore.body.removeClass( 'qodef-covers-search--fadeout' );
				},
				300
			);
		}
	};

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefSearchFullscreen.init();
		}
	);

	var qodefSearchFullscreen = {
		init: function () {
			var $searchOpener = $( 'a.qodef-search-opener' ),
				$searchHolder = $( '.qodef-fullscreen-search-holder' ),
				$searchClose  = $searchHolder.find( '.qodef-m-close' );

			if ( $searchOpener.length && $searchHolder.length ) {
				$searchOpener.on(
					'click',
					function ( e ) {
						e.preventDefault();
						if ( qodefCore.body.hasClass( 'qodef-fullscreen-search--opened' ) ) {
							qodefSearchFullscreen.closeFullscreen( $searchHolder );
						} else {
							qodefSearchFullscreen.openFullscreen( $searchHolder );
						}
					}
				);
				$searchClose.on(
					'click',
					function ( e ) {
						e.preventDefault();
						qodefSearchFullscreen.closeFullscreen( $searchHolder );
					}
				);

				//Close on escape
				$( document ).keyup(
					function ( e ) {
						if ( e.keyCode === 27 && qodefCore.body.hasClass( 'qodef-fullscreen-search--opened' ) ) { //KeyCode for ESC button is 27
							qodefSearchFullscreen.closeFullscreen( $searchHolder );
						}
					}
				);
			}
		},
		openFullscreen: function ( $searchHolder ) {
			qodefCore.body.removeClass( 'qodef-fullscreen-search--fadeout' );
			qodefCore.body.addClass( 'qodef-fullscreen-search--opened qodef-fullscreen-search--fadein' );

			setTimeout(
				function () {
					$searchHolder.find( '.qodef-m-form-field' ).focus();
				},
				900
			);

			qodefCore.qodefScroll.disable();
		},
		closeFullscreen: function ( $searchHolder ) {
			qodefCore.body.removeClass( 'qodef-fullscreen-search--opened qodef-fullscreen-search--fadein' );
			qodefCore.body.addClass( 'qodef-fullscreen-search--fadeout' );

			setTimeout(
				function () {
					$searchHolder.find( '.qodef-m-form-field' ).val( '' );
					$searchHolder.find( '.qodef-m-form-field' ).blur();
					qodefCore.body.removeClass( 'qodef-fullscreen-search--fadeout' );
				},
				300
			);

			qodefCore.qodefScroll.enable();
		}
	};

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefSearch.init();
		}
	);

	var qodefSearch = {
		init: function () {
			this.search = $( 'a.qodef-search-opener' );

			if ( this.search.length ) {
				this.search.each(
					function () {
						var $thisSearch = $( this );

						qodefSearch.searchHoverColor( $thisSearch );
					}
				);
			}
		},
		searchHoverColor: function ( $searchHolder ) {
			if ( typeof $searchHolder.data( 'hover-color' ) !== 'undefined' ) {
				var hoverColor    = $searchHolder.data( 'hover-color' ),
					originalColor = $searchHolder.css( 'color' );

				$searchHolder.on(
					'mouseenter',
					function () {
						$searchHolder.css( 'color', hoverColor );
					}
				).on(
					'mouseleave',
					function () {
						$searchHolder.css( 'color', originalColor );
					}
				);
			}
		}
	};

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefPredefinedSpinner.init();
		}
	);

	$( window ).on(
		'elementor/frontend/init',
		function () {
			const isEditMode = Boolean( elementorFrontend.isEditMode() );

			if ( isEditMode ) {
				qodefPredefinedSpinner.init( isEditMode );
			}
		}
	);

	const qodefPredefinedSpinner = {
		init( isEditMode ) {
			const $holder = $( '#qodef-page-spinner.qodef-layout--predefined' );

			if ( $holder.length ) {
				if ( isEditMode ) {
				} else {
					qodefPredefinedSpinner.animateSpinner( $holder );
				}
			}
		},
		animateSpinner( $holder ) {
			let tlOutStarted                 = false,
				$numberLabel                 = $holder.find( '.qodef-m-spinner-number' ),
				newPercent                   = 0,
				$progress                    = $holder.find( '.qodef-progress ' ),

				$centredText                 = $holder.find( '.qodef-centred-text' ),
				$chars                       = $centredText.find( '.qode--char-inner' ),
				$charsTopLeft                = $centredText.find( '.qodef-top-left' ),
				$charsTopRight               = $centredText.find( '.qodef-top-right' ),
				$charsBottomLeft             = $centredText.find( '.qodef-bottom-left' ),
				$charsBottomRight            = $centredText.find( '.qodef-bottom-right' ),

				$placeholderTextTop          = $holder.find( '.qodef-m-top' ),
				$placeholderTextBottom       = $holder.find( '.qodef-m-bottom' ),
				$charsTopLeftPlaceholder     = $placeholderTextTop.find( '.qodef-m-left .qodef-m-text' ),
				$charsTopRightPlaceholder    = $placeholderTextTop.find( '.qodef-m-right .qodef-m-text' ),
				$charsBottomLeftPlaceholder  = $placeholderTextBottom.find( '.qodef-m-left .qodef-m-text' ),
				$charsBottomRightPlaceholder = $placeholderTextBottom.find( '.qodef-m-right .qodef-m-text' ),

				$imageTop                    = $holder.find( '.qodef-m-top .qodef-media' ),
				$imageBottom                 = $holder.find( '.qodef-m-bottom .qodef-media' ),

				$imageTopMask                = $holder.find( '.qodef-m-top .qodef-media .qodef-overlay-track-inner' ),
				$imageBottomMask             = $holder.find( '.qodef-m-bottom .qodef-media .qodef-overlay-track-inner' );

			function calcPositionDiff( $element, $placeholderElement ) {
				let elementStyles     = $element[0].getBoundingClientRect(),
					elementX          = Math.floor( elementStyles.left ),
					elementY          = Math.floor( elementStyles.top + qodefCore.scroll ),

					placeholderStyles = $placeholderElement[0].getBoundingClientRect(),
					placeholderX      = Math.floor( placeholderStyles.left ),
					placeholderY      = Math.floor( placeholderStyles.top + qodefCore.scroll );

				let diff = {
					x: elementX - placeholderX,
					y: elementY - placeholderY,
				};

				return diff;
			}

			let topLeftDiff     = calcPositionDiff(
					$charsTopLeft,
					$charsTopLeftPlaceholder
				),
				topRightDiff    = calcPositionDiff(
					$charsTopRight,
					$charsTopRightPlaceholder
				),
				bottomLeftDiff  = calcPositionDiff(
					$charsBottomLeft,
					$charsBottomLeftPlaceholder
				),
				bottomRightDiff = calcPositionDiff(
					$charsBottomRight,
					$charsBottomRightPlaceholder
				);

			let tl = gsap.timeline(
				{
					paused: true,
					onStart: () => {
						$holder.addClass( 'qodef--init' );
					},
				}
			);

			var tlOut = gsap.timeline(
				{
					paused: true,
					onStart: () => {
						$holder.addClass( 'qodef--finished' );
						tlOutStarted = true;

						let appeared = $( '.qodef--appeared' );

						appeared.removeClass( 'qodef--appeared' );

						window.scrollTo(
							0,
							0
						);

						setTimeout(
							() => {
								qodefCore.qodefAppear.init();
							},
							1300
						);
					},
				}
			);


			tl
			.from(
				$chars,
				{
					stagger: .075,
					yPercent: 115,
					duration: 1.5,
					ease: 'power3.inOut'
				},
				'-=.3'
			)
			.addLabel( 'charsYPos' )
			.to(
				[$charsTopLeft, $charsTopRight],
				{
					stagger: .07,
					y: -topLeftDiff.y,
					duration: 1.2,
					ease: 'expo.out'
				},
				'-=.2'
			)
			.to(
				[$charsBottomLeft, $charsBottomRight],
				{
					stagger: .07,
					y: -bottomLeftDiff.y,
					duration: .9,
					ease: 'expo.out'
				},
				'<'
			)
			.to(
				$progress,
				{
					opacity: 1,
					duration: .5,
				},
				'<'
			)
			.to(
				$holder,
				{
					duration: 2.5,
					onStart: function () {
						var numInterval = setInterval(
							function () {
								newPercent > 2 && $numberLabel.text( newPercent );

								if ( newPercent >= 100 ) {
									clearInterval( numInterval );
								}
							},
							120
						);
					},
					onUpdate: function () {
						newPercent = (this.progress() * 100).toFixed();

						return newPercent;
					}
				},
				'<'
			)
			.to(
				$charsTopLeft,
				{
					x: -topLeftDiff.x,
					duration: .9,
					ease: 'power3.out'
				},
				'charsYPos+=.8'
			)
			.to(
				$charsTopRight,
				{
					x: -topRightDiff.x,
					duration: .9,
					ease: 'power3.out'
				},
				'charsYPos+=1'
			)
			.to(
				$charsBottomLeft,
				{
					x: -bottomLeftDiff.x,
					duration: .9,
					ease: 'power3.out'
				},
				'charsYPos+=1'
			)
			.to(
				$charsBottomRight,
				{
					x: -bottomRightDiff.x,
					duration: .9,
					ease: 'power3.out'
				},
				'charsYPos+=1.2'
			)
			.to(
				$imageTopMask,
				{
					yPercent: -116,
					stagger: .13,
					duration: 1.4,
					ease: 'power3.out',
				},
				'charsYPos+=1'
			)
			.to(
				$imageBottomMask,
				{
					yPercent: -116,
					stagger: .13,
					duration: 1.4,
					ease: 'power3.out',
				},
				'charsYPos+=1.2'
			)
			.to(
				$holder,
				{
					duration: .1,
					repeat: -1,
					onRepeat: () => {
						if ( qodefCore.qodefSpinner.windowLoaded && ! tlOutStarted ) {
							tlOut.timeScale(1.5).play();
						}
					},
				},
				'charsYPos+=2'
			);

			tl.timeScale(1.2).play();

			tlOut
			.to(
				$charsTopLeft.find( '.qode--char-inner' ),
				{
					yPercent: '-=110',
					stagger: .1,
					duration: .6,
					ease: 'power3.in'
				},
			)
			.to(
				$charsTopRight.find( '.qode--char-inner' ),
				{
					yPercent: '+=110',
					stagger: .1,
					duration: .6,
					ease: 'power3.in'
				},
				'<.2'
			)
			.to(
				$charsBottomLeft.find( '.qode--char-inner' ),
				{
					yPercent: '+=110',
					stagger: .1,
					duration: .6,
					ease: 'power3.in'
				},
				'<.2'
			)
			.to(
				$charsBottomRight.find( '.qode--char-inner' ),
				{
					yPercent: '+=110',
					stagger: .1,
					duration: .6,
					ease: 'power3.in'
				},
				'<.2'
			)
			.to(
				$imageTopMask,
				{
					yPercent: 0,
					stagger: .13,
					duration: 1,
					ease: 'power3.out',
				},
				'<'
			)
			.to(
				$imageBottomMask,
				{
					yPercent: 0,
					stagger: .13,
					duration: 1,
					ease: 'power3.out',
				},
				'<.2'
			)
			.to(
				$holder,
				{
					'--qodef-clip': '100',
					duration: 1.5,
					ease: 'power3.inOut',
				},
				'.8'
			);
		},
	};

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
		function() {
			qodefProgressBarSpinner.init();
		}
	);

	$( window ).on(
		'load',
		function () {
			qodefProgressBarSpinner.windowLoaded = true;
			qodefProgressBarSpinner.completeAnimation();
		}
	);

	$( window ).on(
		'elementor/frontend/init',
		function () {
			var isEditMode = Boolean( elementorFrontend.isEditMode() );

			if ( isEditMode ) {
				qodefProgressBarSpinner.init( isEditMode );
			}
		}
	);

	var qodefProgressBarSpinner = {
		holder: '',
		windowLoaded: false,
		percentNumber: 0,
		init: function ( isEditMode ) {
			this.holder = $( '#qodef-page-spinner.qodef-layout--progress-bar' );

			if ( this.holder.length ) {
				qodefProgressBarSpinner.animateSpinner( this.holder, isEditMode );
			}
		},
		animateSpinner: function ( $holder, isEditMode ) {
			var $numberHolder = $holder.find( '.qodef-m-spinner-number-label' ),
				$spinnerLine  = $holder.find( '.qodef-m-spinner-line-front' );

			$spinnerLine.animate(
				{ 'width': '100%' },
				10000,
				'linear'
			);

			var numberInterval = setInterval(
				function () {
					qodefProgressBarSpinner.animatePercent( $numberHolder, qodefProgressBarSpinner.percentNumber );

					if ( qodefProgressBarSpinner.windowLoaded ) {
						clearInterval( numberInterval );
					}
				},
				100
			);

			if ( isEditMode ) {
				qodefProgressBarSpinner.fadeOutLoader( $holder );
			}
		},
		completeAnimation: function () {
			var $holder = qodefProgressBarSpinner.holder.length ? qodefProgressBarSpinner.holder : $( '#qodef-page-spinner.qodef-layout--progress-bar' );

			var numberIntervalFastest = setInterval(
				function () {

					if ( qodefProgressBarSpinner.percentNumber >= 100 ) {
						clearInterval( numberIntervalFastest );

						$holder.find( '.qodef-m-spinner-line-front' ).stop().animate(
							{ 'width': '100%' },
							500
						);

						$holder.addClass( 'qodef--finished' );

						setTimeout(
							function () {
								qodefProgressBarSpinner.fadeOutLoader( $holder );
							},
							600
						);
					} else {
						qodefProgressBarSpinner.animatePercent(
							$holder.find( '.qodef-m-spinner-number-label' ),
							qodefProgressBarSpinner.percentNumber
						);
					}
				},
				6
			);
		},
		animatePercent: function ( $numberHolder, percentNumber ) {
			if ( percentNumber < 100 ) {
				percentNumber += 5;
				$numberHolder.text( percentNumber );

				qodefProgressBarSpinner.percentNumber = percentNumber;
			}
		},
		fadeOutLoader: function ( $holder, speed, delay, easing ) {
			speed  = speed ? speed : 600;
			delay  = delay ? delay : 0;
			easing = easing ? easing : 'swing';

			$holder.delay( delay ).fadeOut( speed, easing );

			$( window ).on(
				'bind',
				'pageshow',
				function ( event ) {
					if ( event.originalEvent.persisted ) {
						$holder.fadeOut( speed, easing );
					}
				}
			);
		}
	};

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefTextualSpinner.init();
		}
	);

	$( window ).on(
		'load',
		function () {
			qodefTextualSpinner.windowLoaded = true;
		}
	);

	$( window ).on(
		'elementor/frontend/init',
		function () {
			var isEditMode = Boolean( elementorFrontend.isEditMode() );

			if ( isEditMode ) {
				qodefTextualSpinner.init( isEditMode );
			}
		}
	);

	var qodefTextualSpinner = {
		init ( isEditMode ) {
			var $holder = $( '#qodef-page-spinner.qodef-layout--textual' );

			if ( $holder.length ) {
				if ( isEditMode ) {
					qodefTextualSpinner.fadeOutLoader( $holder );
				} else {
					qodefTextualSpinner.splitText( $holder );
				}
			}
		},
		splitText ( $holder ) {
			var $textHolder = $holder.find( '.qodef-m-text' );

			if ( $textHolder.length ) {
				var text     = $textHolder.text().trim(),
					chars    = text.split( '' ),
					cssClass = '';

				$textHolder.empty();

				chars.forEach(
					( element ) => {
						cssClass = (element === ' ' ? 'qodef-m-empty-char' : ' ');
						$textHolder.append( '<span class="qodef-m-char ' + cssClass + '">' + element + '</span>' );
					}
				);

				setTimeout(
					() => {
						qodefTextualSpinner.animateSpinner( $holder );
					}, 100
				);
			}
		},
		animateSpinner ( $holder ) {
			$holder.addClass( 'qodef--init' );

			function animationLoop ( animationProps ) {
				var $chars      = $holder.find( '.qodef-m-char' ),
					charsLength = $chars.length - 1;

				if ( $chars.length ) {
					$chars.each(
						( index, element ) => {
							var $thisChar = $( element );

							setTimeout(
								() => {
									$thisChar.animate(
									    animationProps.type,
										animationProps.duration,
										animationProps.easing,
										() => {
											if ( index === charsLength ) {
												if ( 1 === animationProps.repeat ) {
													animationLoop(
													    {
                                                            type: { opacity: 0 },
                                                            duration: 1200,
                                                            easing: 'swing',
                                                            delay: 0,
                                                            repeat: 0,
                                                        }
													);
												} else {
													if ( ! qodefTextualSpinner.windowLoaded ) {
														animationLoop(
														    {
                                                                type: { opacity: 1 },
                                                                duration: 1800,
                                                                easing: 'swing',
                                                                delay: 160,
                                                                repeat: 1,
                                                            }
														);
													} else {
														qodefTextualSpinner.fadeOutLoader(
															$holder,
															600,
															0,
															'swing'
														);

														setTimeout(
															() => {
																var $revSlider = $( '.qodef-after-spinner-rev rs-module' );

																if ( $revSlider.length ) {
																	$revSlider.revstart();
																}
															}, 800
														);
													}
												}
											}
										}
									);
								}, index * animationProps.delay
							);
						}
					);
				}
			}

			animationLoop (
			    {
                    type: { opacity: 1 },
                    duration: 1800,
                    easing: 'swing',
                    delay: 160,
                    repeat: 1,
                }
			);
		},
		fadeOutLoader( $holder, speed, delay, easing ) {
			speed  = speed ? speed : 500;
			delay  = delay ? delay : 0;
			easing = easing ? easing : 'swing';

			if ( $holder.length ) {
				$holder.delay( delay ).fadeOut( speed, easing );

				$( window ).on(
					'bind',
					'pageshow',
					function( event ) {

						if ( event.originalEvent.persisted ) {
							$holder.fadeOut( speed, easing );
						}
					}
				);
			}
		}
	};

})( jQuery );

(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.einar_core_instagram_list = {};

	$( document ).ready(
		function () {
			qodefInstagram.init();
		}
	);

	var qodefInstagram = {
		init: function () {
			this.holder = $( '.qodef-instagram-list #sb_instagram' );

			if ( this.holder.length ) {
				this.holder.each(
					function () {

						if ( $( this ).parent().hasClass( 'qodef-instagram-columns' ) ) {
							var $imagesHolder  = $( this ).find( '#sbi_images' ),
								$images        = $imagesHolder.find( '.sbi_item.sbi_type_image, .sbi_item.sbi_type_carousel' ),
								initialPadding = $imagesHolder.css( 'padding' );

							// remove some unnecessary paddings
							$imagesHolder.css('padding', '0');
							$imagesHolder.css('margin', '-' + initialPadding);
							$imagesHolder.css('width', 'calc(100% + ' + ( initialPadding) + ' + ' + ( initialPadding) + ')');

							$images.attr('style', 'padding: ' + initialPadding + '!important');
						} else if ( $( this ).parent().hasClass( 'qodef-instagram-slider' ) ) {
							qodefInstagram.initSlider( $( this ) );
						}
					}
				);
			}
		},
		initSlider: function ( $currentItem, $initAllItems ) {

			var $imagesHolder  = $currentItem.find( '#sbi_images' ),
				$images        = $currentItem.find( '.sbi_item.sbi_type_image' ),
				initialPadding = $imagesHolder.css( 'padding' );

			// remove some unnecessary paddings
			$imagesHolder.css('padding', '0');
			$images.css('padding', '0');

			// items will inherit this margin
			$imagesHolder.attr('style', 'margin-right: ' + (parseInt( initialPadding ) * 2) + 'px !important');

			var sliderOptions = {};

			sliderOptions.spaceBetween      = parseInt( initialPadding ) * 2;
			sliderOptions.customStages      = true;
			sliderOptions.slidesPerView     = $currentItem.data( 'cols' ) !== undefined && $currentItem.data( 'cols' ) !== '' ? $currentItem.data( 'cols' ) : 3;
			sliderOptions.slidesPerView1024 = $currentItem.data( 'cols' ) !== undefined && $currentItem.data( 'cols' ) !== '' ? $currentItem.data( 'cols' ) : 3;
			sliderOptions.slidesPerView680  = $currentItem.data( 'colstablet' ) !== undefined && $currentItem.data( 'colstablet' ) !== '' ? $currentItem.data( 'colstablet' ) : 2;
			sliderOptions.slidesPerView480  = $currentItem.data( 'colsmobile' ) !== undefined && $currentItem.data( 'colsmobile' ) !== '' ? $currentItem.data( 'colsmobile' ) : 1;

			$currentItem.attr( 'data-options', JSON.stringify(sliderOptions) );

			$imagesHolder.addClass( 'swiper-wrapper' );

			if ( $images.length ) {
				$images.each(
					function () {
						$( this ).addClass( 'qodef-e qodef-image-wrapper swiper-slide' );
					}
				);
			}

			if ( typeof qodef.qodefSwiper === 'object' ) {

				if ( false === $initAllItems ) {
					qodef.qodefSwiper.initSlider( $currentItem );
				} else {
					qodef.qodefSwiper.init( $currentItem );
				}
			}
		},
	};

	qodefCore.shortcodes.einar_core_instagram_list.qodefInstagram = qodefInstagram;
	qodefCore.shortcodes.einar_core_instagram_list.qodefSwiper    = qodef.qodefSwiper;

})( jQuery );

(function ( $ ) {
	'use strict';

	/*
	 **	Re-init scripts on gallery loaded
	 */
	$( document ).on(
		'yith_wccl_product_gallery_loaded',
		function () {

			if ( typeof qodefCore.qodefWooMagnificPopup === 'function' ) {
				qodefCore.qodefWooMagnificPopup.init();
			}
		}
	);

})( jQuery );

(function ($) {
	'use strict';

	$(document).on(
		'qv_loader_stop qv_variation_gallery_loaded',
		function () {
			qodefYithSelect2.init();
		}
	);

	var qodefYithSelect2 = {
		init: function (settings) {
			this.holder = [];
			this.holder.push(
				{
					holder: $('#yith-quick-view-modal .variations select'),
					options: {
						minimumResultsForSearch: Infinity
					}
				}
			);

			// Allow overriding the default config
			$.extend(this.holder, settings);

			if (typeof this.holder === 'object') {
				$.each(
					this.holder,
					function (key, value) {
						qodefYithSelect2.createSelect2(value.holder, value.options);
					}
				);
			}
		},
		createSelect2: function ($holder, options) {
			if (typeof $holder.select2 === 'function') {
				$holder.select2(options);
			}
		}
	};

})(jQuery);

(function ( $ ) {
	'use strict';

	var shortcode = 'einar_core_product_list';

	qodefCore.shortcodes[shortcode] = {};

	if ( typeof qodefCore.listShortcodesScripts === 'object' ) {
		$.each(
			qodefCore.listShortcodesScripts,
			function ( key, value ) {
				qodefCore.shortcodes[shortcode][key] = value;
			}
		);
	}

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefDropDownCart.init();
		}
	);

	var qodefDropDownCart = {
		init: function () {
			var $holder = $( '.qodef-widget-dropdown-cart-content' );

			if ( $holder.length ) {
				$holder.off().each(
					function () {
						var $thisHolder = $( this );

						qodefDropDownCart.trigger( $thisHolder );

						qodefCore.body.on(
							'added_to_cart removed_from_cart',
							function () {
								qodefDropDownCart.init();
							}
						);
					}
				);
			}
		},
		trigger: function ( $holder ) {
			var $items = $holder.find( '.qodef-woo-mini-cart' );
			if ( $items.length && typeof qodefCore.qodefPerfectScrollbar === 'object' ) {
				qodefCore.qodefPerfectScrollbar.init( $items );
			}
		},
	};

})( jQuery );

(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.einar_core_clients_list             = {};
	qodefCore.shortcodes.einar_core_clients_list.qodefSwiper = qodef.qodefSwiper;

})( jQuery );

(function ( $ ) {
	'use strict';

	var shortcode = 'einar_core_dual_image_portfolio_slider';

	qodefCore.shortcodes[shortcode] = {};

	if ( typeof qodefCore.listShortcodesScripts === 'object' ) {
		$.each(
			qodefCore.listShortcodesScripts,
			function ( key, value ) {
				qodefCore.shortcodes[shortcode][key] = value;
			}
		);
	}

})( jQuery );

(function ( $ ) {
	'use strict';

	var shortcode = 'einar_core_portfolio_interactive_showcase';

	qodefCore.shortcodes[shortcode] = {};

	if ( typeof qodefCore.listShortcodesScripts === 'object' ) {
		$.each(
			qodefCore.listShortcodesScripts,
			function ( key, value ) {
				qodefCore.shortcodes[shortcode][key] = value;
			}
		);
	}

})( jQuery );

(function ( $ ) {
	'use strict';

	var shortcode = 'einar_core_portfolio_list';

	qodefCore.shortcodes[shortcode] = {};

	if ( typeof qodefCore.listShortcodesScripts === 'object' ) {
		$.each(
			qodefCore.listShortcodesScripts,
			function ( key, value ) {
				qodefCore.shortcodes[shortcode][key] = value;
			}
		);
	}

	qodefCore.shortcodes[shortcode].qodefAppear     = qodefCore.qodefAppear;
	qodefCore.shortcodes[shortcode].qodefGlassHover = qodefCore.qodefGlassHover;

})( jQuery );

(function ( $ ) {
	'use strict';

	var shortcode = 'einar_core_team_list';

	qodefCore.shortcodes[shortcode] = {};

	if ( typeof qodefCore.listShortcodesScripts === 'object' ) {
		$.each(
			qodefCore.listShortcodesScripts,
			function ( key, value ) {
				qodefCore.shortcodes[shortcode][key] = value;
			}
		);
	}

})( jQuery );

(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.einar_core_testimonials_list             = {};
	qodefCore.shortcodes.einar_core_testimonials_list.qodefSwiper = qodef.qodefSwiper;

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefInteractiveLinkShowcaseInteractiveList.init();
		}
	);

	var qodefInteractiveLinkShowcaseInteractiveList = {
		init: function () {
			this.holder = $( '.qodef-interactive-link-showcase.qodef-layout--interactive-list' );

			if ( this.holder.length ) {
				this.holder.each(
					function () {
						qodefInteractiveLinkShowcaseInteractiveList.initItem( $( this ) );
					}
				);
			}
		},
		initItem: function ( $currentItem ) {
			var $links            = $currentItem.find( '.qodef-m-item' ),
				x                 = 0,
				y                 = 0,
				currentXCPosition = 0,
				currentYCPosition = 0;

			if ( $links.length ) {
				$links.on(
					'mouseenter',
					function () {
						$links.removeClass( 'qodef--active' );
						$( this ).addClass( 'qodef--active' );
					}
				).on(
					'mousemove',
					function ( event ) {
						var $thisLink         = $( this ),
							$followInfoHolder = $thisLink.find( '.qodef-e-follow-content' ),
							$followImage      = $followInfoHolder.find( '.qodef-e-follow-image' ),
							$followImageItem  = $followImage.find( 'img' ),
							followImageWidth  = $followImageItem.width(),
							followImagesCount = parseInt( $followImage.data( 'images-count' ), 10 ),
							followImagesSrc   = $followImage.data( 'images' ),
							$followTitle      = $followInfoHolder.find( '.qodef-e-follow-title' ),
							itemWidth         = $thisLink.outerWidth(),
							itemHeight        = $thisLink.outerHeight(),
							itemOffsetTop     = $thisLink.offset().top - qodefCore.scroll,
							itemOffsetLeft    = $thisLink.offset().left;

						x = (event.clientX - itemOffsetLeft) >> 0;
						y = (event.clientY - itemOffsetTop) >> 0;

						if ( x > itemWidth ) {
							currentXCPosition = itemWidth;
						} else if ( x < 0 ) {
							currentXCPosition = 0;
						} else {
							currentXCPosition = x;
						}

						if ( y > itemHeight ) {
							currentYCPosition = itemHeight;
						} else if ( y < 0 ) {
							currentYCPosition = 0;
						} else {
							currentYCPosition = y;
						}

						if ( followImagesCount > 1 ) {
							var imagesUrl    = followImagesSrc.split( '|' ),
								itemPartSize = itemWidth / followImagesCount;

							$followImageItem.removeAttr( 'srcset' );

							if ( currentXCPosition < itemPartSize ) {
								$followImageItem.attr( 'src', imagesUrl[0] );
							}

							// -2 is constant - to remove first and last item from the loop
							for ( var index = 1; index <= (followImagesCount - 2); index++ ) {
								if ( currentXCPosition >= itemPartSize * index && currentXCPosition < itemPartSize * (index + 1) ) {
									$followImageItem.attr( 'src', imagesUrl[index] );
								}
							}

							if ( currentXCPosition >= itemWidth - itemPartSize ) {
								$followImageItem.attr( 'src', imagesUrl[followImagesCount - 1] );
							}
						}

						$followImage.css(
							{
								'top': itemHeight / 2,
							}
						);
						$followTitle.css(
							{
								'transform': 'translateY(' + -(parseInt( itemHeight, 10 ) / 2 + currentYCPosition) + 'px)',
								'left': -(currentXCPosition - followImageWidth / 2),
							}
						);
						$followInfoHolder.css( { 'top': currentYCPosition, 'left': currentXCPosition } );
					}
				).on(
					'mouseleave',
					function () {
						$links.removeClass( 'qodef--active' );
					}
				);
			}

			$currentItem.addClass( 'qodef--init' );
		},
	};

	qodefCore.shortcodes.einar_core_interactive_link_showcase.qodefInteractiveLinkShowcaseInteractiveList = qodefInteractiveLinkShowcaseInteractiveList;

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefInteractiveLinkShowcaseList.init();
		}
	);

	var qodefInteractiveLinkShowcaseList = {
		init: function () {
			this.holder = $( '.qodef-interactive-link-showcase.qodef-layout--list' );

			if ( this.holder.length ) {
				this.holder.each(
					function () {
						qodefInteractiveLinkShowcaseList.initItem( $( this ) );
					}
				);
			}
		},
		initItem: function ( $currentItem ) {
			var $images = $currentItem.find( '.qodef-m-image' ),
				$links  = $currentItem.find( '.qodef-m-item' );

			$images.eq( 0 ).addClass( 'qodef--active' );
			$links.eq( 0 ).addClass( 'qodef--active' );

			$links.on(
				'touchstart mouseenter',
				function ( e ) {
					var $thisLink = $( this );

					if ( ! qodefCore.html.hasClass( 'touchevents' ) || ( ! $thisLink.hasClass( 'qodef--active' ) && qodefCore.windowWidth > 680) ) {
						e.preventDefault();
						$images.removeClass( 'qodef--active' ).eq( $thisLink.index() ).addClass( 'qodef--active' );
						$links.removeClass( 'qodef--active' ).eq( $thisLink.index() ).addClass( 'qodef--active' );
					}
				}
			).on(
				'touchend mouseleave',
				function () {
					var $thisLink = $( this );

					if ( ! qodefCore.html.hasClass( 'touchevents' ) || ( ! $thisLink.hasClass( 'qodef--active' ) && qodefCore.windowWidth > 680) ) {
						$links.removeClass( 'qodef--active' ).eq( $thisLink.index() ).addClass( 'qodef--active' );
						$images.removeClass( 'qodef--active' ).eq( $thisLink.index() ).addClass( 'qodef--active' );
					}
				}
			);

			$currentItem.addClass( 'qodef--init' );
		},
	};

	qodefCore.shortcodes.einar_core_interactive_link_showcase.qodefInteractiveLinkShowcaseList = qodefInteractiveLinkShowcaseList;

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefInteractiveLinkShowcaseSlider.init();
		}
	);

	var qodefInteractiveLinkShowcaseSlider = {
		init: function () {
			this.holder = $( '.qodef-interactive-link-showcase.qodef-layout--slider' );

			if ( this.holder.length ) {
				this.holder.each(
					function () {
						qodefInteractiveLinkShowcaseSlider.initItem( $( this ) );
					}
				);
			}
		},
		initItem: function ( $currentItem ) {
			var $images = $currentItem.find( '.qodef-m-image' );

			var $swiperSlider = new Swiper(
				$currentItem.find( '.swiper-container' )[0],
				{
					loop: true,
					slidesPerView: 'auto',
					centeredSlides: true,
					speed: 1400,
					mousewheel: true,
					init: false
				}
			);

			$swiperSlider.on(
				'init',
				function () {
					$images.eq( 0 ).addClass( 'qodef--active' );
					$currentItem.find( '.swiper-slide-active' ).addClass( 'qodef--active' );

					$swiperSlider.on(
						'slideChangeTransitionStart',
						function () {
							var $swiperSlides    = $currentItem.find( '.swiper-slide' ),
								$activeSlideItem = $currentItem.find( '.swiper-slide-active' );

							$images.removeClass( 'qodef--active' ).eq( $activeSlideItem.data( 'swiper-slide-index' ) ).addClass( 'qodef--active' );
							$swiperSlides.removeClass( 'qodef--active' );

							$activeSlideItem.addClass( 'qodef--active' );
						}
					);

					$currentItem.find( '.swiper-slide' ).on(
						'click',
						function ( e ) {
							var $thisSwiperLink  = $( this ),
								$activeSlideItem = $currentItem.find( '.swiper-slide-active' );

							if ( ! $thisSwiperLink.hasClass( 'swiper-slide-active' ) ) {
								e.preventDefault();
								e.stopImmediatePropagation();

								if ( e.pageX < $activeSlideItem.offset().left ) {
									$swiperSlider.slidePrev();
									return false;
								}

								if ( e.pageX > $activeSlideItem.offset().left + $activeSlideItem.outerWidth() ) {
									$swiperSlider.slideNext();
									return false;
								}
							}
						}
					);

					$currentItem.addClass( 'qodef--init' );
				}
			);

			qodef.qodefWaitForImages.check(
				$currentItem,
				function () {
					$swiperSlider.init();
				}
			);
		},
	};

	qodefCore.shortcodes.einar_core_interactive_link_showcase.qodefInteractiveLinkShowcaseSlider = qodefInteractiveLinkShowcaseSlider;

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefDualImagePortfolioSlider.init();
		}
	);

	var qodefDualImagePortfolioSlider = {
		init: function () {
			this.holder = $( '.qodef-dual-image-portfolio-slider' );

			if ( this.holder.length ) {
				this.holder.each(
					function () {
						var $holder = $( this );

						qodefDualImagePortfolioSlider.animateFloat( $holder );
					}
				);
			}
		},
		animateFloat: function ( $holder ) {
			let $imageItems = $holder.find( '.qodef-slider-image .qodef-e' ),
				$titles     = $holder.find( '.qodef-slider-top .qodef-e' ),
				itemsLength = $imageItems.length;

			let $images = $holder.find( '.qodef-slider-image .qodef-e img' );

			let bgColor2 = $holder.css('--qode-bg-color-2');

			$( $titles[0] ).addClass( 'qodef--active' );
			$holder.addClass( 'qodef--init' );

			let skew = {
				current: 0,
				target: 0,
			};

			let skewSetter = gsap.quickSetter(
					$images,
					'skewY',
					'deg'
				),
				clamp      = gsap.utils.clamp(
					-20,
					20
				); // don't let the skew go beyond 20 degrees.

			gsap.set(
				$images,
				{ transformOrigin: 'center top', force3D: true }
			);

			qodefDualImagePortfolioSlider.tl = gsap.timeline( {
				scrollTrigger: {
					trigger: $holder,
					scrub: 2.8,
					start: () => {
						return 'top top';
					},
					end: () => {
						return `+=${(itemsLength - 2) * qodefCore.windowHeight}`;
					},
					onUpdate: ( self ) => {
						skew.target = clamp( self.getVelocity() / -300 );

						if ( Math.abs( skew.target ) > Math.abs( skew.current ) ) {
							skew.current = skew.target;
							gsap.to(
								skew,
								{
									current: 0,
									duration: 0.8,
									ease: 'power3',
									overwrite: true,
								}
							);
						}
					},
					// snap:`${1/(itemsLength - 1)}`,
					pin: true,
					// markers: true,//debugging
					ease: 'none'
				}
			} );

			! qodefCore.html.hasClass( 'touchevents' ) && qodef.windowWidth > 1024 && qodefDualImagePortfolioSlider.tl.eventCallback('onUpdate', ()=>{
				skewSetter( skew.current )
				// gsap.set( $holder,{
				// 	'--d': Math.abs(skew.current),
				// } )
			})


			$imageItems.each( function ( i ) {
				let $imageItem  = $( this ),
					$leftImage  = $imageItem.find( 'img' )[0],
					$rightImage = $imageItem.find( 'img' )[1];

				if ( i !== 0 ) {
					let childTl = gsap.timeline( {} );

					childTl
					.to(
						$imageItems[i - 1],
						{
							yPercent: '-=80',
							'--qodef-clip-bottom': 20,
							duration: .5,
							ease: 'none'
						},
					)
					.to(
						$leftImage,
						{
							y: `-=${qodefCore.windowHeight}`,
							duration: .5,
							ease: 'none'
						},
						'<'
					)
					.to(
						$rightImage,
						{
							y: `-=${qodefCore.windowHeight * 1.2}`,
							duration: .5,
							ease: 'none'
						},
						'<'
					)
					.to(
						$titles,
						{
							autoAlpha: ( index ) => i === index ? 1 : 0,
							duration: .05,
						},
						'0.15'
					);

					qodefDualImagePortfolioSlider.tl.add(
						childTl,
						`${-.5 + i * .5}`
					);
				}
			} );

			let tlDuration = qodefDualImagePortfolioSlider.tl.totalDuration();

			qodefDualImagePortfolioSlider.tl
			.to(
				'.qodef-slider-image',
				{
					backgroundColor: bgColor2,
					duration: tlDuration/3 * 2,
				},
				`${tlDuration/3}`
			)
		},
	};

	qodefCore.shortcodes.einar_core_dual_image_portfolio_slider.qodefDualImagePortfolioSlider = qodefDualImagePortfolioSlider;

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefPortfolioInteractiveShowcaseInteractiveList.init();
		}
	);
	
	var qodefPortfolioInteractiveShowcaseInteractiveList = {
		init: function () {
			this.holder = $( '.qodef-portfolio-interactive-showcase.qodef-item-layout--interactive-list' );

			if ( this.holder.length ) {
				this.holder.each(
					function () {
						qodefPortfolioInteractiveShowcaseInteractiveList.initItem( $( this ) );
					}
				);
			}
		},
		initItem: function ( $currentItem ) {
			var $links            = $currentItem.find( '.qodef-e' ),
				x                 = 0,
				y                 = 0,
				currentXCPosition = 0,
				currentYCPosition = 0;

			if ( $links.length ) {
				$links.on(
					'mousemove',
					function ( event ) {
						var $thisLink         = $( this ),
							$itemTitle        = $thisLink.find( '.qodef-e-title'),
							itemTitleWidth    = $itemTitle.width(),
							$followInfoHolder = $thisLink.find( '.qodef-e-follow-content' ),
							$followImage      = $followInfoHolder.find( '.qodef-e-follow-image' ),
							$followImageItem  = $followImage.find( 'img' ),
							followImageWidth  = $followImageItem.width(),
							followImagesCount = parseInt( $followImage.data( 'images-count' ), 10 ),
							followImagesSrc   = $followImage.data( 'images' ),
							$followTitle      = $followInfoHolder.find( '.qodef-e-follow-title' ),
							itemWidth         = $thisLink.outerWidth(),
							itemHeight        = $thisLink.outerHeight(),
							itemOffsetTop     = $thisLink.offset().top - qodefCore.scroll,
							itemOffsetLeft    = $thisLink.offset().left;

						$links.removeClass( 'qodef--active' );
						$thisLink.addClass( 'qodef--active' );

						x = (event.clientX - itemOffsetLeft) >> 0;
						y = (event.clientY - itemOffsetTop) >> 0;

						if ( x > qodef.windowWidth - followImageWidth * 2 ) {
							currentXCPosition = qodef.windowWidth - followImageWidth * 2;
						} else if ( x < itemTitleWidth + followImageWidth ) {
							currentXCPosition = itemTitleWidth + followImageWidth;
						} else {
							currentXCPosition = x;
						}

						if ( y > itemHeight ) {
							currentYCPosition = itemHeight;
						} else if ( y < 0 ) {
							currentYCPosition = 0;
						} else {
							currentYCPosition = y;
						}

						if ( followImagesCount > 1 ) {
							var imagesUrl    = followImagesSrc.split( '|' ),
								itemPartSize = itemWidth / followImagesCount;

							$followImageItem.removeAttr( 'srcset' );

							if ( currentXCPosition < itemPartSize ) {
								$followImageItem.attr( 'src', imagesUrl[0] );
							}

							// -2 is constant - to remove first and last item from the loop
							for ( var index = 1; index <= (followImagesCount - 2); index++ ) {
								if ( currentXCPosition >= itemPartSize * index && currentXCPosition < itemPartSize * (index + 1) ) {
									$followImageItem.attr( 'src', imagesUrl[index] );
								}
							}

							if ( currentXCPosition >= itemWidth - itemPartSize ) {
								$followImageItem.attr( 'src', imagesUrl[followImagesCount - 1] );
							}
						}
						/*$followTitle.css(
							{
								'transform': 'translateY(' + -(parseInt( itemHeight, 10 ) / 2 + currentYCPosition) + 'px)',
								'left': -(currentXCPosition - followImageWidth / 2),
							}
						);*/
					}
				).on(
					'mouseleave',
					function () {
						$links.removeClass( 'qodef--active' );
					}
				);
			}

			$currentItem.addClass( 'qodef--init' );
		},
	};

	qodefCore.shortcodes.einar_core_portfolio_interactive_showcase.qodefPortfolioInteractiveShowcaseInteractiveList = qodefPortfolioInteractiveShowcaseInteractiveList;

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefPortfolioInteractiveShowcaseSlider.init();
		}
	);

	var qodefPortfolioInteractiveShowcaseSlider = {
		init: function () {
			this.holder = $( '.qodef-portfolio-interactive-showcase.qodef-item-layout--slider' );

			if ( this.holder.length ) {
				this.holder.each(
					function () {
						qodefPortfolioInteractiveShowcaseSlider.initItem( $( this ) );
					}
				);
			}
		},
		initItem: function ( $currentItem ) {

			var $swiperSliderTop = new Swiper(
				$currentItem.find( '.qodef-slider-top .swiper-container' )[0],
				{
					init: false,
					direction: 'vertical',
					runCallbacksOnInit: true,
					speed: 600,
					slidesPerView: 7,
					centeredSlides: true,
					spaceBetween: 0,
					mousewheel: true,
					touchRatio: 0.2,
					slideToClickedSlide: true,
					autoplay: false,
					loop: true,
					loopedSlides: 7,
					breakpoints: {
						// when window width is < 481px
						0: {
							slidesPerView: 5
						},
						// when window width is >= 481px
						481: {
							slidesPerView: 5
						},
						// when window width is >= 681px
						681: {
							slidesPerView: 7
						},
						// when window width is >= 769px
						769: {
							slidesPerView: 7
						},
						// when window width is >= 1025px
						1025: {
							slidesPerView: 7,
						},
						// when window width is >= 1281px
						1281: {
							slidesPerView: 7
						},
						// when window width is >= 1367px
						1367: {
							slidesPerView: 7
						},
						// when window width is >= 1369px
						1369: {
							slidesPerView: 7
						},
						// when window width is >= 1441px
						1441: {
							slidesPerView: 7
						}
					},
				}
			);

			var $swiperSliderImage = new Swiper(
				$currentItem.find( '.qodef-slider-image .swiper-container' )[0],
				{
					effect: 'fade',
					fadeEffect: {
						crossFade: true
					},
					runCallbacksOnInit: true,
					slidesPerView: 1,
					centeredSlides: true,
					spaceBetween: 0,
					autoplay: false,
					loop: true,
					loopedSlides: 7,
				}
			);

			$swiperSliderImage.controller.control = $swiperSliderTop;
			$swiperSliderTop.controller.control   = $swiperSliderImage;

			$swiperSliderTop.on(
				'init',
				function () {
					$currentItem.addClass( 'qodef--init' );

					var $itemActive = $currentItem.find('.qodef-slider-top .swiper-container .swiper-slide.swiper-slide-active');
					var swiper = this;
					var activeIndex = swiper.activeIndex;

					var realIndex = this.slides.eq(activeIndex).attr('data-swiper-slide-index');
					$('.swiper-slide[data-swiper-slide-index="'+realIndex+'"]').prev().addClass('swiper-slide-nth-prev-1');
					$('.swiper-slide[data-swiper-slide-index="'+realIndex+'"]').next().addClass('swiper-slide-nth-next-1');
					$('.swiper-slide[data-swiper-slide-index="'+realIndex+'"]').prev().prev().addClass('swiper-slide-nth-prev-2');
					$('.swiper-slide[data-swiper-slide-index="'+realIndex+'"]').next().next().addClass('swiper-slide-nth-next-2');
					$('.swiper-slide[data-swiper-slide-index="'+realIndex+'"]').prev().prev().prev().addClass('swiper-slide-nth-prev-3');
					$('.swiper-slide[data-swiper-slide-index="'+realIndex+'"]').next().next().next().addClass('swiper-slide-nth-next-3');
					$('.swiper-slide[data-swiper-slide-index="'+realIndex+'"]').prev().prev().prev().prev().addClass('swiper-slide-nth-prev-4');
					$('.swiper-slide[data-swiper-slide-index="'+realIndex+'"]').next().next().next().next().addClass('swiper-slide-nth-next-4');

					if ( true ) {
						var scrollStart = false;

						$currentItem.on(
							'mousewheel',
							function ( e ) {
								e.preventDefault();

								if ( ! scrollStart ) {
									scrollStart = true;

									if ( e.deltaY < 0 ) {
										swiper.slideNext();
									} else {
										swiper.slidePrev();
									}

									setTimeout(
										function () {
											scrollStart = false;
										},
										1000
									);
								}
							}
						);
					}
				}
			);

			$swiperSliderTop.on(
				'slideChange',
				function () {
					var swiper = this;
					var activeIndex = swiper.activeIndex;

					var realIndex = this.slides.eq(activeIndex).attr('data-swiper-slide-index');
					$('.swiper-slide').removeClass('swiper-slide-nth-prev-2 swiper-slide-nth-next-2 swiper-slide-nth-prev-3 swiper-slide-nth-next-3 swiper-slide-nth-prev-4 swiper-slide-nth-next-4 swiper-slide-nth-prev-1 swiper-slide-nth-next-1');
					$('.swiper-slide[data-swiper-slide-index="'+realIndex+'"]').prev().addClass('swiper-slide-nth-prev-1');
					$('.swiper-slide[data-swiper-slide-index="'+realIndex+'"]').next().addClass('swiper-slide-nth-next-1');
					$('.swiper-slide[data-swiper-slide-index="'+realIndex+'"]').prev().prev().addClass('swiper-slide-nth-prev-2');
					$('.swiper-slide[data-swiper-slide-index="'+realIndex+'"]').next().next().addClass('swiper-slide-nth-next-2');
					$('.swiper-slide[data-swiper-slide-index="'+realIndex+'"]').prev().prev().prev().addClass('swiper-slide-nth-prev-3');
					$('.swiper-slide[data-swiper-slide-index="'+realIndex+'"]').next().next().next().addClass('swiper-slide-nth-next-3');
					$('.swiper-slide[data-swiper-slide-index="'+realIndex+'"]').prev().prev().prev().prev().addClass('swiper-slide-nth-prev-4');
					$('.swiper-slide[data-swiper-slide-index="'+realIndex+'"]').next().next().next().next().addClass('swiper-slide-nth-next-4');
				}
			);

			$swiperSliderImage.on(
				'beforeSlideChangeStart',
				function () {
					console.log('beforeSlideChangeStart')
				}
			);
			$swiperSliderImage.on(
				'slideChangeTransitionStart',
				function () {
					let i = this.activeIndex;

					$(this.slides).removeClass('qodef--prev-active');
					$(this.slides[i]).addClass('qodef--prev-active');
				}
			);



			$swiperSliderTop.on(
				'slidePrevTransitionStart',
				function () {
					$currentItem.addClass( 'qodef--backwards' );
				}
			);

			$swiperSliderTop.on(
				'slideNextTransitionStart',
				function () {
					$currentItem.removeClass( 'qodef--backwards' );
				}
			);

			$currentItem && qodef.qodefWaitForImages.check(
				$currentItem,
				function () {
					$swiperSliderTop.init();
					$swiperSliderImage.init();
				}
			);
		},
	};

	qodefCore.shortcodes.einar_core_portfolio_interactive_showcase.qodefPortfolioInteractiveShowcaseSlider = qodefPortfolioInteractiveShowcaseSlider;

})( jQuery );

(function ( $ ) {
	'use strict';

	$( window ).on(
		'load',
		function () {
			qodefPortfolioAppear.init();
		}
	);

	var qodefPortfolioAppear = {
		init: function ( ) {
			this.$sections = $( '.qodef-portfolio-list.qodef-item-layout--info-on-image:not(.qodef-layout--slider) .qodef-e.qodef--has-appear' );


			if ( this.$sections.length) {
				this.$sections.each(
					function () {
						if (! qodefCore.html.hasClass( 'touchevents')){
							qodefPortfolioAppear.animateScale($( this ));
						}
					}
				);
			}
		},
		animateScale: function ( $holder ) {

			var $effectHolder = $holder.find('.qodef-e-media');

			const tl = gsap.timeline({
				scrollTrigger: {
					trigger: $holder,
					scrub: 1.4,//change between 1 and 2 to get more or less smooth effect
					start: () => {
						return "top bottom"
					},
					end: () => {
						return "bottom top";
					},
					// markers: true,//debugging
				}
			});

			tl
			.from(
				$effectHolder,
				{
					scaleX: .88,
					duration: .6,
				}
			)
			.to(
				$effectHolder,
				{
					scaleX: 1,
					duration: .4,
				}
			)
		},
	};

	qodefCore.qodefPortfolioAppear = qodefPortfolioAppear;

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefInfoFollow.init();
		}
	);

	$( document ).on(
		'einar_trigger_get_new_posts',
		function () {
			qodefInfoFollow.init();
		}
	);

	var qodefInfoFollow = {
		init: function () {
			var $gallery = $( '.qodef-hover-animation--follow' );

			if ( $gallery.length ) {
				qodefCore.body.append( '<div class="qodef-e-content-follow"><div class="qodef-e-top-holder"></div><div class="qodef-e-text"></div></div>' );

				var $contentFollow = $( '.qodef-e-content-follow' ),
					$topHolder     = $contentFollow.find( '.qodef-e-top-holder' ),
					$textHolder    = $contentFollow.find( '.qodef-e-text' );

				$gallery.each(
					function () {
						$gallery.find( '.qodef-e-inner' ).each(
							function () {
								var $thisItem = $( this );

								//info element position
								$thisItem.on(
									'mousemove',
									function ( e ) {
										if ( e.clientX + 20 + $contentFollow.width() > qodefCore.windowWidth ) {
											$contentFollow.addClass( 'qodef-right' );
										} else {
											$contentFollow.removeClass( 'qodef-right' );
										}

										$contentFollow.css(
											{
												top: e.clientY + 6,
												left: e.clientX + 6,
											}
										);
									}
								);

								//show/hide info element
								$thisItem.on(
									'mouseenter',
									function () {
										var $thisItemTopHolder  = $( this ).find( '.qodef-e-top-holder' ),
											$thisItemTextHolder = $( this ).find( '.qodef-e-text' );

										if ( $thisItemTopHolder.length ) {
											$topHolder.html( $thisItemTopHolder.html() );
										}

										if ( $thisItemTextHolder.length ) {
											$textHolder.html( $thisItemTextHolder.html() );
										}

										if ( ! $contentFollow.hasClass( 'qodef-is-active' ) ) {
											$contentFollow.addClass( 'qodef-is-active' );
										}
									}
								).on(
									'mouseleave',
									function () {
										if ( $contentFollow.hasClass( 'qodef-is-active' ) ) {
											$contentFollow.removeClass( 'qodef-is-active' );
										}
									}
								);
							}
						);
					}
				);
			}
		},
	};

	qodefCore.shortcodes.einar_core_portfolio_list.qodefInfoFollow = qodefInfoFollow;

})( jQuery );
