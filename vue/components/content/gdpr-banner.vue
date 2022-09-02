<i18n lang="yaml">
en:
  message: "..."
  ok: OK
fr:
  message: "..."
  ok: OK
</i18n>

<template>
  <FullContainer v-if="visible" class="fixed bottom-0 left-0 bg-black text-white">
    <BoxContainer>
      <div class="w-full lg:w-2/3 fr:w-4/5 mx-auto">
        <BoxContainer class="px-0">
          <Column
            :size="4"
            :cols="5"
            :sm-size="4"
            :sm-cols="5"
            class="pr-0 py-8"
          >
            {{ $t('message') }}
          </Column>

          <Column :size="1" :cols="5" :sm-size="1" :sm-cols="5" class="flex items-center justify-center">
            <button
              class="inline-block py-6 px-18 rounded-full text-center text-18 bg-blue-500 text-white hover:bg-blue-400"
              @click="acknowledge"
            >
              {{ $t('ok') }}
            </button>
          </Column>
        </BoxContainer>
      </div>
    </BoxContainer>
  </FullContainer>
</template>

<script>
export default {
  data () {
    return {
      visible: false
    }
  },
  mounted () {
    this.visible = localStorage.getItem('gdpr-acknowledged') !== 'yes'
  },
  methods: {
    acknowledge () {
      localStorage.setItem('gdpr-acknowledged', 'yes')

      this.visible = false
    }
  }
}
</script>
