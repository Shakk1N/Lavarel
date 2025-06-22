<template>
  <UTable
    :columns="columns"
    :rows="paginatedPosts"
    :loading="loading"
    :pagination="{ page, pageSize, total }"
    @update:page="page = $event"
  />
</template>

<script setup lang="ts">
import { ref, computed, onMounted } from 'vue'

interface Post {
  id: number
  title: string
  published_at: string
  user: { name: string }
  category: { title: string }
}

interface ApiResponse {
  data: Post[]
}

const posts = ref<Post[]>([])
const loading = ref(true)

const page = ref(1)
const pageSize = 10

const total = computed(() => posts.value.length)
const paginatedPosts = computed(() =>
  posts.value.slice((page.value - 1) * pageSize, page.value * pageSize)
)

const columns = [
  { key: 'id', label: '#' },
  { key: 'user.name', label: 'Автор' },
  { key: 'category.title', label: 'Категорія' },
  { key: 'title', label: 'Заголовок' },
  { key: 'published_at', label: 'Дата' },
]

const getPosts = async () => {
  loading.value = true
  const response = await $fetch<ApiResponse>('http://localhost:8000/api/blog/posts')
  posts.value = response.data
  loading.value = false
}

onMounted(getPosts)

</script>
