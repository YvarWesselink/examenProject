$(document).ready(function () {
    
    $(window).scroll(function() {
        var scrollTop = $(window).scrollTop();
        if ( scrollTop > $('body').offset().top ) { 
          $('nav').css({'box-shadow':'1px 1px 15px 0 rgba(0, 0, 0, 0.6)'});
        
        }else if ( !scrollTop) { 
            $('nav').css({'box-shadow':'none'});
          }
      });
});
