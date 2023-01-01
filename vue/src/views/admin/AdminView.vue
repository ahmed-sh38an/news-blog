<template>
  <Layout />
  <div>
    <section class="max-w-4xl mx-auto py-8">
      <h1 class="text-lg font-bold mb-8 pb-2 border-b">Admin Panel</h1>
      <div class="flex">
        <aside class="w-48 border-r-2 mr-5">
          <h4 class="font-semibold mb-4">Links</h4>
          <ul>
            <li>
              <router-link :to="{ name: 'dashboard' }" class="text-blue-500"
                >All Posts</router-link
              >
            </li>
            <li>
              <router-link :to="{ name: 'create' }" class="text-blue-500"
                >New Post</router-link
              >
            </li>
          </ul>
        </aside>

        <div class="flex flex-col">
          <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div
              class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8"
            >
              <div
                class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg"
              >
                <table class="min-w-full divide-y divide-gray-200">
                  <tbody class="bg-white divide-y divide-gray-200">
                    <tr v-for="post in posts" :key="post.id">
                      <td class="px-6 py-6 whitespace-nowrap">
                        <div class="flex items-center">
                          <div class="text-sm font-medium text-gray-900">
                            <router-link
                              :to="{
                                name: 'news',
                                params: { slug: post.slug },
                              }"
                            >
                              {{ post.title }}
                            </router-link>
                          </div>
                        </div>
                      </td>

                      <td
                        class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium"
                      >
                        <router-link
                          :to="{ name: 'edit', params: { slug: post.slug } }"
                          :post="post"
                          class="text-blue-500 hover:text-blue-600"
                          >Edit</router-link
                        >
                      </td>
                      <td
                        class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium"
                      >
                        <button
                          class="text-gray-400 text-xs flex justify-center items-center"
                          @click="deletePost(post.id)"
                        >
                          <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="w-4 h-4"
                          >
                            <path
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"
                            />
                          </svg>
                          Delete
                        </button>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import Layout from "../../components/Layout.vue";
import store from "../../store";
import { computed } from "vue";
import { useRouter } from "vue-router";

const router = useRouter();
const posts = computed(() => store.state.posts.data);

store.dispatch("getPosts");

function deletePost(id) {
  if (confirm("Are you sure you want to delete this post ?")) {
    store.dispatch("deletePost", id).then((res) => {
      router.go(0);
    });
  }
}
</script>
