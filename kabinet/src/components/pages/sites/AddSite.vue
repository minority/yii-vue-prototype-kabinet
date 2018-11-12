<template>
    <div class="page-add-site">
        <el-breadcrumb separator="/">
            <el-breadcrumb-item :to="{ path: '/' }">Главная</el-breadcrumb-item>
            <el-breadcrumb-item :to="{ name: 'SitesIndex' }">Сайты</el-breadcrumb-item>
            <el-breadcrumb-item>Добавить площадку</el-breadcrumb-item>
        </el-breadcrumb>

        <el-row :gutter="20">
            <el-col :span="12" :xs="24" :sm="20" :md="16" :lg="12" :xl="12">
                <div class="content-block">
                    <el-steps :active="active" finish-status="success">
                        <el-step title="Данные площадки"></el-step>
                        <el-step title="Данные доходов"></el-step>
                        <el-step title="Данные расходов"></el-step>
                    </el-steps>

                    <el-form class="mt-50" :rules="rules" ref="addForm" label-position="left" label-width="190px" :model="formData">
                        <div v-show="active === 0" class="content-block">
                            <el-form-item label="Адрес сайта" prop="url">
                                <el-input placeholder="http://mysite.ru" v-model="formData.url"></el-input>
                            </el-form-item>
                            <el-form-item label="Краткое наименование" prop="name">
                                <el-input placeholder="Блог про домашних животных" v-model="formData.name"></el-input>
                            </el-form-item>
                        </div>

                        <div v-show="active === 1" class="content-block">
                            <el-form-item label="Контекстная реклама">
                                <el-select
                                        style="width: 100%"
                                        v-model="formData.context"
                                        multiple
                                        filterable
                                        reserve-keyword
                                        placeholder="Выберите партнерки"
                                        :loading="filterLoading">
                                    <el-option
                                            v-for="(name, key) in getIncomeDictionaryData.context"
                                            :key="key"
                                            :label="name"
                                            :value="key">
                                    </el-option>
                                </el-select>
                            </el-form-item>
                            <el-form-item label="Тизерные сети">
                                <el-select
                                        style="width: 100%"
                                        v-model="formData.teaser"
                                        multiple
                                        filterable
                                        reserve-keyword
                                        placeholder="Выберите партнерки"
                                        :loading="filterLoading">
                                    <el-option
                                            v-for="(name, key) in getIncomeDictionaryData.teaser"
                                            :key="key"
                                            :label="name"
                                            :value="key">
                                    </el-option>
                                </el-select>
                            </el-form-item>

                            <el-form-item label="CPA партнерки">
                                <el-select
                                        style="width: 100%"
                                        v-model="formData.cpa"
                                        multiple
                                        filterable
                                        reserve-keyword
                                        placeholder="Выберите партнерки"
                                        :loading="filterLoading">
                                    <el-option
                                            v-for="(name, key) in getIncomeDictionaryData.cpa"
                                            :key="key"
                                            :label="name"
                                            :value="key">
                                    </el-option>
                                </el-select>
                            </el-form-item>

                            <el-form-item label="Продажа ссылок">
                                <el-select
                                        style="width: 100%"
                                        v-model="formData.links"
                                        multiple
                                        filterable
                                        reserve-keyword
                                        placeholder="Выберите партнерки"
                                        :loading="filterLoading">
                                    <el-option
                                            v-for="(name, key) in getIncomeDictionaryData.links"
                                            :key="key"
                                            :label="name"
                                            :value="key">
                                    </el-option>
                                </el-select>
                            </el-form-item>

                            <el-form-item label="Другие источники">
                                <el-select
                                        style="width: 100%"
                                        v-model="formData.other"
                                        multiple
                                        filterable
                                        reserve-keyword
                                        placeholder="Выберите партнерки"
                                        :loading="filterLoading">
                                    <el-option
                                            v-for="(name, key) in getIncomeDictionaryData.other"
                                            :key="key"
                                            :label="name"
                                            :value="key">
                                    </el-option>
                                </el-select>
                            </el-form-item>

                        </div>

                        <div v-show="active === 2" class="content-block">
                            <el-form-item label="Расходы">
                                <el-select
                                        style="width: 100%"
                                        v-model="formData.cost"
                                        multiple
                                        filterable
                                        reserve-keyword
                                        placeholder="Выберите партнерки"
                                        :loading="filterLoading">
                                    <el-option
                                            v-for="(name, key) in getIncomeDictionaryData.cost"
                                            :key="key"
                                            :label="name"
                                            :value="key">
                                    </el-option>
                                </el-select>
                            </el-form-item>
                        </div>

                        <div v-show="active === successStep" class="content-block el-alert--success success-block">
                            <div>Площадка успешно создана!</div>
                        </div>
                    </el-form>

                    <el-row class="mt-50" type="flex" :gutter="20">
                        <el-col :span="12">
                            <el-button v-show="active > 0 && active !== successStep" @click="prev">Предыдущий шаг</el-button>
                        </el-col>
                        <el-col :span="12" style="text-align: right">
                            <el-button v-show="active < countStep" type="primary" @click="next">Следующий шаг</el-button>
                            <el-button v-show="countStep === active" type="success" @click="save">Сохранить</el-button>
                            <el-button v-show="successStep === active" type="primary" @click="back">На страницу списка сайтов</el-button>
                        </el-col>
                    </el-row>
                </div>
            </el-col>
            <el-col :span="12" :xs="24" :sm="20" :md="16" :lg="12" :xl="12"></el-col>
        </el-row>
    </div>
</template>

<script>
import loadingIncomeFilter from '../../mixin/loadingIncomeFilter'
export default {
  name: 'AddSite',
  mixins: [loadingIncomeFilter],
  data () {
    return {
      active: 0,
      countStep: 2,
      successStep: 3,
      filterLoading: false,
      formData: {
        url: '',
        name: '',
        context: [],
        teaser: [],
        cpa: [],
        links: [],
        other: [],
        cost: []
      },
      rules: {
        url: [
          {required: true, message: 'Поле обязательно для заполнения', trigger: 'blur'},
          {min: 3, max: 50, message: 'Длина поля от 3 до 50 символов', trigger: 'blur'},
          {type: 'url', message: 'Некорректный адрес сайта', trigger: 'blur'}
        ],
        name: [
          {required: true, message: 'Поле обязательно для заполнения', trigger: 'blur'},
          {min: 3, max: 150, message: 'Длина поля от 3 до 150 символов', trigger: 'blur'}
        ]
      }
    }
  },
  methods: {
    next () {
      this.$refs['addForm'].validate((valid) => {
        if (valid) {
          if (this.active++ > 2) this.active = 0
        } else {
          return false
        }
      })
    },
    prev () {
      if (this.active-- < 0) this.active = 0
    },
    save () {
      this.$refs['addForm'].validate((valid) => {
        if (valid) {
          const result = this.$store.dispatch('createSite', this.formData)
          result.then(data => {
            if (data.status) {
              if (data.item) {
                this.$store.commit('addSite', data.item)
              }
              this.active++
            } else {
              this.showMessage('Ошибка отправки формы', data.msg)
            }
          })
        } else {
          return false
        }
      })
    },
    back () {
      this.$router.push({name: 'SitesIndex'})
    },
    showMessage (title, content) {
      this.$alert(content, title, {
        confirmButtonText: 'Ок'
      })
    }
  },
  watch: {
    isLoading: function (val) {
      this.filterLoading = val
    }
  }
}
</script>
