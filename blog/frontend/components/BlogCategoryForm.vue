<template>
  <UCard>
    <UForm :state="form" :schema="schema" @submit="onSubmit">
      <UFormGroup label="Назва" name="title">
        <UInput v-model="form.title" placeholder="Введіть назву категорії" />
      </UFormGroup>

      <UFormGroup label="Slug" name="slug">
        <UInput v-model="form.slug" placeholder="my-category" />
      </UFormGroup>

      <UFormGroup label="Опис" name="description">
        <UInput v-model="form.description" placeholder="Короткий опис" />
      </UFormGroup>

      <UButton type="submit" class="mt-4" :loading="submitting">
        {{ props.id ? 'Оновити' : 'Створити' }}
      </UButton>
    </UForm>
  </UCard>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue'
import { z } from 'zod'
import { useRouter } from 'vue-router'


// @ts-expect-error
import { useToast } from '@nuxthq/ui'



const props = defineProps<{ id?: number }>()
const router = useRouter()
const toast = useToast()

const schema = z.object({
  title: z.string().min(3, 'Мінімум 3 символи'),
  slug: z.string().min(3).regex(/^[a-z0-9-]+$/, 'Тільки маленькі латинські букви, цифри, дефіси'),
  description: z.string().optional(),
})

type FormData = z.infer<typeof schema>

const form = ref<FormData>({
  title: '',
  slug: '',
  description: ''
})

const submitting = ref(false)

const fetchCategory = async () => {
  if (!props.id) return
  try {
    const res = await $fetch<{ data: FormData }>(`http://localhost:8000/api/blog/categories/${props.id}`)
    form.value = res.data
  } catch (error) {
    toast.add({ title: 'Помилка', description: 'Не вдалося завантажити категорію', color: 'red' })
    router.push('/blog-categories')
  }
}

onMounted(fetchCategory)

const onSubmit = async () => {
  submitting.value = true
  try {
    if (props.id) {
      await $fetch(`http://localhost:8000/api/blog/categories/${props.id}`, {
        method: 'PUT',
        body: form.value
      })
    } else {
      await $fetch('http://localhost:8000/api/blog/categories', {
        method: 'POST',
        body: form.value
      })
    }
    toast.add({ title: 'Успішно', description: 'Категорію збережено', color: 'green' })
    router.push('/blog-categories')
  } catch (error) {
    toast.add({ title: 'Помилка', description: 'Не вдалося зберегти категорію', color: 'red' })
  } finally {
    submitting.value = false
  }
}
</script>
