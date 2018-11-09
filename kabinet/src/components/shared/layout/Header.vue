<template>
    <el-header>
        <img src="./../../../assets/logo.svg" alt="seostat.online" class="logo">

        <div class="right-menu">
            <el-menu
                    class="el-menu"
                    mode="horizontal"
                    text-color="#303133"
                    active-text-color="#409EFF">

                <el-submenu index="1">
                    <template slot="title">email@email.ru</template>
                    <el-menu-item index="1-1">Профиль</el-menu-item>
                    <el-menu-item index="1-2">Выход</el-menu-item>
                </el-submenu>
            </el-menu>
        </div>
    </el-header>
</template>

<script>
export default {
  name: 'Header'
}
</script>

<style lang="scss" scoped>
    .logo {
        display: inline-block;
        vertical-align: middle;
        margin: 10px;
    }

    .right-menu {
        float: right;
        height: 100%;
    }

    .el-header {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-pack: justify;
        -ms-flex-pack: justify;
        justify-content: space-between;
        -webkit-box-shadow: 0 0 5px 0 rgba(0, 0, 0, 0.22);
        box-shadow: 0 0 5px 0 rgba(0, 0, 0, 0.22);
    }
</style>
