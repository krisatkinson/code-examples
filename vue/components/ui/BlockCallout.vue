<template>
  <FullContainer class="block-callout text-white">
    <BoxContainer>
      <!--
        conditionally check each potential value for textAlign in order to ensure css is
        purgeable (remove unused classes), since `text-${textAlign}` does not get parsed
        during css purge to determine all possible values. hence, values must be specified
        as static strings
      -->
      <Column
        class="lg:flex"
        :class="{
          'text-center': textAlign === 'center',
          'text-left': textAlign === 'left',
          'text-right': textAlign === 'right'
        }"
      >
        <Column
          v-if="heading || $slots.default"
          :size="2"
          :cols="3"
          class="py-component px-component flex flex-col"
          :class="[{
            'justify-start': contentAlign === 'top',
            'justify-center': contentAlign === 'middle',
            'justify-end': contentAlign === 'bottom',
          }, contentBackgroundClass]"
        >
          <Heading v-if="heading" :level="headingLevel" class="font-bold mb-26">
            {{ heading }}
          </Heading>

          <Content v-if="$slots.default">
            <slot />
          </Content>
        </Column>

        <Column v-if="image" :size="1" :cols="3" class="image-column p-0">
          <nuxt-picture
            :src="image"
            fit="cover"
            :img-attrs="{
              class: 'w-full h-full object-cover',
              alt: heading ? heading : ''
            }"
          />
        </Column>
      </Column>
    </BoxContainer>
  </FullContainer>
</template>

<script>
export default {
  props: {
    heading: {
      type: String,
      required: false,
      default: null
    },
    image: {
      type: String,
      required: false,
      default: null
    },
    contentAlign: {
      type: String,
      required: false,
      default: 'top',
      validator: value => ['top', 'bottom', 'middle'].includes(value)
    },
    textAlign: {
      type: String,
      required: false,
      default: 'left',
      validator: value => ['center', 'left', 'right'].includes(value)
    },
    headingLevel: {
      type: Number,
      required: false,
      default: 3,
      validator: value => value >= 1 && value <= 6
    },
    contentLevel: {
      type: Number,
      required: false,
      default: 20,
      validator: value => value >= 1 && value <= 64
    },
    contentBackgroundClass: {
      type: String,
      required: false,
      default: 'bg-blue-300',
      validator: value => value.indexOf('bg-') === 0 && !value.includes(' ')
    }
  }
}
</script>
