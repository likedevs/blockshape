$().ready( function() {
    $(".regular").slick({
    dots: false,
    infinite: true,
    slidesToShow: 3,
    slidesToScroll: 3,
    arrows: true,
    responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2
          }
        },
        {
          breakpoint: 550,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        },

      ]
    });

    setTimeout(function(){
      $('.message').fadeOut(4000);
    }, 5000);

    $('.message').click(function(){
      $(this).fadeOut(1000);
    });

    $('.open').on('click', function(){
        $id = $(this).attr('data-id');

        $('#'+$id).slideToggle();
        $('#'+$id+'2').slideToggle();
    });

    $('.cloose').on('click', function(){
        $id = $(this).attr('data-id');

        $('#'+$id).slideToggle();
        $('#'+$id+'2').slideToggle();
    });

    $('.change-account-data').on('click', function(){
        $(this).parent().prev().children('.input').fadeIn('fast');
        $(this).parent().prev().children('.entry').fadeOut('fast');
    });

    $('.confirm-checkbox').on('change', function(){
        $('.pasive-pay').fadeToggle('fast');
        $('.active-pay').fadeToggle('fast');
        $('.active-pay').toggleClass('pay-block');
    })

    $('.add-form').on('click', function(){
        $(this).siblings('.to-clone').clone().removeClass('to-clone').removeClass('hidden').insertBefore('.to-clone');
    });
    $('.add-form2').on('click', function(){
        $(this).siblings('.to-clone2').clone().removeClass('to-clone2').removeClass('hidden').insertBefore('.to-clone2');
    });
    $('.add-input').on('click', function(){
        $('.add-new ').clone().removeClass('add-new').removeClass('hidden').insertBefore('#mark-space');
    });

    $('#body-weight').on('keyup', function(){
        $now = $(this).val();
        $begin = $('#begin').attr('data') - $now;
        $last = $('#last').attr('data') - $now;

        if (typeof $begin == "number") {
            $('#begin').val($begin);
        }
        if (typeof $last == "number") {
            $('#last').val($last);
        }
    });

});

function previewFile(){
  var preview = document.querySelector('.preview'); //selects the query named img
  var file    = document.querySelector('input[type=file]').files[0]; //sames as here
  var reader  = new FileReader();

  reader.onloadend = function () {
      preview.src = reader.result;
  }

  if (file) {
      reader.readAsDataURL(file); //reads the data as a URL
  } else {
      preview.src = "";
  }
}
