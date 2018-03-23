<template >
    <Card class="i-circle" style="min-height: 230px; text-align:center">
        <div class="row" style="margin-top: 22px;">
            <div class="col-md-4 mdui-m-b-2">
                <i-circle
                    :size="150"
                    :trail-width="4"
                    :stroke-width="5"
                    :percent="(this.opinionData.day / this.total).toFixed(2) * 100"
                    stroke-linecap="square"
                    stroke-color="#43a3fb">
                    <div class="demo-Circle-custom">
                        <h1>{{ this.opinionData.day }}</h1>
                        <p>日活跃人群规模</p>
                        <span>
                            总占人数
                            <i>{{ (this.opinionData.day / this.total).toFixed(2) * 100 }}%</i>
                        </span>
                    </div>
                </i-circle>
            </div>
            <div class="col-md-4 mdui-m-b-2">
                <i-circle
                    :size="150"
                    :trail-width="4"
                    :stroke-width="5"
                    :percent="(this.opinionData.week / this.total).toFixed(2) * 100"
                    stroke-linecap="square"
                    stroke-color="#ff5500">
                    <div class="demo-Circle-custom">
                        <h1>{{ this.opinionData.week }}</h1>
                        <p>周活跃人群规模</p>
                        <span>
                            总占人数
                            <i>{{ (this.opinionData.week / this.total).toFixed(2) * 100 }}%</i>
                        </span>
                    </div>
                </i-circle>
            </div>
            <div class="col-md-4 mdui-m-b-2">
                <i-circle
                    :size="150"
                    :trail-width="4"
                    :stroke-width="5"
                    :percent="(this.opinionData.month / this.total).toFixed(2) * 100"
                    stroke-linecap="square"
                    stroke-color="#5cb85c">
                    <div class="demo-Circle-custom">
                        <h1>{{ this.opinionData.month }}</h1>
                        <p>月活跃人群规模</p>
                        <span>
                            总占人数
                            <i>{{ (this.opinionData.month / this.total).toFixed(2) * 100 }}%</i>
                        </span>
                    </div>
                </i-circle>
            </div>
        </div>
    </Card>
</template>

<script>
    export default {
        data() {
            return {
                total: '',
                opinionData: {},
            }
        },
        mounted() {
            axios.get('/api/statistics/userDetail').then(response => {
                this.total = response.data.detail.total;
                this.opinionData = response.data.detail.opinionData;
                // console.log(this.detail.opinionData.day);
            });
        }
    }
</script>

<style>
    .demo-Circle-custom{
        & h1{
            color: #3f414d;
            font-size: 28px;
            font-weight: normal;
        }
        & p{
            color: #657180;
            font-size: 14px;
            margin: 10px 0 15px;
        }
        & span{
            display: block;
            padding-top: 15px;
            color: #657180;
            font-size: 14px;
            &:before{
                content: '';
                display: block;
                width: 50px;
                height: 1px;
                margin: 0 auto;
                background: #e0e3e6;
                position: relative;
                top: -15px;
            };
        }
        & span i{
            font-style: normal;
            color: #3f414d;
        }
    }
</style>
