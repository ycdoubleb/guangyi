/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
(function(win,$){
    
    var STEP_NAMES = ["Step0","Step1","Step2","Step3","Step4","Step5","Step6","Step7","Step8","Step9","Step10","Step11","Step12","Step13","Step14","Step15","Step16"];
    
    win.guangyi = win.guangyi || {};
    var Main = function(){
        
    }
    var p = Main.prototype;
    /** 制图画板 */
    p.canvas = null;
    /** 图表 */
    p.chart = null;
    /** 图表选项 */
    p.chartOptions = null;
    
    p.init = function(dom){
        this.canvas = dom;
        this.chart = echarts.init(dom);
        this.chartOptions = {
            title : {
                text: '某站点用户访问来源',
                subtext: '纯属虚构',
                x:'center'
            },
            tooltip : {
                trigger: 'item',
                formatter: "{a} <br/>{b} : {c} ({d}%)"
            },
            legend: {
                orient: 'vertical',
                left: 'left',
                data: []
            },
            series : [
                {
                    name: '',
                    type: 'pie',
                    radius : '55%',
                    center: ['50%', '60%'],
                    data:[
                        /*
                        {value:335, name:'直接访问'},
                        {value:310, name:'邮件营销'},
                        {value:234, name:'联盟广告'},
                        {value:135, name:'视频广告'},
                        {value:1548, name:'搜索引擎'} 
                         */
                    ],
                    itemStyle: {
                        emphasis: {
                            shadowBlur: 10,
                            shadowOffsetX: 0,
                            shadowColor: 'rgba(0, 0, 0, 0.5)'
                        }
                    }
                }
            ]
        };
    };
    
    /**
     * 刷新图标
     * @param {Array} data 出错步骤数据
     * @returns 
     */
    p.reflashChart = function(data){
        for(var i=0,len=data.length;i<len;i++)
            data[i]["name"] = STEP_NAMES[data[i]["step"]];
       
        this.chartOptions.series[0].data = data;
        this.chart.setOption(this.chartOptions);
    }
    
    win.guangyi.IndexMain = Main;
})(window,jQuery);

