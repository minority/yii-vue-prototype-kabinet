<template>
    <div class="page-edit-site">
        <el-breadcrumb separator="/">
            <el-breadcrumb-item :to="{ path: '/' }">Главная</el-breadcrumb-item>
            <el-breadcrumb-item :to="{ name: 'SitesIndex' }">Сайты</el-breadcrumb-item>
            <el-breadcrumb-item>Редактировать площадку</el-breadcrumb-item>
        </el-breadcrumb>

        <el-row :gutter="20">
            <el-col :span="12" :xs="24" :sm="20" :md="16" :lg="12" :xl="12">
                <div class="content-block">
                    <el-form class="mt-25" :rules="rules" ref="updateForm" label-position="left" label-width="190px" :model="formData">
                        <el-form-item label="Краткое наименование" prop="name">
                            <el-input placeholder="Мой блог про домашних животных" v-model="formData.name"></el-input>
                        </el-form-item>

                        <el-form-item label="Контекстная реклама">
                            <el-select
                                    style="width: 100%"
                                    v-model="formData.context"
                                    multiple
                                    filterable
                                    reserve-keyword
                                    placeholder="Выберите партнерки">
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
                                    placeholder="Выберите партнерки">
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
                                    placeholder="Выберите партнерки">
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
                                    placeholder="Выберите партнерки">
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
                                    placeholder="Выберите партнерки">
                                <el-option
                                        v-for="(name, key) in getIncomeDictionaryData.other"
                                        :key="key"
                                        :label="name"
                                        :value="key">
                                </el-option>
                            </el-select>
                        </el-form-item>

                        <el-form-item label="Расходы">
                            <el-select
                                    style="width: 100%"
                                    v-model="formData.cost"
                                    multiple
                                    filterable
                                    reserve-keyword
                                    placeholder="Выберите партнерки">
                                <el-option
                                        v-for="(name, key) in getIncomeDictionaryData.cost"
                                        :key="key"
                                        :label="name"
                                        :value="key">
                                </el-option>
                            </el-select>
                        </el-form-item>
                    </el-form>

                    <el-row class="mt-50" :gutter="20">
                        <el-col :span="24">
                            <el-button class="right" type="success" @click="save">Сохранить</el-button>
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
import { mapGetters } from 'vuex'
export default {
  name: 'EditSite',
  mixins: [loadingIncomeFilter],
  props: ['id'],
  data () {
    return {
      formData: {
        id: '',
        name: '',
        context: [],
        teaser: [],
        cpa: [],
        links: [],
        other: [],
        cost: []
      },
      rules: {
        name: [
          {required: true, message: 'Поле обязательно для заполнения', trigger: 'blur'},
          {min: 3, max: 150, message: 'Длина поля от 3 до 150 символов', trigger: 'blur'}
        ]
      }
    }
  },
  computed: {
    ...mapGetters(['getSitesById', 'isLoading'])
  },
  methods: {
    save () {
      this.$refs['updateForm'].validate((valid) => {
        if (valid) {
          const response = this.$store.dispatch('updateSite', this.formData)
          response.then(data => {
            if (data.status) {
              this.$router.push({name: 'SitesIndex'})
            } else {
              this.showMessage('Ошибка отправки формы', data.msg)
            }
          })
        } else {
          return false
        }
      })
    },
    showMessage (title, content) {
      this.$alert(content, title, {
        confirmButtonText: 'Ок'
      })
    },
    loadForm () {
      const site = this.getSitesById(this.id)

      if (site) {
        this.formData = {
          id: '',
          name: '',
          context: [],
          teaser: [],
          cpa: [],
          links: [],
          other: [],
          cost: []
        }
        this.formData.id = this.id
        this.formData.name = site.name
        const siteIncomeIndicators = site.siteIncomeIndicators

        if (siteIncomeIndicators) {
          for (let item of siteIncomeIndicators) {
            this.formData[item.type].push(item.value.toString())
          }
        }
      } else {
        this.$router.push({name: 'SitesIndex'})
      }
    }
  },
  watch: {
    isLoading: function (val) {
      if (!val) {
        this.loadForm()
      }
    }
  },
  mounted () {
    if (!this.isLoading) {
      this.loadForm()
    }
  }
}
</script>
