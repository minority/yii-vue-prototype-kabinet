<template>
<el-aside width="auto" class="aside-menu">
    <el-menu
            class="el-menu-vertical"
            :collapse="isCollapse"
            :router="true"
            background-color="#545c64"
            text-color="#fff"
            active-text-color="#409EFF">
        <el-menu-item :route="{name:'DashboardIndex'}" index="1">
            <i class="el-icon-menu"></i>
            <span>Дашборд</span>
        </el-menu-item>
        <el-menu-item :route="{name:'AnalyticsIndex'}" index="3">
            <i class="el-icon-picture-outline"></i>
            <span>Аналитика</span>
        </el-menu-item>
        <el-menu-item :route="{name:'SitesIndex'}" index="2">
            <i class="el-icon-document"></i>
            <span>Сайты</span>
        </el-menu-item>
        <el-menu-item :route="{name:'FaqIndex'}" index="4">
            <i class="el-icon-question"></i>
            <span>FAQ</span>
        </el-menu-item>
        <li class="el-menu-item collapse-toggle-button" @click="isCollapse = !isCollapse">
            <i :class="isCollapse ? 'el-icon-caret-right' : 'el-icon-caret-left'"></i>
            <span>{{isCollapse ? '' : 'Скрыть меню'}}</span>
        </li>
    </el-menu>
</el-aside>
</template>

<script>
export default {
  name: 'Sidebar',
  data () {
    return {
      isCollapse: false
    }
  }
}
</script>

<style lang="scss" scoped>
.el-menu-vertical:not(.el-menu--collapse) {
  width: 180px;
  height: 100%;
}

.el-menu-vertical {
  height: 100%;
}

.el-menu {
  border: 0;
  background: none;
}

.aside-menu {
  height: 100%;
  background-color: #545c64;
  overflow: hidden;
}

.aside-menu a {
  color: #ffffff;
}

.aside-menu .is-active a {
  color: #409EFF;
}

.collapse-toggle-button {
    position: absolute;
    bottom: 0;
    padding-left: 15px;
    color: rgb(255, 255, 255);
    background-color: #545c64 !important;
}
</style>
