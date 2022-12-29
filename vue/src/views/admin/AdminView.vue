<script setup>
import Layout from "../../components/Layout.vue";
</script>

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
              <a href="#" class="text-blue-500">All Posts</a>
            </li>
            <li>
              <a href="/admin/posts/create" class="text-blue-500">New Post</a>
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
                    <tr>
                      <td class="px-6 py-6 whitespace-nowrap">
                        <div class="flex items-center">
                          <div class="text-sm font-medium text-gray-900">
                            <a href="#"> Lorem Ipsum Santis Martos Wsi </a>
                          </div>
                        </div>
                      </td>

                      <td
                        class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium"
                      >
                        <a href="#" class="text-blue-500 hover:text-blue-600"
                          >Edit</a
                        >
                      </td>
                      <td
                        class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium"
                      >
                        <form action="" method="POST">
                          <button class="text-gray-400 text-xs">Delete</button>
                        </form>
                      </td>
                    </tr>
                    <tr>
                      <td class="px-6 py-6 whitespace-nowrap">
                        <div class="flex items-center">
                          <div class="text-sm font-medium text-gray-900">
                            <a href="#"> Lorem Ipsum Santis Martos Wsi </a>
                          </div>
                        </div>
                      </td>

                      <td
                        class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium"
                      >
                        <a href="#" class="text-blue-500 hover:text-blue-600"
                          >Edit</a
                        >
                      </td>
                      <td
                        class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium"
                      >
                        <form action="" method="POST">
                          <button class="text-gray-400 text-xs">Delete</button>
                        </form>
                      </td>
                    </tr>
                    <tr>
                      <td class="px-6 py-6 whitespace-nowrap">
                        <div class="flex items-center">
                          <div class="text-sm font-medium text-gray-900">
                            <a href="#"> Lorem Ipsum Santis Martos Wsi </a>
                          </div>
                        </div>
                      </td>

                      <td
                        class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium"
                      >
                        <a href="#" class="text-blue-500 hover:text-blue-600"
                          >Edit</a
                        >
                      </td>
                      <td
                        class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium"
                      >
                        <form action="" method="POST">
                          <button class="text-gray-400 text-xs">Delete</button>
                        </form>
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

<script>
export default {};
</script>
