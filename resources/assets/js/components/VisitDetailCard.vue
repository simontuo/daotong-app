<template >
    <Card class="i-circle">
        <div id="main" style="width: 600px;height: 400px;"></div>
    </Card>
</template>

<script>
    import echarts from 'echarts'
    export default {
        name: '',
        data() {
            return {
                charts: '',
                opinion: [],
                opinionData: []
            }
        },
        methods: {
            drawPie(id) {
                this.charts = echarts.init(document.getElementById(id))
                this.charts.setOption({
                    tooltip: {
                        trigger: 'item',
                        formatter: '{a}<br/>{b}:{c} ({d}%)'
                    },
                    legend: {
                        orient: 'vertical',
                        x: 'left',
                        data: this.opinion
                    },
                    series: [{
                        name: '访问来源',
                        type: 'pie',
                        radius: ['50%', '70%'],
                        avoidLabelOverlap: false,
                        label: {
                            normal: {
                                show: false,
                                position: 'center'
                            },
                            emphasis: {
                                show: true,
                                textStyle: {
                                    fontSize: '30',
                                    fontWeight: 'blod'
                                }
                            }
                        },
                        labelLine: {
                            normal: {
                                show: false
                            }
                        },
                        data: this.opinionData
                    }]
                })
            }
        },
        //调用
        mounted() {
            axios.get('/api/statistics/visitDetail').then(response => {
                this.opinion = response.data.detail.opinion;
                this.opinionData = response.data.detail.opinionData;

                this.drawPie('main')
            });

            // this.$nextTick(function() {
            //     this.drawPie('main')
            // });
        }
    }
</script>
