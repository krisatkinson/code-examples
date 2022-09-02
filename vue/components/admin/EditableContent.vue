<template>
  <component
    :is="tag"
    ref="editable"
    :class="{
      'editable': editing,
      'edited': edited,
    }"
    :contenteditable="contentEditable"
    @keyup="isEdited"
  >
    {{ value }}
  </component>
</template>

<script>
export default {
  name: 'EditableContent',
  props: {
    tag: {
      type: String,
      required: false,
      default: 'div',
    },
    field: {
      type: String,
      required: false,
      default: null,
    },
    value: {
      type: String,
      required: false,
      default: null,
    },
  },
  data() {
    return {
      edited: false,
    }
  },
  computed: {
    contentEditable() {
      return this.editing ? 'plaintext-only' : undefined
    },
    editing() {
      return !!this.$route.params.edit // if true, user is on edit page
    },
    fieldArray() {
      return typeof this.field === 'string' ? this.field.split('.') : null
    },
  },
  methods: {
    isEdited() {
      this.edited = this.$refs.editable.innerText !== this.value
      let value = this.edited ? this.$refs.editable.innerText : undefined

      if (this.fieldArray) {
        value = this.convertArrayToObject(this.fieldArray, value)
      }

      this.$emit('edit', value)
    },
    convertArrayToObject(fields, value) {
      return fields.reduceRight((all, item) => ({[item]: all}), value)
    },
  },
}
</script>

<style scoped>
[contenteditable] {
  @apply cursor-pointer;

  transition: 0.2s box-shadow linear;
  will-change: outline, box-shadow;

  box-shadow: 0 0 1px 3px rgba(127.5, 127.5, 127.5, 0.5);
  outline: none !important;
}

[contenteditable]:hover,
[contenteditable]:focus {
  box-shadow: 0 0 1px 3px rgba(127.5, 127.5, 127.5, 1);
}

[contenteditable].edited {
  box-shadow: 0 0 1px 3px rgba(0.5, 127.5, 64.5, 1);
}
</style>