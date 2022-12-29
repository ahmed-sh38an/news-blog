<template>
  <div class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6">
    <div
      class="flex justify-between px-5 py-5 border border-white hover:border-gray-200 hover:border hover:rounded-lg hover:bg-gray-50"
    >
      <div class="mr-6">
        <img :src="post.image_url" :alt="post.title" class="rounded-xl" />
      </div>
      <div class="max-w-xl px-3">
        <h1 class="font-bold py-3 text-lg">
          {{ post.title }}
        </h1>
        <p class="py-2 max-w-md">
          {{ post.description }}
        </p>

        <router-link
          :to="{ name: 'news', params: { slug: post.slug } }"
          class="flex py-2 px-4 border border-transparent text-sm rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
        >
          Read More
        </router-link>
      </div>
    </div>
  </div>
</template>

<script setup>
const { post } = defineProps({
  post: Object,
});
</script>
