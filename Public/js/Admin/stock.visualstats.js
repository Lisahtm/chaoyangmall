var init_charts = function() {
    // 基于准备好的dom，初始化echarts实例
    var order_chart = echarts.init(document.getElementById('order-chart'));
    var user = document.getElementById('user-chart')
    var user_chart = null;
    if(user) user_chart=echarts.init(user);

    // 指定图表的配置项和数据
    $.ajax({
        'type': 'GET', 
        'url': '/Admin/Stock/statistics',
        'success': function (res) {
            var option = {
                title: {
                    text: '领航万店-订单分析'
                },
                toolbox: {
                    feature: {
                        magicType: {
                            type: ['stack', 'tiled']
                        },
                        dataView: {},
                        saveAsImage: {
                            pixelRatio: 2
                        }
                    }
                },
                tooltip: {},
                legend: {
                    data:['销量','金额'],
                    x: 'left'
                },
                dataZoom: [
                    {
                        show: true,
                        realtime: true,
                        start: 65,
                        end: 100
                    },
                    {
                        type: 'inside',
                        realtime: true,
                        start: 65,
                        end: 100
                    }
                ],
                xAxis: {
                    data: res['order_day'],
                    // silent: false,
                    // splitLine: {
                    //     show: false
                    // }
                },
                yAxis: [
                    {
                        name: '订单数',
                        type: 'value',
                        max: Math.max(res['order_num']),
                        min: 0
                    },
                    {
                        name: '订单金额（元）',
                        // nameLocation: 'start',                        
                        type: 'value',
                        max: Math.ceil(Math.max(res['order_price'])),
                        min: 0
                        // inverse: true
                    }
                ],
                series: [{
                    name: '订单总数',
                    yAxisIndex: 0,
                    type: 'bar',
                    data: res['order_num']
                },
                {
                    name: '订单总金额',
                    yAxisIndex: 1,
                    type: 'bar',
                    data: res['order_price']
                }]
            };
            order_chart.setOption(option);

            option = {
                title: {
                    text: '领航万店-用户分析'
                },
                toolbox: {
                    feature: {
                        magicType: {
                            type: ['stack', 'tiled']
                        },
                        dataView: {},
                        saveAsImage: {
                            pixelRatio: 2
                        }
                    }
                },
                tooltip: {},
                legend: {
                    data:['用户数'],
                    x: 'left'
                },
                dataZoom: [
                    {
                        show: true,
                        realtime: true,
                        start: 65,
                        end: 100
                    },
                    {
                        type: 'inside',
                        realtime: true,
                        start: 65,
                        end: 100
                    }
                ],
                xAxis: {
                    data: res['user_day'],
                    // silent: false,
                    // splitLine: {
                    //     show: false
                    // }
                },
                yAxis: [
                    {
                        name: '用户数',
                        type: 'value',
                        max: Math.max(res['user_num']),
                        min: 0
                    },
                ],
                series: [{
                    name: '新增用户数',
                    yAxisIndex: 0,
                    type: 'line',
                    symbolSize: 10,
                    data: res['user_num']
                }]
            };
            
            if(user_chart) user_chart.setOption(option);
            
        }
    });    

    // 使用刚指定的配置项和数据显示图表。
    // myChart.setOption(option);
};

$(document).ready(function() {
    init_charts();
});