jQuery(document).ready(function(){
    jQuery(document).on('click','.tab-title a',function(e){
        e.preventDefault();
      //  alert('hi');
        if(!jQuery(this).parent('.tab-title').hasClass('active')) {
            jQuery('.tab-title').removeClass('active');
            jQuery('.tab-content').slideUp('slow');
            jQuery(this).parent('.tab-title').addClass('active');
            jQuery(this).parents('.master-accordion-item').find('.tab-content').slideDown('slow');
        }
        else {
            jQuery('.tab-title').removeClass('active');
            jQuery('.tab-content').slideUp('slow');
        }

    })
})