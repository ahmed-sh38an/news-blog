<template>
  <button
    type="button"
    @click="like"
    class="my-5 text-white bg-gradient-to-br from-pink-500 to-orange-400 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-pink-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2"
  >
    <svg
      xmlns="http://www.w3.org/2000/svg"
      :fill="fill"
      viewBox="0 0 24 24"
      stroke-width="1.5"
      :stroke="stroke"
      class="w-6 h-6"
    >
      <path
        stroke-linecap="round"
        stroke-linejoin="round"
        d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z"
      />
    </svg>

    Likes {{ count }}
  </button>
</template>

<script>
import store from "../store";
import { ref } from "vue";

export default {
  props: ["post"],
  data() {
    return {
      fill: "none",
      stroke: "currentColor",
      count: "",
    };
  },
  methods: {
    like() {
      if (!store.state.user.token) {
        alert('Log in to leave a Like')
      } else {
        store.dispatch("like", this.post.id).then((res) => {
          this.count = res.data;
          if (this.fill == 'none') {
            this.fill = 'red'
          } else if (this.fill == 'red') {
            this.fill = 'none'
          }
          if (this.stroke == 'currentColor') {
            this.stroke = 'red'
          } else if (this.stroke == 'red') {
            this.stroke = 'currentColor'
          }
          return res;
        });
      }
    },
  },
  mounted() {
    store.dispatch("likeCount", this.post.id).then((res) => {
      this.count = res.data;
      return res;
    });
  },
};
</script>
