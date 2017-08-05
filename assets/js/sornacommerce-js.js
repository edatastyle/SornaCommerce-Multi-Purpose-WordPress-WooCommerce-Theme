(function(jQuery) {
    'use strict';
    jQuery(document).ready(function() {

	
            /* ============== MOBILE MENU ============== */
            jQuery('.mobile-menu-toggle').on('click', function(){
                jQuery('.mobile-menu').toggle();
				jQuery(this).find('i').toggleClass('fa-bars').toggleClass('fa-close');
            });
            jQuery(window).on('resize', function(){
                if(window.matchMedia('screen and (min-width : 1200px)').matches&&jQuery('.mobile-menu').css('display')==='block'){
                    jQuery('.mobile-menu').toggle();
                }
            });
            
            /* ============== DROP TOGGLE ============== */
            jQuery('.drop-toggle-2').on('click', function(e){
                e.preventDefault();
                jQuery(this).siblings('.drop-menu-2').toggle();
            });
            /* ============== DROP ANIMATION ============== */
            jQuery('.drop-toggle').on('click', function(e){
                e.preventDefault();
                jQuery(this).siblings('.drop-menu').slideToggle();
                jQuery(this).find('i').toggleClass('fa-angle-down fa-angle-up');
            });
            /* ============== TOGGLE ================*/
            jQuery('.toggle > nav').on('click', function(){
                jQuery(this).children('i').toggleClass('fa-angle-down fa-angle-up');
                jQuery(this).siblings('div').slideToggle();
                    
            });
            /* ================ ACCORDION =============== */
            jQuery('.accordion > .item > nav').on('click',function(){
                //aditional condition for clicking active item
                if(!jQuery(this).parent('.item').hasClass('active')){
                    jQuery(this).parents('.accordion').children('.item.active').children('nav').children('i').toggleClass('fa-angle-down fa-angle-up');
                    jQuery(this).parents('.accordion').children('.item.active').children('div').slideToggle();
                    jQuery(this).parents('.accordion').children('.item.active').toggleClass('active');
                }
                jQuery(this).parent('.item').toggleClass('active');
                jQuery(this).children('i').toggleClass('fa-angle-down fa-angle-up');
                jQuery(this).siblings('div').slideToggle();
            });
            /* ============= TABS ===============*/
            jQuery('.select-table > nav a').on('click', function(event){
                event.preventDefault();
                var id = '#' + jQuery(this).parents('.select-table').attr('id');
                jQuery(id + ' li.active').toggleClass('active');
                jQuery(this).parent('li').toggleClass('active');
                jQuery(id + ' ' + jQuery(this).attr('href')).toggleClass('active');
            });
            /* ============ FORM AMMOUNT ============*/
            jQuery('.ammount input[type=text]').attr('disabled','disabled');
            jQuery('.ammount button').on('click', function(e){
                e.preventDefault();
                if(jQuery(this).text()==='+'){
                    jQuery(this).siblings('input[type=text]').val(parseInt(jQuery(this).siblings('input[type=text]').val())+1);
                }
                else if(parseInt(jQuery(this).siblings('input[type=text]').val())>1){
                    jQuery(this).siblings('input[type=text]').val(parseInt(jQuery(this).siblings('input[type=text]').val())-1);
                }
            });
            
            /* ============ FORM RATE ============*/
            jQuery('.form-rate a').on('click', function(e){
                e.preventDefault();
                if(!jQuery(this).parent('li').hasClass('active')){
                    jQuery(this).parent('li').siblings('.active').children('a').children('i').toggleClass('fa-star fa-star-o');
                    jQuery(this).parent('li').siblings('.active').toggleClass('active');
                }
                jQuery(this).parent('li').toggleClass('active');
                jQuery(this).parents('.form-rate').siblings('#form-rate').children('input[type=hidden]').val(jQuery(this).parent('li').index()+1);
            });
            jQuery('.form-rate a').on('mouseover mouseout', function(){
                if(!jQuery(this).parent('li').hasClass('active')){
                    jQuery(this).children('i').toggleClass('fa-star fa-star-o');
                }
            });
            
            
            /* ============== SIDE MENU ============== */
            jQuery('.toggle-1-button').on('click', function(){
                if(jQuery('#toggle-1').css('display') == 'none')
                {
                    jQuery('#toggle-1').css('display', 'block');
                    jQuery('#wrapper-1').animate({left: '-300px'}, 500);
                    if(navigator.userAgent.indexOf("Safari") <= -1)jQuery('body').css('overflow', 'hidden');
                    jQuery('.main-menu').animate({left: '-300px'}, 500);
                    jQuery('#toggle-1').animate({right: '0px'}, 500,function(){
                        jQuery('#toggle-1').css('overflow', 'auto');
                    });
                }
                else{
                    jQuery('#wrapper-1').animate({left: '0px'}, 500);
                    if(navigator.userAgent.indexOf("Safari") <= -1)jQuery('body').css('overflow', 'auto');
                    jQuery('.main-menu').animate({left: '0px'}, 500);
                    jQuery('#toggle-1').animate({right: '-300px'}, 500,function(){
                        jQuery('#toggle-1').css('display', 'none');
                        jQuery('#toggle-1').css('overflow', 'hidden');
                    });
                }
            });
            
         /* ============== SMOTH SLIDE ============== */
                jQuery('.smooth-scroll').on('click', function(event){
                    event.preventDefault();
                    var id = jQuery(this).attr('href');
                    var position = parseInt(jQuery(document).find(id).offset().top);
                    jQuery('html, body').animate({scrollTop: position});
                });
                /* ============== SCROLL TOP ============== */
                jQuery(window).on('scroll', function(){
                    if(jQuery(this).scrollTop()>jQuery(this).height()/2)jQuery('.scroll-top').css('opacity', 0.7);
                    else jQuery('.scroll-top').css('opacity',0);
                });
                jQuery('.scroll-top').on('click', function(event){
                    event.preventDefault();
                    jQuery('html, body').animate({scrollTop: 0});
                });
          
            
        
/* ============== Quantity buttons ============== */

    jQuery( 'div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)' ).addClass( 'buttons_added' ).append( '<input type="button" value="+" class="plus" />' ).prepend( '<input type="button" value="-" class="minus" />' );

    // Target quantity inputs on product pages
    jQuery( 'input.qty:not(.product-quantity input.qty)' ).each( function() {
        var min = parseFloat( jQuery( this ).attr( 'min' ) );

        if ( min && min > 0 && parseFloat( jQuery( this ).val() ) < min ) {
            jQuery( this ).val( min );
        }
    });

    jQuery( document ).on( 'click', '.plus, .minus', function() {

        // Get values
        var $qty        = jQuery( this ).closest( '.quantity' ).find( '.qty' ),
            currentVal  = parseFloat( $qty.val() ),
            max         = parseFloat( $qty.attr( 'max' ) ),
            min         = parseFloat( $qty.attr( 'min' ) ),
            step        = $qty.attr( 'step' );

        // Format values
        if ( ! currentVal || currentVal === '' || currentVal === 'NaN' ) currentVal = 0;
        if ( max === '' || max === 'NaN' ) max = '';
        if ( min === '' || min === 'NaN' ) min = 0;
        if ( step === 'any' || step === '' || step === undefined || parseFloat( step ) === 'NaN' ) step = 1;

        // Change the value
        if ( jQuery( this ).is( '.plus' ) ) {

            if ( max && ( max == currentVal || currentVal > max ) ) {
                $qty.val( max );
            } else {
                $qty.val( currentVal + parseFloat( step ) );
            }

        } else {

            if ( min && ( min == currentVal || currentVal < min ) ) {
                $qty.val( min );
            } else if ( currentVal > 0 ) {
                $qty.val( currentVal - parseFloat( step ) );
            }

        }

        // Trigger change event
        $qty.trigger( 'change' );
    });

   

           
            
          
           

	});
})(jQuery);