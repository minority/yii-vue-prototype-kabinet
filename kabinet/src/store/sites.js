import api from '../library/api'

export default {
  state: {
    sites: []
  },
  getters: {
    getSitesList (state) {
      return state.sites
    },
    getSitesById (state) {
      return id => {
        return state.sites.find(site => site.id === id)
      }
    }
  },
  actions: {
    async fetchSites ({commit}) {
      commit('setLoading', true)

      try {
        const data = await api(
          'get',
          'v1/site/index?expand=siteIncomeIndicators'
        )

        if (data.items) {
          commit('setSites', data.items)
        }

        commit('setLoading', false)
      } catch (e) {
        commit('setError', 'Произошла ошибка загрузки данных фильтров, попробуйте позже или обратитесь к администратору системы')
        commit('setLoading', false)
      }
    },

    async createSite ({commit}, payload) {
      commit('setLoading', true)

      try {
        const data = await api('post', 'v1/site/create', payload)
        commit('setLoading', false)

        return data
      } catch (e) {
        commit('setError', 'Произошла ошибка отправки данных, попробуйте позже или обратитесь к администратору системы')
        commit('setLoading', false)
      }
    },

    async updateSite ({commit}, payload) {
      commit('setLoading', true)

      try {
        const data = await api('post', 'v1/site/update', payload)
        commit('setLoading', false)

        return data
      } catch (e) {
        commit('setError', 'Произошла ошибка отправки данных, попробуйте позже или обратитесь к администратору системы')
        commit('setLoading', false)
      }
    },

    async deleteSite ({commit}, payload) {
      commit('setLoading', true)

      try {
        const data = await api('post', 'v1/site/delete?id=' + payload.id)
        commit('setLoading', false)

        if (data.status) {
          commit('deleteSite', payload.id)
          commit('setNotify', 'Запись удалена')
        } else {
          commit('setError', 'Произошла ошибка удаления')
        }

        return data
      } catch (e) {
        commit('setError', 'Произошла ошибка удаления данных, попробуйте позже или обратитесь к администратору системы')
        commit('setLoading', false)
      }
    }
  },
  mutations: {
    setSites (state, payload) {
      state.sites = payload
    },
    addSite (state, payload) {
      state.sites.push(payload)
    },
    updateSite (state, payload) {
      let item = state.sites.find(site => Number(site.id) === Number(payload.id))

      item.name = payload.name
      item.siteIncomeIndicators = payload.siteIncomeIndicators
    },
    deleteSite (state, payload) {
      let index = state.sites.findIndex(site => Number(site.id) === Number(payload))
      state.sites.splice(index, 1)
    }
  }
}
