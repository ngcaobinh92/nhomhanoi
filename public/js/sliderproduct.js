$(window).load(function() {
	function a() {
		$.each($(o).find(".owl2-item"), function(a) {
			var e = $(".owl2-controls .owl2-dots span");
			$(e[a++]).append("0" + a++)
		}), $(".owl2-item.center").find(".block-des").addClass("blockdes-active"), $(".owl2-item.center").find(".save").addClass("save-active")
	}

	function e() {
		$(".owl2-item.center").find(".block-des").addClass("blockdes-active"), $(".owl2-item.center").find(".save").addClass("save-active")
	}
	var o = $(".sohomeslider-inner-1"),
		o = $(".product-slider-1"),
		t = 3;
	$(".sohomeslider-inner-1").owlCarousel2({
		animateOut: "slideOutDown",
		animateIn: "slideInDown",
		autoplay: true,
		autoplayHoverPause: 1,
		autoplayTimeout: 5000,
		autoplaySpeed: 1e3,
		startPosition: 0,
		margin: 10,
		autoplayHoverPause: !0,
		startPosition: 0,
		mouseDrag: !0,
		touchDrag: !0,
		dots: !0,
		autoWidth: !0,
		dotClass: "owl2-dot",
		dotsClass: "owl2-dots",
		loop: !0,
		navText: ["Next", "Prev"],
		navClass: ["owl2-prev", "owl2-next"],
		responsive: {
			0: {
				items: 1,
				autoWidth: !1,
				nav: 0 >= t ? !1 : !0
			},
			480: {
				items: 1,
				autoWidth: !1,
				nav: 2 >= t ? !1 : !0
			},
			768: {
				items: 1,
				autoWidth: !1,
				nav: 2 >= t ? !1 : !0
			},
			992: {
				items: 1,
				autoWidth: !1,
				nav: 2 >= t ? !1 : !0
			},
			1200: {
				items: 3,
				center: !0,
				nav: 2 >= t ? !1 : !0
			}
		},
		onInitialized: a,
		onTranslated: e
	}), $(".product-slider-1").owlCarousel2({
		margin: 10,
		loop: !1,
		slideBy: 4,
		autoplay: true,
		autoplayHoverPause: 1,
		autoplayTimeout: 0,
		autoplaySpeed: 1e3,
		startPosition: 0,
		mouseDrag: 1,
		touchDrag: 1,
		navigation: 0,
		autoWidth: !1,
		responsive: {
			0: {
				items: 1,
				nav: 1 >= t ? !1 : !0
			},
			480: {
				items: 2,
				nav: 2 >= t ? !1 : !0
			},
			768: {
				items: 2,
				nav: 2 >= t ? !1 : !0
			},
			992: {
				items: 3,
				nav: 3 >= t ? !1 : !0
			},
			1200: {
				items: 4,
				nav: 4 >= t ? !1 : !0
			}
		},
		nav: !0,
		loop: !0,
		navSpeed: 500,
		navText: ["", ""],
		navClass: ["owl2-prev", "owl2-next"]
	}), $(".product-slider-2").owlCarousel2({
		margin: 30,
		loop: !1,
		slideBy: 4,
		autoplay: true,
		autoplayHoverPause: 1,
		autoplayTimeout: 5000,
		autoplaySpeed: 1e3,
		startPosition: 0,
		mouseDrag: 1,
		touchDrag: 1,
		navigation: 0,
		autoWidth: !1,
		responsive: {
			0: {
				items: 2,
				nav: 1 >= t ? !1 : !0
			},
			480: {
				items: 2,
				nav: 2 >= t ? !1 : !0
			},
			768: {
				items: 3,
				nav: 3 >= t ? !1 : !0
			},
			992: {
				items: 3,
				nav: 3 >= t ? !1 : !0
			},
			1200: {
				items: 4,
				nav: 4 >= t ? !1 : !0
			}
		},
		nav: !0,
		loop: !0,
		navSpeed: 500,
		navText: ["", ""],
		navClass: ["owl2-prev", "owl2-next"]
	}), $(".product-slider-3").owlCarousel2({
		margin: 10,
		loop: !1,
		slideBy: 4,
		autoplay: true,
		autoplayHoverPause: 1,
		autoplayTimeout: 3000,
		autoplaySpeed: 1e3,
		startPosition: 0,
		mouseDrag: 1,
		touchDrag: 1,
		navigation: 0,
		autoWidth: !1,
		responsive: {
			0: {
				items: 2,
				nav: 1 >= t ? !1 : !0
			},
			480: {
				items: 2,
				nav: 2 >= t ? !1 : !0
			},
			768: {
				items: 2,
				nav: 2 >= t ? !1 : !0
			},
			992: {
				items: 3,
				nav: 3 >= t ? !1 : !0
			},
			1200: {
				items: 4,
				nav: 4 >= t ? !1 : !0
			}
		},
		nav: !0,
		loop: !0,
		navSpeed: 500,
		navText: ["", ""],
		navClass: ["owl2-prev", "owl2-next"]
	}), $(".product-slider-4").owlCarousel2({
		margin: 10,
		loop: !1,
		slideBy: 1,
		autoplay: true,
		autoplayHoverPause: 1,
		autoplayTimeout: 0,
		autoplaySpeed: 1e3,
		startPosition: 0,
		mouseDrag: 1,
		touchDrag: 1,
		navigation: 0,
		autoWidth: !1,
		responsive: {
			0: {
				items: 1,
				nav: 1 >= t ? !1 : !0
			},
			480: {
				items: 1,
				nav: 2 >= t ? !1 : !0
			},
			768: {
				items: 1,
				nav: 2 >= t ? !1 : !0
			},
			992: {
				items: 1,
				nav: 3 >= t ? !1 : !0
			},
			1200: {
				items: 1,
				nav: 4 >= t ? !1 : !0
			}
		},
		nav: !0,
		loop: !0,
		navSpeed: 500,
		navText: ["", ""],
		navClass: ["owl2-prev", "owl2-next"]
	}), $(".doitac_ct").owlCarousel2({
		loop: !1,
		slideBy: 4,
		autoplay: 0,
		autoplayHoverPause: 1,
		autoplayTimeout: 0,
		autoplaySpeed: 1e3,
		startPosition: 0,
		mouseDrag: 1,
		touchDrag: 1,
		navigation: 0,
		autoWidth: !1,
		responsive: {
			0: {
				items: 1,
				nav: 1 >= t ? !1 : !0
			},
			480: {
				items: 2,
				nav: 2 >= t ? !1 : !0
			},
			768: {
				items: 3,
				nav: 3 >= t ? !1 : !0
			},
			992: {
				items: 3,
				nav: 3 >= t ? !1 : !0
			},
			1200: {
				items: 6,
				nav: 4 >= t ? !1 : !0
			}
		},
		nav: !0,
		loop: !0,
		navSpeed: 500,
		navText: ["", ""],
		navClass: ["owl2-prev", "owl2-next"]
	}), $(".product-slider-5").owlCarousel2({
		margin: 10,
		loop: !1,
		slideBy: 4,
		autoplay: 0,
		autoplayHoverPause: 1,
		autoplayTimeout: 0,
		autoplaySpeed: 1e3,
		startPosition: 0,
		mouseDrag: 1,
		touchDrag: 1,
		navigation: 0,
		autoWidth: !1,
		responsive: {
			0: {
				items: 1,
				nav: 1 >= t ? !1 : !0
			},
			480: {
				items: 2,
				nav: 2 >= t ? !1 : !0
			},
			768: {
				items: 3,
				nav: 3 >= t ? !1 : !0
			},
			992: {
				items: 3,
				nav: 3 >= t ? !1 : !0
			},
			1200: {
				items: 4,
				nav: 4 >= t ? !1 : !0
			}
		},
		nav: !0,
		loop: !0,
		navSpeed: 500,
		navText: ["", ""],
		navClass: ["owl2-prev", "owl2-next"]
	}), jQuery(document).ready(function(a) {
		$(".loader").fadeOut("slow");
	})
});