<template>
  <div v-if="post">
    <h1 class="text-xl font-bold mb-2">{{ post.title }}</h1>
    <p class="text-sm text-gray-500">{{ post.published_at }}</p>
    <p class="my-4">{{ post.description }}</p>
    <p class="text-sm text-gray-700">Автор: {{ post.user.name }}</p>
    <p class="text-sm text-gray-700">Категорія: {{ post.category.title }}</p>
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue'
import { useRoute } from 'vue-router'

interface Post {
  id: number
  title: string
  description: string
  published_at: string
  user: {
    name: string
  }
  category: {
    title: string
  }
}

const post = ref<Post | null>(null)

const route = useRoute()

const getPost = async () => {
  try {
    const response = await $fetch<{ data: Post }>(
      `http://localhost/api/blog/posts/${route.params.id}`
    )
    post.value = response.data
  } catch (error) {
    console.error('Помилка при отриманні поста:', error)
  }
}

onMounted(getPost)
</script>
