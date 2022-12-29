<template>
  <div
    class="bg-gray-50 border border-gray-200 p-6 rounded-xl max-w-4xl mx-auto"
  >
    <article class="flex space-x-4">
      <div class="flex-shrink-0">
        <img
          src="https://i.pravatar.cc/300"
          alt=""
          width="60"
          height="60"
          class="rounded-xl"
        />
      </div>
      <div>
        <header class="mb-5">
          <h3 class="font-bold">{{ comment.commentor }}</h3>
          <p class="text-xs">Posted Now</p>
        </header>
        <p>{{ comment.comment }}</p>
      </div>
    </article>
  </div>
</template>

<script setup>
const { comment } = defineProps({
  comment: Object,
});
</script>
