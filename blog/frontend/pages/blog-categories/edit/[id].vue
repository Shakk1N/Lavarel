<template>
  <BlogCategoryForm :id="Number(route.params.id)" />
</template>

<script setup lang="ts">
import BlogCategoryForm from '~/components/BlogCategoryForm.vue'
import { useRoute } from 'vue-router'

const route = useRoute()
</script>
