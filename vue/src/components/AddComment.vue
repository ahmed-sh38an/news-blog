<script setup>
import store from "../store";
</script>

<template>
  <div
    class="bg-gray-50 border border-gray-200 p-3 rounded-xl max-w-4xl mx-auto"
  >
    <p v-if="!store.state.user.token" class="text-center py-2 font-semibold">Login to leave a comment</p>
    <form v-else-if="store.state.user.token" @submit.prevent="addComment" class="flex flex-col">
      <textarea
        name="comment"
        id="comment"
        v-model="comment"
        cols="100"
        rows="5"
        placeholder="Leave a comment."
        class="border border-gray-200 p-6 rounded-xl max-w-4xl mx-auto w-full"
      ></textarea>
      <div class="flex justify-end items-center mt-2">
        <button
          class="py-2 px-3 text-white bg-emerald-500 rounded-md hover:bg-emerald-600"
        >
          <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="1.5"
            stroke="currentColor"
            class="w-4 h-4 -mt-1 inline-block"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              d="M12 4.5v15m7.5-7.5h-15"
            />
          </svg>

          Submit
        </button>
      </div>
    </form>
  </div>
</template>

<script>

export default {
  props: ["post"],
  data() {
    return {
      comment: "",
    };
  },
  methods: {
    addComment() {
      var data = {
        comment: this.comment,
        post_id: this.post.id,
      };
      store.dispatch("addComment", data).then((res) => {
        this.comment = "";
        this.$router.push({
          name: "news",
          params: { slug: this.$route.params.slug },
        });
      });
    },
  },
};
</script>
