<template>
  <BlogCategoriesTable :categories="categories" :loading="loading" />
</template>

<script setup lang="ts">
import { ref } from 'vue'
import BlogCategoriesTable from '@/components/BlogCategoriesTable.vue'

const categories = ref([]) 
const loading = ref(false)
</script>
