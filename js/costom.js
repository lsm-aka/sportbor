//###################### document.ready ######################

$(function(){	
	//----------------------------------
	$(window).on( "orientationchange", function(){			
		if ( $('.inner-page .owl-carousel').length ) {	
			$('.owl-carousel').trigger('next.owl.carousel', [100]);
			$carousel = $('.owl-carousel');
			$carousel.data('owl.carousel')._invalidated.width = true;
    		$carousel.trigger('refresh.owl.carousel');
			console.log("event: orientationchange");
		}
	});	
	//############################### load resize scroll ###################################

	$(window).on("load resize scroll", function(e) {
		scrollUpDown();
		CheckPopupTop();
		console.log("event: load resize scroll");		
	});

	$(window).on("load resize", function(e) {
		scrollingEv = 0;
		resizer();
		console.log("event: load resize");
	});
}); // end $(function()

//############################ BX ############################

BX.ready(function(){
   
   var addAnswer = new BX.PopupWindow("form_answer", null, {
      content: BX('ajax-add-answer'),
      closeIcon: {right: "20px", top: "20px"},
      //titleBar: {content: BX.create("span", {html: '<b>Обратная связь</b>', 'props': {'className': 'access-title-bar'}})},
      zIndex: 0,
      overlay: {backgroundColor: 'black', opacity: '10' },
      offsetLeft: 0,
      offsetTop: 0,
      autoHide : true,
      lightShadow : true,
      closeByEsc : true,
      draggable: {restrict: false},      
   }); 
   $('.callback').click(function(){
    BX.showWait();    
      BX.ajax.get(
          arSimplekitOptions.SITE_DIR+'ajax/callback_form_body.php',         
          function (data) {
            addAnswer.setContent(data);
            addAnswer.show();
            BX.closeWait();
          }
      );
      if( $("body").hasClass("no-scrolling") ){
      	$("body, html").addClass("has-scrolling").removeClass("no-scrolling");
      }
      return false;
   });

   $('.cat-btn-order-ajax').click(function(){
    BX.showWait();
    var post = {};
	post['element-name'] = $("#element-name").val();   
      BX.ajax.post(
          arSimplekitOptions.SITE_DIR+'ajax/order_form_body.php',
          post,
          function (data) {
            addAnswer.setContent(data);
            addAnswer.show();
            BX.closeWait();
          }
      );
      if( $("body").hasClass("no-scrolling") ){
      	$("body, html").addClass("has-scrolling").removeClass("no-scrolling");
      }
      return false;
   });

   $('.ask_question_form').click(function(){
    BX.showWait();
    var post = {};
	post['element-name'] = $("#element-name").val();     
      BX.ajax.post(
          arSimplekitOptions.SITE_DIR+'ajax/lsm_ask_question_form_body.php',
          post,
          function (data) {
            addAnswer.setContent(data);
            addAnswer.show();
            BX.closeWait();
          }
      );
      if( $("body").hasClass("no-scrolling") ){
      	$("body, html").addClass("has-scrolling").removeClass("no-scrolling");
      }
      return false;
   });

	$('.send_resum_form').click(function(){
	    BX.showWait();	       
	      BX.ajax.get(
	          arSimplekitOptions.SITE_DIR+'ajax/resum_form_body.php',	          
	          function (data) {
	            addAnswer.setContent(data);
	            addAnswer.show();
	            BX.closeWait();
	          }
	      );
	      if( $("body").hasClass("no-scrolling") ){
	      	$("body, html").addClass("has-scrolling").removeClass("no-scrolling");
	      }
	    return false;
	});

   $('.btn-order-ajax').click(function(){
    BX.showWait();
    var post = {};
	post['element-name'] = $("#element-name").val();   
      BX.ajax.post(
          arSimplekitOptions.SITE_DIR+'ajax/order_form_body.php',
          post,
          function (data) {
            addAnswer.setContent(data);
            addAnswer.show();
            BX.closeWait();
          }
      );
      if( $("body").hasClass("no-scrolling") ){
      	$("body, html").addClass("has-scrolling").removeClass("no-scrolling");
      }
      return false;
   });   

	$('.btn-order-send').click(function(){
	    BX.showWait();	       
	      BX.ajax.get(
	          arSimplekitOptions.SITE_DIR+'ajax/order_form_body.php',	          
	          function (data) {
	            addAnswer.setContent(data);
	            addAnswer.show();
	            BX.closeWait();
	          }
	      );
	      if( $("body").hasClass("no-scrolling") ){
	      	$("body, html").addClass("has-scrolling").removeClass("no-scrolling");
	      }
	    return false;
	});

	//----------------------------------------------------------------

	$(".popup-window-close-icon").click(function(){
   		$("#ajax-add-answer").remove();
   		if( $("body").hasClass("has-scrolling") ){
   			if( $("#mnucontainer").hasClass("open-sidebar") ){
   				$("body, html").addClass("no-scrolling").removeClass("has-scrolling");
   			}	      	
	    }
	});
}); // end BX.ready

