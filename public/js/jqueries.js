$(document).ready(function(){

    $('.slick-carousel').slick({
        //infinite: false,
        //slidesToShow: 3,
        //slidesToScroll: 3,
        adaptiveHeight:true,
        mobileFirst:true,
        arrows:true
    });

    $("#event_date").datepicker();

    $( "#slider-range" ).slider({
      range: true,
      min: 500,
      max: 200000,
      step:100,
      values: [ 500,2000000 ],
      slide: function( event, ui ) {
        $("#amount").text( "Budget : N" + ui.values[ 0 ] + " - N" + ui.values[ 1 ]);
        $( "#budget" ).val(ui.values[ 0 ] + "-" +ui.values[ 1 ] );
      }
    });
    /*$( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
      " - $" + $( "#slider-range" ).slider( "values", 1 ) );*/
        
        

});
