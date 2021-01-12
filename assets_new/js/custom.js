$(document).ready(function(){
    $('.btn-toggler').on('click', function(){
        $('.side-bar').addClass('show-bar');
    });
    $('.hide-bar').on('click', function(){
        $('.side-bar').removeClass('show-bar');
    });

    $('.fprop-slider').owlCarousel({
        loop: false,
        margin: 30,
        dots: false,
        nav: false,
        // navText: ["<i class='far fa-chevron-left'></i>", "<i class='far fa-chevron-right'></i>"],
        responsive: {
            0: {
                margin: 0,
                items: 2
            },
            1199: {
                items: 3
            },
            1600: {
                items: 4
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