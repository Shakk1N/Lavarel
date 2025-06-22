<template>
  <div>
    <h1>Категорії блогу</h1>
    <BlogCategoriesTable
      :categories="categories"
      :loading="loading"
      @edit="onEdit"
      @delete="onDelete"
    />
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import BlogCategoriesTable from '~/components/BlogCategoriesTable.vue'

interface Category {
  id: number
  title: string
  slug: string
  description?: string
  parent_id: number | null  
}

const categories = ref<Category[]>([])
const loading = ref(false)
const router = useRouter()

async function fetchCategories() {
  loading.value = true
  try {
    const res = await $fetch<{ data: Category[] }>('/api/blog/categories')
    categories.value = res.data.map(cat => ({
      ...cat,
      parent_id: cat.parent_id ?? null 
    }))
  } catch (error) {
    console.error('Помилка завантаження категорій:', error)
  } finally {
    loading.value = false
  }
}

onMounted(fetchCategories)

function onEdit(category: Category) {
  router.push(`/blog-categories/edit/${category.id}`)
}

async function onDelete(id: number) {
  if (!confirm('Ви впевнені, що хочете видалити категорію?')) return
  try {
    await $fetch(`/api/blog/categories/${id}`, { method: 'DELETE' })
    await fetchCategories()
  } catch (error) {
    console.error('Помилка видалення категорії:', error)
  }
}
</script>
