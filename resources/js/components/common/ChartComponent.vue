<script>
import { Pie } from 'vue-chartjs'

export default {
    extends: Pie,
    data: () => ({
        chart: {
            labels: [],
            datasets: [
                {
                    fill: true,
                    backgroundColor: [
                        'black',
                        'white'
                    ],
                    data: [5, 95],
                    // borderColor: ['black', 'black'],
                    borderWidth: [2,2]
                }
            ]
        },
        options: {
            legend: {
                display: false,
                position: 'left',
                labels: {
                    fontColor: 'rgb(255, 99, 132)'
                }
            }
        }
    }),
    props: {
        chartData: Object  
    },
    methods: {
        getChartData() {
            this.chart.labels = this.chartData.labels;
            this.chart.datasets[0].data = this.chartData.data;
            this.chart.datasets[0].backgroundColor = this.chartData.backgroundColor;
        }
    },
    mounted () {
        this.getChartData();
        this.renderChart(this.chart, this.options)
    }
}
</script>
