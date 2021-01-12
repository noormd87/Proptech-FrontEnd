$(document).ready(function() {

      $sidebar = $('.sidebar');
      $sidebar_img_container = $sidebar.find('.sidebar-background');

      $full_page = $('.full-page');

      $sidebar_responsive = $('body > .navbar-collapse');
      sidebar_mini_active = true;

      window_width = $(window).width();

      fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();

      // if( window_width > 767 && fixed_plugin_open == 'Dashboard' ){
      //     if($('.fixed-plugin .dropdown').hasClass('show-dropdown')){
      //         $('.fixed-plugin .dropdown').addClass('show');
      //     }
      //
      // }

      $('.fixed-plugin a').click(function(event) {
        // Alex if we click on switch, stop propagation of the event, so the dropdown will not be hide, otherwise we set the  section active
        if ($(this).hasClass('switch-trigger')) {
          if (event.stopPropagation) {
            event.stopPropagation();
          } else if (window.event) {
            window.event.cancelBubble = true;
          }
        }
      });

      $('.fixed-plugin .active-color span').click(function() {
        $full_page_background = $('.full-page-background');

        $(this).siblings().removeClass('active');
        $(this).addClass('active');

        var new_color = $(this).data('color');

        if ($sidebar.length != 0) {
          $sidebar.attr('data-active-color', new_color);
        }

        if ($full_page.length != 0) {
          $full_page.attr('data-active-color', new_color);
        }

        if ($sidebar_responsive.length != 0) {
          $sidebar_responsive.attr('data-active-color', new_color);
        }
      });

      $('.fixed-plugin .background-color span').click(function() {
        $(this).siblings().removeClass('active');
        $(this).addClass('active');

        var new_color = $(this).data('color');

        if ($sidebar.length != 0) {
          $sidebar.attr('data-color', new_color);
        }

        if ($full_page.length != 0) {
          $full_page.attr('filter-color', new_color);
        }

        if ($sidebar_responsive.length != 0) {
          $sidebar_responsive.attr('data-color', new_color);
        }
      });

      $('.fixed-plugin .img-holder').click(function() {
        $full_page_background = $('.full-page-background');

        $(this).parent('li').siblings().removeClass('active');
        $(this).parent('li').addClass('active');


        var new_image = $(this).find("img").attr('src');

        if ($sidebar_img_container.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
          $sidebar_img_container.fadeOut('fast', function() {
            $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
            $sidebar_img_container.fadeIn('fast');
          });
        }

        if ($full_page_background.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
          var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

          $full_page_background.fadeOut('fast', function() {
            $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
            $full_page_background.fadeIn('fast');
          });
        }

        if ($('.switch-sidebar-image input:checked').length == 0) {
          var new_image = $('.fixed-plugin li.active .img-holder').find("img").attr('src');
          var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

          $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
          $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
        }

        if ($sidebar_responsive.length != 0) {
          $sidebar_responsive.css('background-image', 'url("' + new_image + '")');
        }
      });

      $('.switch-sidebar-image input').on("switchChange.bootstrapSwitch", function() {
        $full_page_background = $('.full-page-background');

        $input = $(this);

        if ($input.is(':checked')) {
          if ($sidebar_img_container.length != 0) {
            $sidebar_img_container.fadeIn('fast');
            $sidebar.attr('data-image', '#');
          }

          if ($full_page_background.length != 0) {
            $full_page_background.fadeIn('fast');
            $full_page.attr('data-image', '#');
          }

          background_image = true;
        } else {
          if ($sidebar_img_container.length != 0) {
            $sidebar.removeAttr('data-image');
            $sidebar_img_container.fadeOut('fast');
          }

          if ($full_page_background.length != 0) {
            $full_page.removeAttr('data-image', '#');
            $full_page_background.fadeOut('fast');
          }

          background_image = false;
        }
      });


      $('.switch-mini input').on("switchChange.bootstrapSwitch", function() {
        $body = $('body');

        $input = $(this);

        if (paperDashboard.misc.sidebar_mini_active == true) {
          $('body').removeClass('sidebar-mini');
          paperDashboard.misc.sidebar_mini_active = false;

          $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar();

        } else {

          $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar('destroy');

          setTimeout(function() {
            $('body').addClass('sidebar-mini');

            paperDashboard.misc.sidebar_mini_active = true;
          }, 300);
        }

        // we simulate the window Resize so the charts will get updated in realtime.
        var simulateWindowResize = setInterval(function() {
          window.dispatchEvent(new Event('resize'));
        }, 180);

        // we stop the simulation of Window Resize after the animations are completed
        setTimeout(function() {
          clearInterval(simulateWindowResize);
        }, 1000);

      });



      

    });


  



    var lineChartData = {
      labels: ['Oct 19', 'Nov 19', 'Dec 19', 'Jan 19'],
      datasets: [{
        label: 'My First dataset',
        borderColor: 'rgba(255, 10, 42, 1)',
        backgroundColor: 'rgba(255, 10, 42, 0.1)',
        pointBorderWidth:10,
        fill: false,
        data: [0, 150000, 125000, 165000, 75000],
        yAxisID: 'y-axis-1',
        lineTension:.3,
        cubicInterpolationMode:'default',
        fill:true,
        borderWidth:6,
      }, {
        label: 'false',
        borderColor: 'rgba(12, 154, 222, 1)',
        backgroundColor: 'rgba(12, 154, 222, 0.1)',
        fill: false,
        data: [80000, 65000, 160000, 53000, 110000],
        borderWidth:6,
        pointBorderWidth:10,
        cubicInterpolationMode:'default',
        fill:true,
        yAxisID: 'y-axis-2'
      }]
    };

    window.onload = function() {
      var ctx = document.getElementById('speedChart');
      window.myLine = Chart.Line(ctx, {
        data: lineChartData,
        options: {
          responsive: true,
          hoverMode: 'index',
          stacked: false,
          legend: {
            display: false
          },
          title: {
            display: false,
            text: 'Chart.js Line Chart - Multi Axis'
          },
          scales: {
            yAxes: [{
              type: 'linear', // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
              display: true,
              position: 'left',
              id: 'y-axis-1',
            }, {
              type: 'linear', // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
              display: false,
              position: 'right',
              id: 'y-axis-2',

              // grid line settings
              gridLines: {
                drawOnChartArea: false, // only want the grid lines for one axis to show up
              },
            }],
          }
        }
      });
    };


