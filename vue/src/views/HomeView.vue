<template>
  <Layout />
  <template v-for="(post, index) in posts" :key="post.id">
    <MainCard v-if="index < 1" :post="post" />
  </template>
  <div class="lg:grid lg:grid-cols-6 max-w-7xl mx-auto">
    <template v-for="(post, index) in posts" :key="post.id">
      <Cards v-if="index >= 1" :post="post" class="col-span-2" />
    </template>
  </div>
  <Footer />
</template>

<script setup>
import Layout from "../components/Layout.vue";
import Footer from "../components/Footer.vue";
import MainCard from "../components/MainCard.vue";
import Cards from "../components/Cards.vue";
import store from "../store";
import { computed } from "vue";

const posts = computed(() => store.state.posts.data);

store.dispatch("getPosts");
</script>
