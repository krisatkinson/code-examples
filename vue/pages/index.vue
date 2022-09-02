<i18n lang="yaml">
  en:
    meta:
      title: "..."
      image: "..."
    hero:
      heading: "..."
    callout_1:
      heading: "..."
      image: "..."
      link_label: "..."
      content: "..."
    callout_2:
      heading: "..."
      image: "..."
      link_label: "..."
      content: "..."
  
  fr:
    meta:
        title: "..."
        image: "..."
    hero:
      heading: "..."
    callout_1:
      heading: "..."
      image: "..."
      link_label: "..."
      content: "..."
    callout_2:
      heading: "..."
      image: "..."
      link_label: "..."
      content: "..."
  </i18n>
  
  <template>
    <FullContainer class="mb-18">
      <FullContainer class="px-0 min-h-244 lg:min-h-none relative z-0 overflow-hidden lg:overflow-none">
        <nuxt-picture
          preload
          src="~/static/images/landing/banner.png"
          :img-attrs="{ class: 'w-auto lg:w-full max-w-none min-h-244 lg:min-h-none', alt: '' }"
        />
  
        <FullContainer class="absolute top-0 left-0 h-full flex items-center">
          <BoxContainer>
            <Column :size="10" :cols="12" class="relative">
              <Heading :level="1" class="font-medium text-left text-primary mt-128 lg:mt-0">
                {{ $t('hero.heading') }}
              </Heading>
            </Column>
          </BoxContainer>
        </FullContainer>
      </FullContainer>
  
      <BoxContainer class="lg:-mt-90 relative z-2 lg:mb-46">
        <Column :size="1" :cols="2" class="mb-16 lg:mb-0">
          <CalloutCard
            :heading="$t('callout_1.heading')"
            :image="$t('callout_1.image')"
            :link="localePath('/product-page-1')"
            :link-label="$t('callout_1.link_label')"
            button-width="w-1/2 fr:w-full"
            class="h-full"
          >
            {{ $t('callout_1.content') }}
          </CalloutCard>
        </Column>
  
        <Column :size="1" :cols="2">
          <CalloutCard
            :heading="$t('callout_2.heading')"
            :image="$t('callout_2.image')"
            :link="localePath('/product-page-2')"
            :link-label="$t('callout_2.link_label')"
            button-width="w-1/2 fr:w-full"
            class="h-full"
          >
            {{ $t('callout_2.content') }}
          </CalloutCard>
        </Column>
      </BoxContainer>
    </FullContainer>
  </template>
  
  <script>
  export default {
    layout: 'landing',
    head () {
      return {
        title: this.$t('meta.title'),
        meta: [
          {
            hid: 'description',
            name: 'description',
            content: this.$t('hero.heading')
          },
          {
            hid: 'og:title',
            property: 'og:title',
            content: this.$t('meta.title')
          },
          {
            hid: 'og:description',
            property: 'og:description',
            content: this.$t('hero.heading')
          },
          {
            hid: 'og:type',
            property: 'og:type',
            content: 'website'
          },
          {
            hid: 'og:url',
            property: 'og:url',
            content: this.$currentUrl
          },
          {
            hid: 'og:image',
            property: 'og:image',
            content: this.$t('meta.image')
          },
          {
            hid: 'twitter:title',
            name: 'twitter:title',
            content: this.$t('meta.title')
          },
          {
            hid: 'twitter:description',
            name: 'twitter:description',
            content: this.$t('hero.heading')
          },
          {
            hid: 'twitter:image',
            name: 'twitter:image',
            content: this.$t('meta.image')
          },
          {
            hid: 'twitter:card',
            name: 'twitter:card',
            content: 'summary_large_image'
          }
        ]
      }
    }
  }
  </script>
  