@extends('layouts.app')

@section('head')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js"></script>
@endsection

@section('content')
    <div id="app">

    </div>
    <div id="container">
        <div id="chart"></div>
    </div>
@endsection

@section('footer')
    <script src="http://code.highcharts.com/highcharts.js"></script>
    <script src="http://code.highcharts.com/modules/drilldown.js"></script>
    <script>

    $(document).ready(function(){
        $.getJSON('/api/reports/time',{},function( response ){

            var clients = [];
            var data = [];
            var drilldown = [];
            var projects = [];
            var tasks = [];

            if ( response )
            {
                response.clients.forEach( function( client, c_index ){
                    clients.push({
                        name: client.name,
                        y: client.total_time,
                        drilldown: client.name
                    });

                    client.projects.forEach( function( project, project_index ){
                        projects.push({
                            name: project.name,
                            y: project.total_time,
                            drilldown: project.id
                        });

                        project.tasks.forEach( function( task, task_index ){
                            tasks.push({
                                name: task.name,
                                y: task.total_time
                            });
                        });

                        tasks = [];

                        drilldown.push({
                            name: project.name,
                            id: project.id,
                            data: tasks
                        });
                    });

                    drilldown.push({
                        name: client.name,
                        id: client.name,
                        data: projects
                    });

                    projects = [];
                    tasks = [];

                });
            }

            // Create the chart
            Highcharts.chart('chart', {
                chart: {
                    type: 'pie'
                },
                title: {
                    text: 'Time per Client -> Project -> Task '
                },
                subtitle: {
                    text: 'Click the slices to view drilldown.'
                },
                plotOptions: {
                    series: {
                        dataLabels: {
                            enabled: true,
                            format: '{point.name}: {point.y:.2f} hours'
                        }
                    }
                },

                tooltip: {
                    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}</b> hours<br/>'
                },
                series: [{
                    name: 'Clients',
                    colorByPoint: true,
                    data: clients
                }],
                drilldown: {
                    series: drilldown
                }
            });


        });
    });
    function getRandomColor() {
    var letters = '0123456789ABCDEF';
    var color = '#';
    for (var i = 0; i < 6; i++) {
      color += letters[Math.floor(Math.random() * 16)];
    }
      return color;
    }
    </script>
    <script>

    // var colors = Highcharts.getOptions().colors,
    // categories = ['MSIE', 'Firefox', 'Chrome', 'Safari', 'Opera'],
    // data = [{
    //     y: 56.33,
    //     color: colors[0],
    //     drilldown: {
    //         name: 'MSIE versions',
    //         categories: ['MSIE 6.0', 'MSIE 7.0', 'MSIE 8.0', 'MSIE 9.0',
    //         'MSIE 10.0', 'MSIE 11.0'],
    //         data: [1.06, 0.5, 17.2, 8.11, 5.33, 24.13],
    //         color: colors[0]
    //     }
    // }, {
    //     y: 10.38,
    //     color: colors[1],
    //     drilldown: {
    //         name: 'Firefox versions',
    //         categories: ['Firefox v31', 'Firefox v32', 'Firefox v33',
    //         'Firefox v35', 'Firefox v36', 'Firefox v37', 'Firefox v38'],
    //         data: [0.33, 0.15, 0.22, 1.27, 2.76, 2.32, 2.31, 1.02],
    //         color: colors[1]
    //     }
    // }, {
    //     y: 24.03,
    //     color: colors[2],
    //     drilldown: {
    //         name: 'Chrome versions',
    //         categories: ['Chrome v30.0', 'Chrome v31.0', 'Chrome v32.0',
    //         'Chrome v33.0', 'Chrome v34.0',
    //         'Chrome v35.0', 'Chrome v36.0', 'Chrome v37.0', 'Chrome v38.0',
    //         'Chrome v39.0', 'Chrome v40.0', 'Chrome v41.0', 'Chrome v42.0',
    //         'Chrome v43.0'],
    //         data: [0.14, 1.24, 0.55, 0.19, 0.14, 0.85, 2.53, 0.38, 0.6, 2.96,
    //             5, 4.32, 3.68, 1.45],
    //             color: colors[2]
    //         }
    //     }, {
    //         y: 4.77,
    //         color: colors[3],
    //         drilldown: {
    //             name: 'Safari versions',
    //             categories: ['Safari v5.0', 'Safari v5.1', 'Safari v6.1',
    //             'Safari v6.2', 'Safari v7.0', 'Safari v7.1', 'Safari v8.0'],
    //             data: [0.3, 0.42, 0.29, 0.17, 0.26, 0.77, 2.56],
    //             color: colors[3]
    //         }
    //     }, {
    //         y: 0.91,
    //         color: colors[4],
    //         drilldown: {
    //             name: 'Opera versions',
    //             categories: ['Opera v12.x', 'Opera v27', 'Opera v28', 'Opera v29'],
    //             data: [0.34, 0.17, 0.24, 0.16],
    //             color: colors[4]
    //         }
    //     }, {
    //         y: 0.2,
    //         color: colors[5],
    //         drilldown: {
    //             name: 'Proprietary or Undetectable',
    //             categories: [],
    //             data: [],
    //             color: colors[5]
    //         }
    //     }],
    //     browserData = [],
    //     versionsData = [],
    //     i,
    //     j,
    //     dataLen = data.length,
    //     drillDataLen,
    //     brightness;


    //     // Build the data arrays
    //     for (i = 0; i < dataLen; i += 1) {

    //         // add browser data
    //         browserData.push({
    //             name: categories[i],
    //             y: data[i].y,
    //             color: data[i].color
    //         });

    //         // add version data
    //         drillDataLen = data[i].drilldown.data.length;
    //         for (j = 0; j < drillDataLen; j += 1) {
    //             brightness = 0.2 - (j / drillDataLen) / 5;
    //             versionsData.push({
    //                 name: data[i].drilldown.categories[j],
    //                 y: data[i].drilldown.data[j],
    //                 color: Highcharts.Color(data[i].color).brighten(brightness).get()
    //             });
    //         }
    //     }

        // Create the chart
        // Highcharts.chart('container', {
        //     chart: {
        //         type: 'pie'
        //     },
        //     title: {
        //         text: 'Browser market share, January, 2015 to May, 2015'
        //     },
        //     subtitle: {
        //         text: 'Source: <a href="http://netmarketshare.com/">netmarketshare.com</a>'
        //     },
        //     yAxis: {
        //         title: {
        //             text: 'Total percent market share'
        //         }
        //     },
        //     plotOptions: {
        //         pie: {
        //             shadow: false,
        //             center: ['50%', '50%']
        //         }
        //     },
        //     tooltip: {
        //         valueSuffix: '%'
        //     },
        //     series: [{
        //         name: 'Browsers',
        //         data: browserData,
        //         size: '60%',
        //         dataLabels: {
        //             formatter: function () {
        //                 return this.y > 5 ? this.point.name : null;
        //             },
        //             color: '#ffffff',
        //             distance: -30
        //         }
        //     }, {
        //         name: 'Versions',
        //         data: versionsData,
        //         size: '80%',
        //         innerSize: '60%',
        //         dataLabels: {
        //             formatter: function () {
        //                 // display only if larger than 1
        //                 return this.y > 1 ? '<b>' + this.point.name + ':</b> ' +
        //                 this.y + '%' : null;
        //             }
        //         },
        //         id: 'versions'
        //     }],
        //     responsive: {
        //         rules: [{
        //             condition: {
        //                 maxWidth: 400
        //             },
        //             chartOptions: {
        //                 series: [{
        //                     id: 'versions',
        //                     dataLabels: {
        //                         enabled: false
        //                     }
        //                 }]
        //             }
        //         }]
        //     }
        // });
        </script>
    @endsection