//############################ (window).load ############################

$(window).load(function() {
	width = Math.min($(window).width(), window.innerWidth);
	height = window.innerHeight;
	console.log("width = "+width);
	console.log("width = "+width);
	$('ul.navbar-nav').responsiveCollapse({
		breakPoint: 1199,
		overflowItemText: '<i class="icon-tri_tochki"></i>',
	});	

	if( $("#sidebar .item-selected").length ){
		$("#sidebar .item-selected").parents("li").addClass("open-li");
	}

	$("#sidebar .drop-down .icon-chevron-small-down").click(function() {
		$(this).parent("a").parent("li").toggleClass("open-li").siblings().removeClass("open-li");
		return false;
	});

	$(".navbar-toggle").on("click", function() {
		var navBar = $(this).data("target");
		if ( $(navBar).length ) {
			$(navBar).toggleClass("open-sidebar");
			$("body, html").toggleClass("no-scrolling");
		}
	});

	$(".closer-link").on("click", function() {
		var navBar = $(this).data("target");
		if ( $(navBar).length ) {
			$(navBar).toggleClass("open-sidebar");
			$("body, html").toggleClass("no-scrolling");
		}
	});

	$("#menu-type-box ul.list-unstyled li").mouseover(function() {
		$(this).addClass("li-open");
	});

	$("#menu-type-box ul.list-unstyled li").mouseout(function() {
		$(this).removeClass("li-open");
	});

	if( $("#navbarleft").length ){
		$("#navbarleft").mCustomScrollbar({
			axis: "y",
			autoHideScrollbar: true,
			documentTouchScroll: false,
		});
	}

	if( $("#news-list-navbar").length ){
		$("#news-list-navbar").mCustomScrollbar({
			axis: "y",
			autoHideScrollbar: false,
			documentTouchScroll: false,
		});
	}

	$(".in-rotate").click(function() {
		$(".type-menus").toggleClass("active");
	});

	$("input, textarea").focus(function(){
		$(this).removeClass("error");
	})

	//---------------------------------- vakansii ----------------------------------	

	$(".slide-ctrl-link").click(function(){
		$(this).toggleClass('active').parents('.element-slide-block').siblings().find('.slide-ctrl-link').removeClass('active');

		$(this).parents('.element-slide-block').siblings().find('.element-slide-desc').slideUp( 400, function() {
		    // Animation complete.
		});

		$(this).parents('.element-slide-block').find('.element-slide-desc').slideToggle( 400, function() {
		    // Animation complete.		    
		});				
	});	

	//---------------------------------- BIG SLIDER ----------------------------------	
	
	if ( $('#owl1').length ) {		
		var owl1 = $('#owl1');

		// Меняем класс dark или laght, в меню и контейнере слайдера, в зависимости от класса активного элемента слайдера
		owl1.on('initialized.owl.carousel', function(event) {
			this_item = event.item.index;
			active_item = $('#owl1 .sl-item')[this_item];
			menu_block = $(".box-with-shadow");
			mega_slider = $(".mega-slider");
			menu_type_box__id = $("#menu-type-box");

			if( menu_block.hasClass("static-dark") && menu_block.hasClass("static-bg") ){
				menu_block.addClass("dark").removeClass("light");
			}
			else if( menu_block.hasClass("static-light") && !menu_type_box__id.hasClass("tpl-4") ){
				menu_block.addClass("light").removeClass("dark");
			}
			else{
				if($(active_item).hasClass("dark")) {
					menu_block.addClass("dark").removeClass("light");					
				}
				else if($(active_item).hasClass("light")){
					menu_block.addClass("light").removeClass("dark");					
				}
			}

			if($(active_item).hasClass("dark")) {				
				mega_slider.addClass("dark").removeClass("light");
			}
			else if($(active_item).hasClass("light")){				
				mega_slider.addClass("light").removeClass("dark");
			}


			// Выравниваем высоту элементов по максимальной при ширине меньше 768px
			if(width<=768){
				var sl_item = $('.sl-item');				
				ApplyHight( sl_item );
			}								
		});

		taching = false;
		if(width<=1024){
			taching = true;
		}

		// Иницализация самого слайдера.
		owl1.owlCarousel({
			items: 1,
			loop: (owl1.children().length)==1 ? false:true,
			dots: true,
			nav: false,
			thumbs: false,
			autoplay: false,
			dragBeforeAnimFinish : taching,
		    mouseDrag : taching,
		    touchDrag : taching,
			//autoplayTimeout: 5000,
			//autoplayHoverPause: true,
			animateOut: 'fadeOut'
		});

		//Переключатели слайдера
		$('.slider-block .owl-next').click(function() {
			owl1.trigger('next.owl.carousel', [300]);
		});

		$('.slider-block .owl-prev').click(function() {
			owl1.trigger('prev.owl.carousel', [300]);
		});

		// Меняем класс dark или laght, в меню и контейнере слайдера, в зависимости от класса активного элемента слайдера 
		owl1.on('changed.owl.carousel', function(event) {
			this_item = event.item.index;
			active_item = $('#owl1 .sl-item')[this_item];
			menu_block = $(".box-with-shadow");
			mega_slider = $(".mega-slider");

			if($(active_item).hasClass("dark")) {				
				mega_slider.addClass("dark").removeClass("light");
			}
			else if($(active_item).hasClass("light")){
				mega_slider.addClass("light").removeClass("dark");
			}

			if ($(".head-container").length && parseInt($(".head-container").height()) > 0) {
				scrolY = 50;
			} else {
				scrolY = 10;
			}

			scrollTop = $(window).scrollTop();
			if( scrollTop > scrolY){
				return;
			}

			if( !menu_block.hasClass("static-bg") ){
				if($(active_item).hasClass("dark")) {
					menu_block.addClass("dark").removeClass("light");
				}
				else if($(active_item).hasClass("light")){
					menu_block.addClass("light").removeClass("dark");
				}	
			}	
		});
	}

	//---------------------------------- services ----------------------------------

	if ( $('#services-carusel-1').length ) {
		var specCar = $('#services-carusel-1');
		// Иницализация самого слайдера.
		specCar.owlCarousel({			
			loop: (specCar.children().length)==1 ? false:true,
			dots: false,
			nav: false,
			autoplay: false,
			//autoplayTimeout: 5000,
			//autoplayHoverPause: true,
			//animateOut: 'fadeOut',
			responsiveClass:true,
			thumbs: false,
		    responsive:{
		        0:{
		            items:1
		        },
		        600:{
		            items:2
		        },
		        1200:{
		            items:3
		        }
		    }
		});

		//Переключатели слайдера
		$('.secrvices-slider-block .owl-next').click(function() {
			specCar.trigger('next.owl.carousel', [300]);
		});

		$('.secrvices-slider-block .owl-prev').click(function() {
			specCar.trigger('prev.owl.carousel', [300]);
		});
	
	}

	if ( $('#services-carusel-2').length ) {
		var servCar = $('#services-carusel-2');
		// Иницализация самого слайдера.
		servCar.owlCarousel({			
			loop: (servCar.children().length)==1 ? false:true,
			dots: true,
			nav: false,
			autoplay: false,
			responsiveClass:true,
			thumbs: false,
		    responsive:{
		        0:{
		            items:1
		        },
		        600:{
		            items:2
		        },
		        1200:{
		            items:3
		        }
		    }
		});
	
	}

	if( $('#services-carusel-3').length ){
		var $container = $('#services-carusel-3');
		if( width>600 ){
			$container.isotope({
		  		itemSelector: '.item',
		  		columnWidth: 10,
		  		gutter: 20
		  	});		  	
		}	
	}

	if( $('#services-inner-carusel-1').length ){
		var inserviceCar = $('#services-inner-carusel-1');		
		inserviceCar.owlCarousel({			
			loop: (inserviceCar.children().length)==1 ? false:true,
			dots: true,
			nav: false,			
			autoplay: false,
			autoHeight:false,
			responsiveClass:true,
			thumbs: false,
			margin:50,			
		    responsive:{
		        0:{
		            items:1
		        },
		        600:{
		        	 items:2
		        }
		    }
		});
	}
	
	//---------------------------------- projects ----------------------------------

	if ( $('#projects-owl-1').length ) {
		var projects1 = $('#projects-owl-1');
		// Иницализация самого слайдера.
		projects1.owlCarousel({
		    loop: (projects1.children().length)==1 ? false:true,
		    margin: 60,
			dots: true,
			nav: false,
			autoplay: false,
			//autoplayTimeout: 5000,
			//autoplayHoverPause: true,
			//animateOut: 'fadeOut',
			responsiveClass:true,
			thumbs: false,
		    responsive:{
		        0:{
		        	stagePadding: 0,
		        	margin:20,
		            items:1
		        },
		        992:{
		        	stagePadding: 287,
		        	margin:40,
		        	center: true,
		            items:1		            
		        },
		        1200:{
		        	stagePadding: 347,
		        	margin:40,
		        	center: true,
		            items:1		            
		        },
		        1400:{
		        	stagePadding: 404,
		        	margin:60,
		        	center: true,
		            items:1
		        },
		        1661:{
		        	stagePadding: 543,
		        	margin:0,
		        	center: true,
		            items:1
		        }
		    }
		});

		//Переключатели слайдера
		$('.projects-slider .owl-next').click(function() {
			projects1.trigger('next.owl.carousel', [300]);
		});

		$('.projects-slider .owl-prev').click(function() {
			projects1.trigger('prev.owl.carousel', [300]);
		});
	
	}

	if ( $('#projects-owl-2').length ) {
		var projects2 = $('#projects-owl-2');
		// Иницализация самого слайдера.
		projects2.owlCarousel({			
			loop: (projects2.children().length)==1 ? false:true,
			dots: false,
			nav: false,
			autoplay: false,
			//autoplayTimeout: 5000,
			//autoplayHoverPause: true,
			//animateOut: 'fadeOut',
			responsiveClass:true,
			thumbs: false,
		    responsive:{
		        0:{
		            items:1
		        },
		        600:{
		            items:2
		        },
		        1200:{
		            items:3
		        },
		        1661:{
		            items:4
		        }
		    }
		});

		//Переключатели слайдера
		$('.projects-slider .owl-next').click(function() {
			projects2.trigger('next.owl.carousel', [300]);
		});

		$('.projects-slider .owl-prev').click(function() {
			projects2.trigger('prev.owl.carousel', [300]);
		});
	
	}

	if( $('#projects-3').length ){		
		    var $container1 = $('#projects-3 .grid');
		    var $button = $('#project-filter .button');
		    // filter buttons
		    $button.click(function(){
				var $this = $(this);
		        // don't proceed if already selected
		      
	         $button.removeClass('btn-color');
	          $this.addClass('btn-color');
		       
		      var selector1 = $this.attr('data-filter');
		      $container1.isotope({  
		      	itemSelector: '.element-item', 
		      	filter: selector1, 
		      });
		      return false;
		    });
	}


	if( $('#projects-4').length ){
	    var $container2 = $('#projects-4 .grid');
	    var $button = $('#project-filter .button');
	    // filter buttons
	    $button.click(function(){
			var $this = $(this);
	        // don't proceed if already selected
	      
         $button.removeClass('btn-color');
          $this.addClass('btn-color');
	       
	      var selector2 = $this.attr('data-filter');
	      $container2.isotope({  
	      	itemSelector: '.grid-item', 
	      	filter: selector2,
	      	 masonry: {
			    columnWidth: 10
			  }
	      	});
	      return false;
	    });
	}

	//---------------------------------- news ----------------------------------

	if ( $('#owl-news-tpl2').length ) {
		var newsOwl = $('#owl-news-tpl2');
		// Иницализация самого слайдера.
		newsOwl.owlCarousel({			
			loop: (newsOwl.children().length)==1 ? false:true,
			dots: false,
			nav: false,
			autoplay: false,
			responsiveClass:true,
			thumbs: false,
		    responsive:{
		        0:{
		            items:1
		        },
		        1200:{
		            items:2
		        }
		    }
		});

		//Переключатели слайдера
		$('.news-slider-block .owl-next').click(function() {
			newsOwl.trigger('next.owl.carousel', [300]);
		});

		$('.news-slider-block .owl-prev').click(function() {
			newsOwl.trigger('prev.owl.carousel', [300]);
		});
	}

	//---------------------------------- reviews ----------------------------------

	if ( $('#owl-reviews-tpl2').length ) {
		var reviewOwl = $('#owl-reviews-tpl2');
		// Иницализация самого слайдера.
		reviewOwl.owlCarousel({			
			loop: (reviewOwl.children().length)==1 ? false:true,
			dots: true,
			nav: false,			
			autoplay: false,
			responsiveClass:true,
			thumbs: false,
		    responsive:{
		        0:{
		            items:1
		        },
		        750:{
		            items:2
		        },
		        1200:{
		            items:3
		        }
		    }
		});
	}


	if ( $('#owl-reviews-tpl5-a').length ) {
		reviewOwlA = $('#owl-reviews-tpl5-a');
		// Иницализация самого слайдера.
		reviewOwlA.owlCarousel({			
			loop: (reviewOwlA.children().length)==1 ? false:true,
			dots: true,
			nav: false,			
			autoplay: false,
			responsiveClass:true,
			thumbs: false,
			smartSpeed:500,
			margin:10,
		    responsive:{
		        0:{
		        	stagePadding: 60,		        			        	
		            center: true,
		            items:1,
		        },
		        768:{
		        	stagePadding: 120,
		        	center: true,
		            items:1,		                        
		        }
		    }
		});
	}

	if ( $('#owl-reviews-tpl5-b').length ) {
		reviewOwlB = $('#owl-reviews-tpl5-b');
		// Иницализация самого слайдера.
		reviewOwlB.owlCarousel({			
			loop: (reviewOwlA.children().length)==1 ? false:true,
			dots: true,
			nav: false,			
			autoplay: false,
			items:1,			
			smartSpeed:500,
			thumbs: false,
			responsive:{
		        0:{
		        	stagePadding: 0,		        			        	
		            items:1
		        }
		    }
		});
	}

	if ( $('#owl-reviews-tpl5-a').length && $('#owl-reviews-tpl5-b').length ) {

		changeSlid = 0;
		reviewOwlA.on('changed.owl.carousel', function(e) {			
			if( changeSlid == 0 ){
				currentItemA = e.item.index - (e.relatedTarget.clones().length / 2);				
				reviewOwlB.trigger('to.owl.carousel', [currentItemA, 300]);
				changeSlid = 1;
			}
			else{
				changeSlid = 0;
			}				
		});
		
		reviewOwlB.on('changed.owl.carousel', function(event) {				
			if( changeSlid == 0 ){
				currentItemB = event.item.index - (event.relatedTarget.clones().length / 2);				
				reviewOwlA.trigger('to.owl.carousel', [currentItemB, 300]);
				changeSlid = 1;
			}
			else{
				changeSlid = 0;
			}										
		});
		
	}

	//---------------------------------- partners ----------------------------------

	if ( $('#partners-owl-1').length ) {
		partnersOwl = $('#partners-owl-1');
		// Иницализация самого слайдера.
		partnersOwl.owlCarousel({			
			loop: (partnersOwl.children().length)==1 ? false:true,
			dots: false,
			nav: false,
			autoplay: true,
			responsiveClass:true,
			smartSpeed:500,
			margin:0,
			thumbs: false,	
			responsive:{
		        0:{		        			        	
		            items:1
		        },
		        420:{	        			        	
		            items:2
		        },
		        600:{	        			        	
		            items:3
		        },
		        750:{	        			        	
		            items:4
		        },
		        800:{	        			        	
		            items:5
		        }
		    }
		});
	}		
	
	//---------------------------------- catalog ----------------------------------

	if( $('#cat-index-carusel-1').length ){
		var catIndexCar = $('#cat-index-carusel-1');		
		catIndexCar.owlCarousel({			
			loop: (catIndexCar.children().length)==1 ? false:true,
			dots: true,
			nav: false,			
			autoplay: false,
			autoHeight:false,
			responsiveClass:true,
			thumbs: false,
			margin:20,			
		    responsive:{
		        0:{
		            items:1
		        },
		        768:{
		        	 items:2
		        },
		        992:{
		        	 items:3
		        },
		        1200:{
		        	 items:4
		        }
		    }
		});
	}

	if( $('#cat-featured-inner-carusel-1').length ){
		var catfeaturedCar = $('#cat-featured-inner-carusel-1');		
		catfeaturedCar.owlCarousel({			
			loop: (catfeaturedCar.children().length)==1 ? false:true,
			dots: true,
			nav: false,			
			autoplay: false,
			autoHeight:false,
			responsiveClass:true,
			thumbs: false,
			margin:25,			
		    responsive:{
		        0:{
		            items:1
		        },
		        600:{
		        	 items:2
		        },
		        1200:{
		        	 items:3
		        }
		    }
		});
	}
	
	//------------------------------- ВАЖНО!!! --------------------------------	
	// Этот блок для слайдера с owl-thumbs, и после него, не должны быть другие вызовы owlCarousel

	if( $('#inner-page-slider').length ){				
		var inserviceOwl = $('#inner-page-slider');

		inserviceOwl.on('initialized.owl.carousel', function(event) {
			var H_inserviceOwl = parseInt( $("#inner-page-slider .owl-item.active").height() )/2 + 'px';
			$(".owl-nav-hidden").css({
				"top": H_inserviceOwl,
			});
		});	

		inserviceOwl.owlCarousel({			
			loop: (inserviceOwl.children().length)==1 ? false:true,
			dots: true,
			nav: true,			
			autoplay: false,
			autoHeight:true,
			responsiveClass:true,	
			thumbs: true,
			thumbImage: false,
			thumbsPrerendered: true,
			thumbContainerClass: 'owl-thumbs',
			thumbItemClass: 'owl-thumb-item',					
		    responsive:{
		        0:{
		            items:1
		        }
		    }
		});

		//Переключатели слайдера
		$('.inner-slider-block .owl-next').click(function() {
			inserviceOwl.trigger('next.owl.carousel', [300]);
		});

		$('.inner-slider-block .owl-prev').click(function() {
			inserviceOwl.trigger('prev.owl.carousel', [300]);
		});

		inserviceOwl.on('refreshed.owl.carousel', function(event) {
			var H_inserviceOwl = parseInt($("#inner-page-slider .owl-item.active").height())/2 + 'px';
			$(".owl-nav-hidden").css({
				"top": H_inserviceOwl,
			});			
		});	
		inserviceOwl.on('resized.owl.carousel', function(event) {
			var H_inserviceOwl = parseInt($("#inner-page-slider .owl-item.active").height())/2 + 'px';
			$(".owl-nav-hidden").css({
				"top": H_inserviceOwl,
			});
		});			
	}

	//---------------------------------- POP-UP GALLERY ----------------------------------

	if( $('.zooming-link').length ){
		$('.zooming-link').magnificPopup({
		  type: 'image',
		  closeMarkup: '<span title="%title%" class="icon-cross mfp-close"></span>',
		  tLoading: 'Загрузка...',		  
		  gallery: {
		    enabled: true,
		    arrowMarkup: '<button title="%title%" class="mfp-arrow mfp-arrow-%dir%"><i class="icon-angle-%dir%"></i></button>'
		  },
		  image: {	            
            titleSrc: function(item) {
                return item.el.attr('title');
            }
          },
		  callbacks: {
		    open: function() {
		      $(".mfp-wrap").addClass("zooming-container");
		    },
		    close: function() {
		      $(".mfp-wrap").removeClass("zooming-container");
		    }		    
		  },
		});
	}

	$('.ajax-search-link').magnificPopup({
	  type: 'ajax',
	  closeMarkup: '<span title="%title%" class="icon-cross mfp-close"></span>',
	  tLoading: 'Загрузка...',
	  callbacks: {
	    open: function() {
	      $(".mfp-wrap").addClass("search-container");
	    },
	    close: function() {
	      $(".mfp-wrap").removeClass("search-container");
	    }		    
	  },
	});	

	//-------------------------------- Instagramm ------------------------------

	if( $("#instafeed").length ){
	    var feed = new Instafeed({
	        get:'user',
	        userId: '<?=$instagram_userid?>',   // <-- new
	        clientId: '<?=$instagram_clientid?>',
	        accessToken:'<?=$instagram_accesstoken?>',
	        limit: 6,
	        template:'<div class="col-xs-4"><!--noindex--><a rel="nofollow" href="{{link}}" target="_blank"><span class="footer-inw-item" style="background-image:url({{image}})">&nbsp;</span></a><!--/noindex--></div>'
	    });
	    feed.run();
	}

	if( $("#head-instafeed").length ){
	    var feed = new Instafeed({
	        target:'head-instafeed',
	        get:'user',
	        userId: '<?=$instagram_userid?>',   // <-- new
	        clientId: '<?=$instagram_clientid?>',
	        accessToken:'<?=$instagram_accesstoken?>',
	        limit: 8,
	        template:'<div class="col-xs-3"><!--noindex--><a rel="nofollow" href="{{link}}" target="_blank"><span class="top-inw-item" style="background-image:url({{image}})">&nbsp;</span></a><!--/noindex--></div>'
	    });
	    feed.run();
	}

	//----------------------------------------------------------------

	if( $(".js-select3").length ){
		selectCall3();
	}

}); // end $(window).load


