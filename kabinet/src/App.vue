<template>
    <el-container v-loading="isLoading" class="wrapper is-vertical">
        <Header></Header>

        <el-container class="wrapper">
            <Sidebar></Sidebar>

            <el-main class="content">
                <router-view/>
            </el-main>
        </el-container>
    </el-container>
</template>

<script>
import Sidebar from './components/shared/layout/Sidebar'
import Header from './components/shared/layout/Header'
import { mapGetters } from 'vuex'
export default {
  name: 'App',
  components: {
    Sidebar,
    Header
  },
  computed: {
    ...mapGetters(['isLoading', 'isError', 'getError', 'getNotify', 'isNotify'])
  },
  watch: {
    isError: function (val) {
      if (val) {
        this.$notify.error({
          title: 'Ошибка!',
          message: this.getError,
          showClose: true,
          duration: 10000
        })
      }

      this.$store.commit('clearError', null)
    },
    isNotify: function (val) {
      if (val) {
        this.$notify.success({
          title: 'Оповещение',
          message: this.getNotify,
          showClose: true,
          duration: 5000
        })

        this.$store.commit('clearNotify', null)
      }
    }
  }
}
</script>
