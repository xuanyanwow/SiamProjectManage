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

    // 总览图表
    var requestCurveOp = {
        xAxis: {
            type: 'category',
            data: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun']
        },
        yAxis: {
            type: 'value'
        },
        series: [{
            data: [820, 932, 901, 934, 1290, 1330, 1320],
            type: 'line',
            smooth: true
        }]
    };

    function requestCurve() {
        var requestCurve = echarts.init($("#request-curve")[0], "theme");
        requestCurve.setOption(requestCurveOp);
        okUtils.echartsResize([requestCurve]);
    }

    var errorCurveOp = {
        xAxis: {
            type: 'category',
            data: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun']
        },
        yAxis: {
            type: 'value'
        },
        series: [{
            data: [820, 932, 901, 934, 1290, 1330, 1320],
            type: 'line',
            smooth: true,
            color:"red",
        }],
    };

    function errorCurve() {
        var errorCurve = echarts.init($("#error-curve")[0], "theme");
        errorCurve.setOption(errorCurveOp);
        okUtils.echartsResize([errorCurve]);
    }

    function proportion()
    {
        let url = siamConfig.config('url') + "/api/abnormal/get_list";
        table.render({
            elem: '#proportion'
            , height: 312
            , width: 800
            , url: url //数据接口
            , where:{
                project_id : id
            }
            , page: false //开启分页
            , cols: [[ //表头
                { field: 'ab_id', title: '接口名'}
                , { field: 'ab_class', title: '请求数'}
                , { field: 'ab_message', title: '占比'}
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




    requestCurve();
    errorCurve();
    proportion();
});