//############################ Функции ################################

//----------------------------------------------------------------

function scrollUpDown() {

	if ( $("#menu-type-box").length ) {

		scrollTop = $(window).scrollTop();
		scrolY = 50;
		head_container = $(".head-container");

		if (head_container.length && parseInt(head_container.height()) > 0) {
			scrolY = 50;
		} else {
			scrolY = 10;
		}

		if (scrollTop > scrolY) {
			if(typeof scrollingEv != "undefined"){
				if(scrollingEv == 1){
					return false;
				}
			}			
		}
		menuBox = $("#menu-type-box");
		sidebar = $("#sidebar");
		innerPage = $(".inner-page");
		mega_menu  = $(".mega-menu");
		menu_block = $(".box-with-shadow");	
		menu_type_box__id = $("#menu-type-box");

		if (scrollTop > scrolY) {
			mega_menu.addClass("fixed-top").removeClass("shadow-none");
			menuBox.addClass("scroll-menu");
			sidebar.addClass("scroll-bar");			
			head_container.addClass("hidden");
			if (menuBox.hasClass("toogle-bg")) {
				menuBox.removeClass("transparenta");
			}
			if( innerPage.length ){
				innerPage.addClass("inner-page-scroll");
			}

			if( menu_block.length && !menu_block.hasClass("static-bg") ){			

				if( mega_menu.hasClass("mega-menu-inner") ){					
					mega_menu.removeClass("light").addClass(arSimplekitOptions.THEME.LSM_MENU_COLOR);				
				}

				if( mega_menu.hasClass("dark") ){					
					menu_block.addClass("dark").removeClass("light");
				}
				else if( mega_menu.hasClass("light") ){					
					menu_block.addClass("light").removeClass("dark");
				}
			}

			scrollingEv = 1;
			console.log('scrollingEv = 1');
		} else {
			mega_menu.removeClass("fixed-top");
			menuBox.removeClass("scroll-menu");
			sidebar.removeClass("scroll-bar");			
			head_container.removeClass("hidden");
			$(".sub-nav-bar").removeAttr("style");
			if (menuBox.hasClass("toogle-bg")) {
				menuBox.addClass("transparenta");
			}
			if( innerPage.length ){
				innerPage.removeClass("inner-page-scroll");
			}
			if( $("#sidebar-wrap").length ){
				$("#sidebar-wrap").removeClass().addClass(arSimplekitOptions.THEME.LSM_MENU_COLOR);
			}
			if( $("#owl1").length && menu_block.length && !menu_block.hasClass("static-bg") && !mega_menu.hasClass("mega-menu-inner") ){
				
				activItem = $(".owl-item.active .sl-item");

				if( !mega_menu.hasClass("mega-menu-inner") ){
					if( activItem.hasClass("dark") ){
						menu_block.addClass("dark").removeClass("light");
					}
					else if( activItem.hasClass("light") ){
						menu_block.addClass("light").removeClass("dark");
					}
				}
			}
			else if( mega_menu.hasClass("mega-menu-inner") ){
				if( menu_block.hasClass("static-bg") ){
					mega_menu.removeClass("light").addClass(arSimplekitOptions.THEME.LSM_MENU_COLOR);
					menu_block.removeClass("light static-light").addClass("static-"+arSimplekitOptions.THEME.LSM_MENU_COLOR).addClass(arSimplekitOptions.THEME.LSM_MENU_COLOR);
				}
				else if( menu_block.hasClass("static-light") ){
					mega_menu.removeClass("dark").addClass("light");
					menu_block.removeClass("dark").addClass("light");
					menu_block.removeClass("static-light").addClass("static-"+arSimplekitOptions.THEME.LSM_MENU_COLOR);	
				}
				else if( menu_block.hasClass("static-dark") ){
					mega_menu.removeClass("dark").addClass("light");
					menu_block.removeClass("dark").addClass("light");
					menu_block.removeClass("static-dark").addClass("static-"+arSimplekitOptions.THEME.LSM_MENU_COLOR);
				}
				else{
					mega_menu.removeClass("dark").addClass("light");
					menu_block.removeClass("dark").addClass("light");
				}				
			}

			if( $(".tpl-6").length ){
				mega_menu.addClass("shadow-none");
			}
			scrollingEv = 0;
			console.log('scrollingEv = 0');			
		}

	}
	return false;
}

