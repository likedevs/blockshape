$().ready(function(){

    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('meta[name="_token"]').attr('content')
        }
    });


    $('.traning').change(function(){
        $time = $('.traning option:selected').val();

        $.ajax({
          type: "POST",
          url: 'traning-chnage',
          data: {time:$time},
          success: function(data){
              if (JSON.parse(data).msg == "true") {
                 location.reload();
                 console.log('xsxs');
              }
              console.log(JSON.parse(data).msg);
          }
        });
    });

});
