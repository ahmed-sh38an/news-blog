<template>
  <Layout />
  <main class="max-w-6xl mx-auto mt-10 lg:mt-20 space-y-6">
    <article class="max-w-4xl mx-auto lg:grid lg:grid-cols-12 gap-x-10">
      <div class="col-span-2 lg:text-center lg:pt-14 mb-10">
        <div class="flex items-center lg:justify-center text-sm mt-4">
          <a href="#">
            <div class="ml-3 text-left">
              <h5 class="font-bold">{{ post.author }}</h5>
            </div>
          </a>
        </div>
        <p class="mt-4 block text-gray-400 text-xs">{{ post.created_at }}</p>
      </div>
      <div class="col-span-10">
        <div class="hidden lg:flex justify-between mb-6">
          <router-link
            :to="{ name: 'home' }"
            class="transition-colors duration-300 relative inline-flex items-center text-lg hover:text-blue-500"
          >
            <svg width="22" height="22" viewBox="0 0 22 22" class="mr-2">
              <g fill="none" fill-rule="evenodd">
                <path
                  stroke="#000"
                  stroke-opacity=".012"
                  stroke-width=".5"
                  d="M21 1v20.16H.84V1z"
                ></path>
                <path
                  class="fill-current"
                  d="M13.854 7.224l-3.847 3.856 3.847 3.856-1.184 1.184-5.04-5.04 5.04-5.04z"
                ></path>
              </g>
            </svg>
            Back to News
          </router-link>
        </div>
        <div>
          <img
            :src="post.image_url"
            :alt="post.title"
            class="rounded-xl my-3"
          />
        </div>
        <h1 class="font-bold text-3xl lg:text-4xl mb-10">
          {{ post.title }}
        </h1>

        <div class="space-y-4 lg:text-lg leading-loose">
          {{ post.description }}
        </div>
        <div class="flex justify-end">
          <LikeButton :post="post" />
        </div>
      </div>
    </article>
    <AddComment :post="post" />
    <Comments :post="post" />
  </main>
  <Footer />
</template>

<script setup>
import Layout from "../components/Layout.vue";
import Footer from "../components/Footer.vue";
import Comments from "../components/Comments.vue";
import AddComment from "../components/AddComment.vue";
import LikeButton from "../components/LikeButton.vue";
import store from "../store";
import { useRoute } from "vue-router";
import { computed } from "vue";

const route = useRoute();

const post = computed(() => store.state.currentPost.data);

store.dispatch("getPost", route.params.slug);
</script>
