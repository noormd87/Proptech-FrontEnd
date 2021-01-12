$(document).ready(function(){
    $('.btn-toggler').on('click', function(){
        $('.side-bar').addClass('show-bar');
        $('body').addClass('no-scroll');
    });
    $('.hide-bar').on('click', function(){
        $('.side-bar').removeClass('show-bar');
        $('body').removeClass('no-scroll');
    });

    $('.fprop-slider').owlCarousel({
        loop: true,
        margin: 30,
        dots: false,
        autoplay:true,
        nav: false,
        // navText: ["<i class='far fa-chevron-left'></i>", "<i class='far fa-chevron-right'></i>"],
        responsive: {
            0: {
                margin: 0,
                slideBy: 1,
                items: 1
            },
            786: {
                slideBy: 2,
                items: 2
            },
            1199: {
                slideBy: 3,
                items: 3
            },
            1600: {
                slideBy: 4,
                items: 4
            }
        }
    });


    
    $('.prop-notification').owlCarousel({

        loop: false,

        margin: 15,

        dots: false,
        
        autoplay:true,
        
        nav: false,

        // navText: ["<i class='far fa-chevron-left'></i>", "<i class='far fa-chevron-right'></i>"],

        responsive: {

            0: {

                margin: 0,

                items: 1

            },
            1300: {

                items: 2

            },
            1600: {

                items: 3

            }

        }

    });


    $('.input_check').on('change', function (){
        if($(this).is(':checked'))
        {
            $(this).parent().parent().addClass('pbox-checked');
        } else {
            $(this).parent().parent().removeClass('pbox-checked');
        }
    });
    
    $('#completed-projects').DataTable();

});