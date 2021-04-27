$(function() {
    // メニュー
    $('#js-pulldown').click(function() {
        $('.arrow').toggleClass('active');
        $('.menu-box').toggleClass('active');
        return false;
    });
      
      $('#js-modal-close').click(function() {
        $('.modal-container').fadeOut();
        $('#js-modal-close').fadeOut();
        $('html').toggleClass('active');
        return false;
      });
      
      
      // モーダルウィンドウを開く
      $('.post-item').each(function() {
        $(this).find('#js-modal-open').on('click', function(){
          var target = $(this).data('target');
          var modal = document.getElementById(target);
          // console.log($(this));
          $(modal).fadeIn();
          $('#js-modal-close').fadeIn();
          $('html').toggleClass('active');
          return false;
        });
      });
      
    });
