import { mapActions, mapGetters } from 'vuex'

export default {
  computed: {
    ...mapGetters(['getIncomeDictionaryData'])
  },
  methods: {
    ...mapActions(['fetchIncomeDictionaryData'])
  },
  async created () {
    if (Object.keys(this.getIncomeDictionaryData).length === 0) {
      await this.fetchIncomeDictionaryData()
    }
  }
}
