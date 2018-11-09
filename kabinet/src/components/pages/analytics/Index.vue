<template>
  <div class="page-list-analytics">
    <el-breadcrumb separator="/">
      <el-breadcrumb-item :to="{ path: '/' }">Главная</el-breadcrumb-item>
      <el-breadcrumb-item>Аналитика</el-breadcrumb-item>
    </el-breadcrumb>
    <el-container v-if="getSitesList" class="mt-25">
      <el-aside style="width: 220px" class="menu">
        <el-table :data="getSitesList" stripe border>

          <el-table-column prop="url" label="Площадки" width="220">
            <template slot-scope="scope">
              <div @click="clickShowAnalytics(scope.row.id)" class="table-name">{{ scope.row.name }}</div>
              <div class="table-url">{{ scope.row.url }}</div>
            </template>
          </el-table-column>

        </el-table>
      </el-aside>
      <el-main class="content">
          {{info}}
      </el-main>
    </el-container>
    <div v-else class="content-block">
      Данных пока нету
    </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'
export default {
  name: 'AnalyticsIndex',
  data () {
    return {
      info: {}
    }
  },
  computed: {
    ...mapGetters(['getSitesList', 'getSitesById'])
  },
  methods: {
    clickShowAnalytics (id) {
      const site = this.getSitesById(id)
      this.info = site
    }
  }
}
</script>

<style lang="scss" scoped>
  .table-name {
    font-size: 16px;
    color: #555555;
    cursor: pointer;
  }

  .table-url {
    font-size: 12px;
    color: #8c939d;
  }
</style>
