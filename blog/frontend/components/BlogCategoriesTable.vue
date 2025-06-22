<template>
  <n-data-table :columns="columns" :data="categories" :loading="loading" />
</template>

<script setup lang="ts">
import { defineProps, defineEmits, h } from 'vue'
import { NDataTable, NDropdown, NButton, NIcon } from 'naive-ui'
import { MoreOutlined } from '@vicons/antd'

interface Category {
  id: number
  title: string
  slug: string
  parent_id: number | null
  description?: string
}

const props = defineProps<{ categories: Category[], loading: boolean }>()
const emit = defineEmits(['edit', 'delete'])

const columns = [
  { title: 'ID', key: 'id' },
  { title: 'Назва', key: 'title' },
  { title: 'Slug', key: 'slug' },
  { title: 'Parent ID', key: 'parent_id' },
  { title: 'Опис', key: 'description' },
  {
    title: 'Дії',
    key: 'actions',
    render(row: Category) {
      return h(
        NDropdown,
        {
          trigger: 'click',
          options: [
            { label: 'Редагувати', key: 'edit' },
            { label: 'Видалити', key: 'delete' }
          ],
          onSelect: (key: string) => {
            if (key === 'edit') emit('edit', row)
            if (key === 'delete') emit('delete', row.id)
          }
        },
        {
          default: () =>
            h(
              NButton,
              { tertiary: true, size: 'small' },
              {
                icon: () =>
                  h(
                    NIcon,
                    null,
                    {
                      default: () => h(MoreOutlined)
                    }
                  )
              }
            )
        }
      )
    }
  }
]
</script>
