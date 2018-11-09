<template>
    <div class="error page-not-found">
        <div class="page-list-analytics">
            <el-breadcrumb separator="/">
                <el-breadcrumb-item :to="{ path: '/' }">Главная</el-breadcrumb-item>
                <el-breadcrumb-item>Ошибка</el-breadcrumb-item>
            </el-breadcrumb>
        </div>
        <h1>Страница не найдена!</h1>
    </div>
</template>

<script>
export default {
  name: 'NotFound'
}
</script>

<style scoped>

</style>