//sales report chart
var popCanvas = document.getElementById("popChart");

Chart.defaults.global.defaultFontFamily = "Open Sans";
Chart.defaults.global.defaultFontSize = 18;

var popData = {
  datasets: [{
    label:false,
    backgroundColor: [
          window.chartColors.red,
          window.chartColors.orange,
          window.chartColors.yellow,
          window.chartColors.green,
          window.chartColors.blue,
          window.chartColors.purple,
          window.chartColors.red
        ],

    data: [{
      x: 0,
      y: 100000,
      r: 0
    },{
      x: 60,
      y: 20000,
      r: 20
    }, {
      x: 60,
      y: 40000,
      r: 40
    }, {
      x: 40,
      y: 75000,
      r: 25
    }, {
      x: 80,
      y: 80000,
      r: 50
    }, {
      x: 85,
      y: 100000,
      r: 0
    }],
  }]
};

var bubbleChart = new Chart(popCanvas, {
  type: 'bubble',
  data: popData,
  options: {
    legend: {
        display: false
    },
    responsive:true,
    scales : { yAxes: [{ ticks: { min: 0, stepValue : 10, max : 100000, } }] }
  }
});


//progress bar pie chart
$(function() {          
    $(".pr.grain-chart").setupProgressPie({
        mode: $.fn.progressPie.Mode.COLOR,
        valueData: "val",
        size: 300,
        strokeColor: "#ffe600",
        color:'#04e0c4',
        backgroundColor: '#f4f4f4',
        scale: 2
    });
    
    $(".pr.grain-chart").setupProgressPie({
        ringWidth: 40,
        strokeWidth: 20,
    });
    

    $(".pr.grain-chart").setupProgressPie({
        ringAlign: $.fn.progressPie.RingAlign.CENTER
    });
    $(".pr.grain-chart").setupProgressPie({scale: 1.2});
    $(".pr.grain-chart").progressPie();
    
});

$(document).ready(function() {
      jQuery('#worldMap').vectorMap({
      map: 'world_en',
    backgroundColor: '#fff',
    borderColor: '#818181',
    borderOpacity: 0.25,
    borderWidth: 1,
    color: '#3c27f3',
    enableZoom: false,
    hoverColor: '#c9dfaf',
    hoverOpacity: null,
    normalizeFunction: 'linear',
    scaleColors: ['#b6d6ff', '#005ace'],
    selectedColor: '#c9dfaf',
    selectedRegions: null,
    showTooltip: true,
    onRegionClick: function(element, code, region)
    {
        var message = 'You clicked "'
            + region
            + '" which has the code: '
            + code.toUpperCase();

        //alert(message);
    }
        });

    });