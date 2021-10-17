var nutmeg = nutmeg || {},
    $ = jQuery;

/** Global Variables */

var $nutmegDocument = $( document );

/** Activate primary menu toggles */

nutmeg.headerMenuToggles = {

	init: function() {

		$(".site-toggle-anchor").click(function(){
			$("#site-mobile-menu").toggleClass("is-visible");
			$(".site-toggle-anchor").toggleClass("is-visible");
			$(".site-toggle-label").toggleClass("is-visible");
			$(".site-toggle-icon").toggleClass("is-visible");
		});

		$(".sub-menu-toggle").click(function(){
			$(this).next().toggleClass("is-visible");
			$(this).toggleClass("is-visible");
		});

	},

} // nutmeg.headerMenuToggles

/** Activate header search form toggle */

nutmeg.headerSearchformToggle = {

	init: function() {

		$(".site-toggle-searchform").click(function(){
			$("#site-header-searchform").slideToggle(75, function() {
				$("#site-header-searchform").toggleClass('is-visible');
			});
		});

	},

} // nutmeg.headerSearchformToggle

/** Activate superfish menu */

nutmeg.menuSuperfish = {

	init: function() {

		$('.sf-menu').superfish({
			'speed': 'fast',
			'delay' : 0,
			'animation': {
				'height': 'show'
			}
		});

	},

} // menuSuperfish

/** Activate fitVids */

nutmeg.fitVids = {

	init: function() {

		$(".entry-content").fitVids();

	},

} // fitVids

/** Scroll Animations */

nutmeg.scrollAnimations = {

	init: function() {

		const scrollElements = document.querySelectorAll(".js-scroll");
		const mediaQuery = window.matchMedia("(prefers-reduced-motion: reduce)");

		var throttleTimer;

		const throttle = (callback, time) => {
			if (throttleTimer) return;

			throttleTimer = true;
			setTimeout(() => {
				callback();
				throttleTimer = false;
			}, time);
		}

		const elementInView = (el, dividend = 1) => {
			const elementTop = el.getBoundingClientRect().top;

			return (
				elementTop <=
				(window.innerHeight || document.documentElement.clientHeight) / dividend
				);
		};

		const elementOutofView = (el) => {
			const elementTop = el.getBoundingClientRect().top;

			return (
				elementTop > (window.innerHeight || document.documentElement.clientHeight)
				);
		};

		const displayScrollElement = (element) => {
			element.classList.add("scrolled");
		};

		const hideScrollElement = (element) => {
			element.classList.remove("scrolled");
		};

		const handleScrollAnimation = () => {
			scrollElements.forEach((el) => {
				if (elementInView(el, 1)) {
					displayScrollElement(el);
				} 
				/*
				else if (elementOutofView(el)) {
					hideScrollElement(el)
				}
				*/
			})
		}

		handleScrollAnimation();

		var scroll = 0;

		window.addEventListener("scroll", () => { 
			if (mediaQuery && !mediaQuery.matches) {
			throttle(() => {
				handleScrollAnimation();
			}, 100);
			}
		});

	},

} // scrollAnimations

$nutmegDocument.ready( function() {

	nutmeg.menuSuperfish.init();
	nutmeg.headerMenuToggles.init();
	nutmeg.headerSearchformToggle.init();
	nutmeg.scrollAnimations.init();
	nutmeg.fitVids.init();

} );