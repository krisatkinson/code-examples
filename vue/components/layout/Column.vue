<template>
  <div class="column" :class="classes">
    <slot />
  </div>
</template>

<script>
export default {
  props: {
    size: {
      type: Number,
      required: false,
      default: null,
      validator: value => value >= 1 && value <= 11
    },
    cols: {
      type: Number,
      required: false,
      default: null,
      validator: value => [2, 3, 4, 6, 8, 12].indexOf(value !== -1)
    },
    gutter: {
      type: String,
      required: false,
      default: 'lg:px-gutter'
    },
    mdSize: {
      type: Number,
      required: false,
      default: null,
      validator: value => value >= 1 && value <= 11
    },
    mdCols: {
      type: Number,
      required: false,
      default: null,
      validator: value => [2, 3, 4, 6, 8, 12].indexOf(value !== -1)
    },
    smSize: {
      type: Number,
      required: false,
      default: null,
      validator: value => value >= 1 && value <= 11
    },
    smCols: {
      type: Number,
      required: false,
      default: null,
      validator: value => [2, 3, 4, 6, 8, 12].indexOf(value !== -1)
    },
    smGutter: {
      type: String,
      required: false,
      default: 'px-gutter'
    }
  },
  computed: {
    classes () {
      return [this.smGutter, this.gutter, this.widthClass, this.mdWidthClass, this.smWidthClass]
    },
    widthClass () {
      if (this.size && this.cols) {
        return `lg:w-${this.size}/${this.cols}`
      }

      return ''
    },
    mdWidthClass () {
      if (this.mdSize && this.mdCols) {
        return `md:w-${this.mdSize}/${this.mdCols}`
      } else if (this.size && this.mdCols) {
        return `md:w-${this.size}/${this.mdCols}`
      } else if (this.mdSize && this.cols) {
        return `md:w-${this.mdSize}/${this.cols}`
      }

      return ''
    },
    smWidthClass () {
      if (this.smSize && this.smCols) {
        return `w-${this.smSize}/${this.smCols}`
      } else if (this.size && this.smCols) {
        return `w-${this.size}/${this.smCols}`
      } else if (this.smSize && this.cols) {
        return `w-${this.smSize}/${this.cols}`
      }

      return 'w-full'
    }
  }
}
</script>