//----------------------------------------------------------------

function ApplyHight( func_objact ){
	var mh = Math.max.apply(Math, func_objact.map(function(){  
	    return $(this).height();
	}).get());
	func_objact.height(mh);
}

//----------------------------------------------------------------

function resizer(){
	var width_r = Math.min($(window).width(), window.innerWidth);
	var height_r = window.innerHeight;
	
	if(width_r>767 && height_r>600){
		if ($(".slider-block").length ) {
			if ( height_r > 0 ) {
				$(".slider-block").css("height", height_r + 'px');
				$(".mega-slider").css("height", height_r + 'px');
				if ( $("#owl1").length ) {
					$("#owl1").css("height", height_r + 'px');
					$("#owl1 .sl-item").css("height", height_r + 'px');
					$("#owl1 .slider-table").css("height", height_r + 'px');
				}
			}		
		}
	}

	if( width_r>767 ){
		if( $('#services-inner-2 .item').length ){
			var service_item = $('#services-inner-2 .item');			
			ApplyHight( service_item );
		}

		if ( $("#owl1 .sl-item").length ) {
			var big_slider = $("#owl1 .sl-item");
			ApplyHight( big_slider );
		}

		
	}
	else{
		if( $('#services-inner-2 .item').length ){
			var service_item = $('#services-inner-2 .item');
			service_item.height("auto");
		}

		if( $('#projects-inner-body .item').length ){
			var projects_item = $('#projects-inner-body .item');
			projects_item.height("auto");
		}
	}	

	if( $("#mnucontainer").length ){				
		$("#mnucontainer").removeClass("open-sidebar");
		$("body, html").removeClass("no-scrolling");		
	}
	
}

