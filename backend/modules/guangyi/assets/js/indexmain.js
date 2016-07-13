/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
(function(win,$){
    
    var STEP_NAMES = ['开机','关机','放试剂','放耗材','定标品稀释静置','质控品稀释静置','标本离心','把定标品放入进仓口',
            '启动START (做定标)','把质控品放入进仓口','启动START (做质控)','把标本放入进仓口','启动START (做标本)','发报告','STOP仪器','设备维护','清理试剂'];

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
                text: '统计出错步骤',
                subtext: '',
                x:'left'
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
    p.reflashChart = function(title,data){
        for(var i=0,len=data.length;i<len;i++)
            data[i]["name"] = STEP_NAMES[data[i]["step"]];
        
        this.chartOptions.title.text = title;
        this.chartOptions.series[0].data = data;
        this.chart.setOption(this.chartOptions);
    }
    
    win.guangyi.IndexMain = Main;
})(window,jQuery);

