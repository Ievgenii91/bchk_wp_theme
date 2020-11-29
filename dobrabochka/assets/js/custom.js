let isMobile = false;

if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
  isMobile = true;
}

if(!isMobile) {
  document.addEventListener('DOMContentLoaded', function(){  
    /* footer */
    var blocks = document.getElementsByClassName('text-primary');
    Array.from(blocks).forEach((element, index) => {
      blocks[index].onclick = function(e) {
        e.preventDefault();
        if(e.currentTarget.nextElementSibling.className.includes('show')) {
          e.currentTarget.nextElementSibling.classList.remove('show');
        } else {
          e.currentTarget.nextElementSibling.classList.add('show');
        }               
      }
    });
    /* other */
    const header = document.getElementById('masthead');
    header.style.transition = '0.2s';
    const logoWrapper = document.getElementsByClassName('site-branding')[0];
    const space = document.getElementsByClassName('header-space')[0];
    const preHeader = document.getElementsByClassName('pre-header')[0];
    const scrollTopEl = document.getElementsByClassName('scroll-top')[0];

    var $ = jQuery;
    $('#scroll-top-el').on('click', function(e) {
      e.preventDefault();
      $( 'html, body' ).animate( {
        scrollTop: 0
      }, 1000 );
    });
    $('.lang-item-ru a').text('RU').css({ 'display' : 'inline-block' });
    $('.lang-item-uk a').text('UK').css({ 'display' : 'inline-block' });

    // var count = 0;
    // $('.teleform .action-button').on('click', function(){
    //   if(count) return;      
    //   count++;
    //   var formData = $(this).closest('.teleform').serializeArray();
    //   var phone = formData.find(v => v.name === 'phone');
    //   if(!phone || !phone.value) {
    //     var $el = $(this).find('.error-form')
    //     $el.fadeIn(400);
    //     var timer = setTimeout(function() {
    //       $el.fadeOut(400);
    //       clearTimeout(timer);
    //     }, 5000);
    //     return;
    //   }
    //   $(this).prop('disabled', true);
    //   $.ajax({
    //       url: 'https://dobrabochka.herokuapp.com/api/message',
    //       data: formData,
    //       type: "POST",
    //       success: function( data ){
    //         debugger;
    //           count = 0;
    //           if(!data.error){
    //             var $el = $(this).find('.success-form')
    //             $el.fadeIn(400);
    //             var timer = setTimeout(function() {
    //               $el.fadeOut(400);
    //               clearTimeout(timer);
    //             }, 5000);
    //             setTimeout(() => {
    //               $(this).prop('disabled', false);
    //             }, 30000);
    //           } else {
    //             var $el = $(this).find('.error-form')
    //             $el.fadeIn(400);
    //             var timer = setTimeout(function() {
    //               $el.fadeOut(400);
    //               clearTimeout(timer);
    //             }, 5000);
    //           }
    //       }
    //   }).done(function() {
    //     debugger;
    //     alert( "success" );
    //   })
    //   .fail(function() {
    //     debugger;
    //     alert( "error" );
    //   })
    //   .always(function() {
    //     debugger;
    //     alert( "complete" );
    //   });;
    // });
    $('.teleform').on('submit', function(){
      $(this).find('.action-button').prop('disabled', true);
      var $el = $(this).find('.success-form')
      $el.fadeIn(400);
      var timer = setTimeout(() => {
        $el.fadeOut(400);
        $(this).find('.action-button').prop('disabled', false);
        clearTimeout(timer);
      }, 20000);
    })

    document.addEventListener('scroll', (e) => {
      if(window.document.documentElement.scrollTop > 0) {
        if(header.style.height === '70px') return;       
        header.style.height = '70px'
        header.style.position = 'fixed';
        preHeader.style.position = 'fixed';
        logoWrapper.classList.add('scrolled');
        space.classList.add('sticky-space-on');
        if(scrollTopEl) {
          scrollTopEl.classList.add('on');
          scrollTopEl.classList.remove('off');
        }
      } else {
        if(header.style.height === '100px') return;
        header.style.height = '100px'
        header.style.position = 'absolute';
        preHeader.style.position = 'absolute';
        logoWrapper.classList.remove('scrolled');
        space.classList.remove('sticky-space-on');
        if(scrollTopEl) {
          scrollTopEl.classList.remove('on');
          scrollTopEl.classList.add('off');
        }
      }
    })
  });

  
 }