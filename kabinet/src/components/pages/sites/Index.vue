<template>
  <div class="page-list-sites">
    <el-breadcrumb separator="/">
      <el-breadcrumb-item :to="{ path: '/' }">Главная</el-breadcrumb-item>
      <el-breadcrumb-item>Сайты</el-breadcrumb-item>
    </el-breadcrumb>

    <el-button class="mt-25" @click="clickAddSite" type="primary">Добавить площадку</el-button>

    <el-table :data="getSitesList" class="table" stripe border>

      <el-table-column prop="url" label="Сайт" min-width="200">
          <template slot-scope="scope">
              <div @click="clickEditSite(scope.row.id)" class="table-name">{{ scope.row.name }}</div>
              <div class="table-url">{{ scope.row.url }}</div>
          </template>
      </el-table-column>

      <el-table-column align="center" label="Автоматизация учета">
        <el-table-column align="center" label="Я.Метрика" width="130">
          <template slot-scope="scope">
            <el-button
                    type="text"
                    size="small">
              Подключить
            </el-button>
          </template>
        </el-table-column>
        <el-table-column align="center" label="KPI SEO" width="130">
          <template slot-scope="scope">
            <el-button
                    type="text"
                    size="small">
              Подключить
            </el-button>
          </template>
        </el-table-column>
        <el-table-column align="center" label="РСЯ" width="130">
          <template slot-scope="scope">
            <el-button
                    type="text"
                    size="small">
              Подключить
            </el-button>
          </template>
        </el-table-column>
        <el-table-column align="center" label="Adsense" width="130">
          <template slot-scope="scope">
            <el-button
                    type="text"
                    size="small">
              Подключить
            </el-button>
          </template>
        </el-table-column>
      </el-table-column>

      <el-table-column label="Операции" width="250" align="center">
        <template slot-scope="scope">
          <el-button @click="clickEditSite(scope.row.id)" size="mini">Редактировать</el-button>
          <el-button size="mini" @click="clickDeleteSite(scope.$index, getSitesList, scope.row.id)" type="danger">Удалить</el-button>
        </template>
      </el-table-column>
    </el-table>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'
export default {
  name: 'SitesIndex',
  data () {
    return {
      tableData: []
    }
  },
  computed: {
    ...mapGetters(['getSitesList'])
  },
  methods: {
    clickAddSite () {
      this.$router.push({name: 'AddSite'})
    },
    clickEditSite (id) {
      this.$router.push({name: 'EditSite', params: {id: id}})
    },
    clickDeleteSite (index, rows, id) {
      this.$confirm('Вы действительно хотите удалить площадку?', 'Подтверждение', {
        confirmButtonText: 'Удалить',
        cancelButtonText: 'Отмена',
        type: 'warning',
        confirmButtonClass: 'el-button--danger'
      }).then(() => {
        this.$store.dispatch('deleteSite', {id: id})
      })
        .catch(() => {})
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
