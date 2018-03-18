<template >
    <Card class="i-circle">
        <div id="error" style="width: 600px;height: 400px;"></div>
    </Card>
</template>

<script>
    import echarts from 'echarts'
    export default {
        name: '',
        data() {
            return {
                charts: '',
                opinion: ["衬衫","羊毛衫","雪纺衫","裤子","高跟鞋","袜子"],
                data: [5, 20, 36, 10, 10, 20]
            }
        },
        methods: {
            drawPie(id) {
                this.charts = echarts.init(document.getElementById(id))
                this.charts.setOption({
                    title: {
                        text: 'ECharts 入门示例'
                    },
                    tooltip: {},
                    legend: {
                        data:['销量']
                    },
                    xAxis: {
                        data: this.opinion
                    },
                    yAxis: {},
                    series: [{
                        name: '销量',
                        type: 'bar',
                        data: this.data
                    }]
                })
            }
        },
        //调用
        mounted() {
            this.$nextTick(function() {
                this.drawPie('error')
            })
        }
    }
</script>
