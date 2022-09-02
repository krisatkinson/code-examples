<template>
  <div>
    <div
      v-if="hero"
      class="hero relative bg-black text-white mb-32 px-64 py-160"
    >
      <div class="absolute w-full h-full top-0 left-0 bg-black opacity-80"></div>

      <div class="relative hero-content">
        <editable-content
          tag="h1"
          class="text-36 mb-32"
          field="hero.content.heading"
          :value="heroHeading"
          @edit="edit"
        />
        <editable-content
          tag="p"
          class="opacity-75 mb-24"
          field="hero.content.excerpt"
          :value="heroExcerpt"
          @edit="edit"
        />

        <div>
          <editable-content
            tag="a"
            class="inline-block text-white bg-blue rounded-full py-8 px-24 mr-16"
            href="#"
            :value="heroGetStarted"
            @edit="edit"
          />
          <editable-content
            tag="a"
            class="inline-block text-white bg-orange rounded-full py-8 px-24"
            href="#"
            :value="heroLiveDemo"
            @edit="edit"
          />
        </div>
      </div>
    </div>

    <div
      v-if="section1"
      class="section-1 container mx-auto grid grid-cols-1 md:grid-cols-2 md:gap-32 mb-32"
    >
      <div class="flex flex-col items-center justify-center mb-32 md:mb-0">
        <div class="mb-32">
          <editable-content tag="h2" class="text-24 mb-12" :value="section1Heading" @edit="edit" />
          <editable-content tag="p" class="mb-16" :value="section1Excerpt" @edit="edit" />

          <editable-content
            tag="a"
            class="inline-block text-white bg-blue rounded-full py-8 px-24"
            href="#"
            :value="section1GetStarted"
            @edit="edit"
          />
        </div>

        <hr class="hidden md:block mb-0 md:mb-32 w-full">

        <div>
          <blockquote>
            &quot;<editable-content tag="span" :value="section1Quote" @edit="edit" />&quot;
          </blockquote>
          <strong>&mdash; <editable-content tag="span" :value="section1Quotee" @edit="edit" /></strong>
        </div>
      </div>

      <div class="">
        <img
          :src="section1Image.url"
          :alt="section1Image.alt"
          :title="section1Image.title"
          class="section-1-image"
        >
      </div>
    </div>

    <div
      v-if="section2"
      class="section-2 container mx-auto grid grid-cols-1 md:grid-cols-2 md:gap-32 mb-64"
    >
      <div class="mb-32 md:mb-0">
        <img
          :src="section2Image.url"
          :alt="section2Image.alt"
          :title="section2Image.title"
          class="section-2-image"
        >
      </div>

      <div class="flex flex-col items-center justify-center">
        <editable-content tag="h2" class="text-24 mb-12" :value="section2Heading" @edit="edit" />
        <editable-content tag="p" class="mb-16" :value="section2Excerpt" @edit="edit" />

        <editable-content
          tag="a"
          class="inline-block text-white bg-blue rounded-full py-8 px-24"
          href="#"
          :value="section2GetStarted"
          @edit="edit"
        />
      </div>
    </div>
  </div>
</template>

<script>
import ContentHandler from '@mixins/ContentHandler'
import EditablePage from '@mixins/EditablePage'

export default {
  name: 'Editor',
  mixins: [
    ContentHandler,
    EditablePage
  ],
  async asyncData() {
    try {
      const page = await this.getContent()

      return {
        page: page.data
      }
    } catch (error) {
      // @ToDo: update pending business logic to be provided
    }
  },
  data() {
    return {
      page: {},
    }
  },
  head() {
    return {
      title: this.seoTitle,
      meta: this.seoMeta
    }
  },
}
</script>
