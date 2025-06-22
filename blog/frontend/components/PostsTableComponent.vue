<template>
  <div class="container">
    <div class="flex justify-center">
      <div class="w-full">
        <nav class="navbar bg-gray-100 mb-4">
          <a href="/admin/blog/posts/create" class="btn">Додати</a>
        </nav>
        <div class="card">
          <div class="card-body">
            <table class="table table-auto w-full">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Автор</th>
                  <th>Категорія</th>
                  <th>Заголовок</th>
                  <th>Дата публікації</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="post in posts" :key="post.id">
                  <td>{{ post.id }}</td>
                  <td>{{ post.user.name }}</td>
                  <td>{{ post.category.title }}</td>
                  <td>
                    <a :href="`/admin/blog/posts/${post.id}/edit`">{{ post.title }}</a>
                  </td>
                  <td>{{ post.published_at }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue'

interface User {
  name: string;
}

interface Category {
  title: string;
}

interface Post {
  id: number;
  user: User;
  category: Category;
  title: string;
  published_at: string;
}

const posts = ref<Post[]>([])

const getPosts = async () => {
  const res = await fetch('http://localhost:8000/api/blog/posts')
  const response = await res.json()
  posts.value = response.data
}

onMounted(getPosts)

</script>
