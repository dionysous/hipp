document.addEventListener( 'DOMContentLoaded', function() {
	var menu = document.getElementById( 'primary-menu' );
	var menu_icon = document.getElementById( 'menu-icon' );
	var menu_links = document.querySelectorAll( '#primary-menu .onepager a' );
	var topbar = document.getElementById( 'masthead' );
	var logobox = document.getElementById( 'title-wrap' );
	var elementHeight = 0;
	var elementNewHeight = 0;
	var elementLeft = 0;
	var elementNewLeft = 0;
	var scrollLimit = 0;
	
	menu_magic();
	on_scroll();
	
	function menu_magic() {
		if ( window.matchMedia( '(min-width: 400px)' ).matches ) {
			elementHeight = 150;
			elementLeft = 115;
			scrollLimit = 75;
		}
		else {
			elementHeight = 100;
			elementLeft = 80;
			scrollLimit = 9;
		}
		
		if ( window.pageYOffset <= 0 ) {
			topbar.style.height = elementHeight + 'px';
			logobox.style.left = elementLeft + 'px';
		}
		else if ( window.pageYOffset <= elementHeight - 50 ) {
			elementNewHeight = elementHeight - window.pageYOffset;
			elementNewLeft = elementLeft - ( window.pageYOffset * .7 );
			
			topbar.style.height = elementNewHeight + 'px';
			logobox.style.left = elementNewLeft + 'px';
		}
		else {
			topbar.style.height = 50 + 'px';
			logobox.style.left = 45 + 'px';
		}
		
		if ( window.pageYOffset <= scrollLimit ) {
			topbar.classList.remove( 'smaller' );
		}
		else {
			topbar.classList.add( 'smaller' );
		}
	}
	
	function class_check() {
		if ( window.matchMedia( '(min-width: 920px)' ).matches ) {
			menu.classList.remove( 'block' );
			menu.classList.remove( 'open' );
			menu_icon.classList.remove( 'is-active' );
			document.body.classList.remove( 'no-scroll' );
		}
	}
	
	function on_scroll( event ) {
		var scrollPos = window.pageYOffset;
		
		for ( var i = 0; i < menu_links.length; i++ ) {
			var currLink = menu_links[ i ];
			var refElement = document.getElementById( currLink.href );
			
			if ( refElement ) {
				var element_pos = refElement.getBoundingClientRect();
				
				if ( element_pos.top <= scrollPos + 5 && element_pos.top + refElement.offsetHeight > scrollPos ) {
					for ( var n = 0; n < menu_links.length; n++ ) {
						menu_links[ n ].classList.remove( 'active' );
					}
					
					currLink.classList.add( 'active' );
				}
			}
			else {
				currLink.classList.remove( 'active' );
			}
		}
	}
	
	window.onscroll = function() {
		on_scroll();
		menu_magic();
	};
	
	window.onresize = function() {
		menu_magic();
		class_check();
	};
	
	menu_icon.addEventListener( 'click', function( event ) {
		menu_icon.classList.toggle( 'is-active' );
		menu.classList.toggle( 'block' );
		document.body.classList.toggle( 'no_scroll' );
		
		setTimeout( function() {
			menu.classList.toggle( 'open' );
			document.querySelector( '.menu li:first-child a' ).focus();
		}, 50 );
	} );
	
	topbar.classList.add( 'loaded' );
} );