<template>
    <el-row :gutter="20">
        <el-col :span="8" :offset="8">

            <el-form ref="form" :model="form" label-width="120px">
                <el-form-item label="E-mail">
                    <el-input type="email" v-model="form.email"></el-input>
                </el-form-item>
                <el-form-item label="Пароль">
                    <el-input type="password" v-model="form.password"></el-input>
                </el-form-item>
            </el-form>
        </el-col>
    </el-row>
</template>

<script>
export default {
  name: 'Auth',
  data () {
    return {
      form: {
        email: '',
        password: ''
      }
    }
  }
}
</script>

<style scoped>

</style>
