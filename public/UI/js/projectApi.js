"use strict";
layui.use(["okUtils", "table", "countUp", "okMock", 'okTab', 'element', 'siamConfig'], function () {
    var countUp = layui.countUp;
    var table = layui.table;
    var okUtils = layui.okUtils;
    var okMock = layui.okMock;
    var $ = layui.jquery;
    var okTab = layui.okTab();
    var element = layui.element;
    var siamConfig = layui.siamConfig;


    var id   = getUrlParam("id");
    var name = decodeURI(getUrlParam("name"));

    $("#project-title").html("API统计 - " + name);

    let backUrl = `projectDetail.html?id=${id}&name=${name}`;

    $("#backBtn").click(function(){
        window.location.href = backUrl;
        return false;
    });

    var dateArray = [];

    function load_data()
    {
       okUtils.ajax("/api/api_log/overview", "post", {}, true).done(function (res) {
           dateArray = res.data.date;
           // 重组格式
           let success_data = new Array(dateArray.length).fill(0);
           let fail_data = new Array(dateArray.length).fill(0);
           $.each(res.data.data, function(index,item){
               let i = dateArray.indexOf(item.time);
               if (i !== -1){
                   success_data[i] = item.success_times;
                   fail_data[i] = item.fail_times;
               }
           });
           requestCurve(success_data);
           errorCurve(fail_data);

       }).fail(function (error) {
           console.log(error);
       })
    }


    // 总览图表

    function requestCurve(data) {
        let requestCurveOp = {
            tooltip: {
                trigger: 'axis'
            },
            xAxis: {
                type: 'category',
                data: dateArray,
            },
            yAxis: {
                type: 'value'
            },
            dataZoom: [
                {
                    type: 'slider',
                    show: true,
                    xAxisIndex: [0],
                    start: 0,
                    end: 7
                }
            ],
            series: [{
                data: data,
                type: 'line',
                smooth: true,
                symbol: "none",
            }]
        };
        let requestCurve = echarts.init($("#request-curve")[0], "theme");
        requestCurve.setOption(requestCurveOp);
        okUtils.echartsResize([requestCurve]);
    }


    function errorCurve(data) {
        let errorCurveOp = {
            tooltip: {
                trigger: 'axis'
            },
            xAxis: {
                type: 'category',
                data: dateArray
            },
            yAxis: {
                type: 'value'
            },
            dataZoom: [
                {
                    type: 'slider',
                    show: true,
                    xAxisIndex: [0],
                    start: 0,
                    end: 7
                }
            ],
            series: [{
                data: data,
                type: 'line',
                smooth: true,
                color:"red",
                symbol: "none",
            }],
        };
        let errorCurve = echarts.init($("#error-curve")[0], "theme");
        errorCurve.setOption(errorCurveOp);
        okUtils.echartsResize([errorCurve]);
    }

    function proportion()
    {
        let url = siamConfig.config('url') + "/api/api_log/proportion";
        table.render({
            elem: '#proportion'
            , height: 312
            , width: 1000
            , url: url //数据接口
            , where:{
                project_id : id
            }
            , page: false //开启分页
            , cols: [[ //表头
                { field: 'api_full', title: '接口名',width:300}
                , { field: 'num', title: '请求数'}
                , { field: 'fail_times', title: '失败次数'}
                , { field: 'avg_consume_time', title: '平均耗时(ms)'}
                , { field: 'proportion', title: '占比'}
                , { field: 'can_use', title: '可用性'}
            ]]
            , response: {
                statusName: 'code' //规定数据状态的字段名称，默认：code
                ,statusCode: 200 //规定成功的状态码，默认：0
                ,countName: 'count' //规定数据总数的字段名称，默认：count
                ,dataName: 'data' //规定数据列表的字段名称，默认：data
            }
            , parseData: function(res){ //res 即为原始返回的数据
                return {
                    "code": res.code, //解析接口状态
                    "msg": res.msg, //解析提示文本
                    "count": res.data.count, //解析数据长度
                    "data": res.data.list //解析数据列表
                };
            }
        });
    }

    // 详情表格


    // 点击详情



    load_data();
    proportion();
});