//----------------------------------------------------------------

function AjaxFormRequest(form_id){	
	var errors=0;
	$('#'+form_id).find(".requare").each(function(){
		if($(this).val()==''){
			$(this).addClass("error");
			errors=1;
		}
		else{
			$(this).removeClass("error");			
		}
		
		var r = /^\w+@\w+\.\w{2,7}$/i;
		var emailMask = $("#email");
		
		if ( !r.test(document.getElementById("email").value) ) {
			errors=1;
			emailMask.addClass("error");
		}
	});
	if(errors==1){
		return false;
	}

	var Url = arSimplekitOptions.SITE_DIR+"ajax/formSend.php"
	var form = $("#"+form_id);
	$.ajax({
		url:Url,
		type:"POST",
		dataType:"html",
		data:form.serialize(),
		success:function(response){
			console.log(response);
			form.find(".form-control").val("");			
		},
		error:function(response){
			alert('Ошибка ajax!'+response);
		}
	});
	return false;
}


//----------------------------------------------------------------

function selectCall(){
	$(".js-select2").select2({
	    placeholder: "Выбрать тип связи",
	    // allowClear: true,
	    minimumResultsForSearch: Infinity,
	    dropdownParent: $(".js-select2").parent(),
	});	
}

function selectCall3(){
	$(".js-select3").select2({
	    placeholder: "Выбрать тип связи",
	    // allowClear: true,
	    minimumResultsForSearch: Infinity,
	    dropdownParent: $(".js-select3").parent(),
	});	
}

//----------------------------------------------------------------

CheckPopupTop = function(){
	var popup = $('.popup-window');
	if(popup.length){
		var documentScollTop = $(document).scrollTop();
		var windowHeight = $(window).height();
		var popupTop = parseInt(popup.css('top'));
		var popupHeight = popup.height();
		if((documentScollTop < popupTop) || (documentScollTop > (popupTop + popupHeight))){
			popupTop = documentScollTop + ((windowHeight > popupHeight) ? (windowHeight - popupHeight) / 2 : 0);
			popup.css('top', popupTop + 'px');
		}
	}
}

//----------------------------------------------------------------

if(document.getElementById("input3")){
  var selector1 = document.getElementById("input3");
  var im = new Inputmask("99-9999999");
  im.mask(selector1);
  Inputmask({"mask": "+7(999) 999-9999"}).mask(selector1);
}