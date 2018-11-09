<template>
    <div class="page-list-dashboard">
        <el-breadcrumb separator="/">
            <el-breadcrumb-item :to="{ path: '/' }">Главная</el-breadcrumb-item>
            <el-breadcrumb-item>Дашборд</el-breadcrumb-item>
        </el-breadcrumb>

        <div id="result-chart" class="content-block"></div>
        <div id="result-chart1" class="content-block"></div>
    </div>
</template>

<script>
import c3 from 'c3'
import 'c3/c3.css'
export default {
  name: 'DashboardIndex',
  mounted () {
    c3.generate({
      bindto: '#result-chart',
      data: {
        columns: [
          ['Сайт1', 30000, 20000, 10000, 40000, 0, 0, 0, 0, 1111, 2000],
          ['Сайт2', 0, 0, 0, 0, 15000, 25000, 50000, 10000, 0, 0],
          ['Сайт3', 0, 0, 0, 0, 15000, 10000, 50000, 0, 0]
        ],
        order: false,
        type: 'line'
      },
      bar: {
        width: {
          ratio: 0.80
        }
      },
      axis: {
        x: {
          type: 'category',
          categories: ['Январь-2018', 'Февраль-2018', 'Март-2018', 'Апрель-2018', 'Май-2018', 'Июнь-2018', 'Июль-2018', 'Август-2018', 'Сентябрь-2018', 'Октябрь-2018'],
          tick: {
            rotate: 30,
            format: '%b%Y'
          }
        }
      },
      grid: {
        x: {
          lines: [
            {value: 8.9, text: 'АП Яндекс - 31.09.2019', position: 'end'},
            {value: 5.9, text: 'АП Яндекс - 31.06.2019', position: 'end'},
            {value: 3, text: 'Моя отметка', position: 'end'}
          ]
        }
      }
    })

    c3.generate({
      bindto: '#result-chart1',
      data: {
        columns: [
          ['Сайт1', 30000, 20000, 10000, 40000, 0, 0, 0, 0, 1111, 2000],
          ['Сайт2', 0, 0, 0, 0, 15000, 25000, 50000, 10000, 0, 0],
          ['Сайт3', 0, 0, 0, 0, 15000, 10000, 50000, 0, 0]
        ],
        order: false,
        type: 'pie'
      }
    })
  }
}
</script>
