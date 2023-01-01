import { createStore } from "vuex";
import axiosClient from "../axios";
import router from "../router";

// Create a new store instance.
const store = createStore({
  state: {
    user: {
      data: {},
      token: sessionStorage.getItem("TOKEN"),
      admin: sessionStorage.getItem("ADMIN"),
    },
    currentPost: {
      loading: false,
      data: {},
    },
    posts: {
      loading: false,
      data: {},
    },
    comments: {
      data: {},
    },
    currentComments: {
      data: {},
    },
  },
  getters: {},
  actions: {
    register({ commit }, user) {
      return axiosClient.post("/register", user).then(({ data }) => {
        commit("setUser", data);
        return data;
      });
    },
    login({ commit }, user) {
      return axiosClient.post("/login", user).then(({ data }) => {
        commit("setUser", data);
        return data;
      });
    },
    logout({ commit }) {
      return axiosClient.post("/logout").then((response) => {
        commit("logout");
        return response;
      });
    },
    adminRegister({ commit }, admin) {
      return axiosClient.post("/admin/register", admin).then(({ data }) => {
        commit("setAdmin", data);
        return data;
      });
    },
    adminLogin({ commit }, admin) {
      return axiosClient.post("/admin/login", admin).then(({ data }) => {
        commit("setAdmin", data);
        return data;
      });
    },
    adminLogout({ commit }) {
      return axiosClient.post("/admin/logout").then(() => {
        commit("logout");
      });
    },
    createPost({ commit }, post) {
      delete post.image_url;
      return axiosClient.post("/create", post).then((res) => {
        commit("setCurrentPost", res.data);
        return res;
      });
    },
    getPosts({ commit }) {
      return axiosClient.get("/index").then((res) => {
        commit("setPosts", res.data);
        return res;
      });
    },
    getPost({ commit }, id) {
      return axiosClient
        .get(`/index/${id}`)
        .then((res) => {
          commit("setCurrentPost", res.data);
          return res;
        })
        .catch((err) => {
          throw err;
        });
    },
    addComment({ commit }, data) {
      return axiosClient.post("/comment", data).then(({ data }) => {
        commit("setComments", data);
        return data;
      });
    },
    pullComments({ commit }, id) {
      return axiosClient.get(`/comment/${id}`).then(({ data }) => {
        commit("setComments", data.data);
        return data;
      });
    },
    like({ commit }, id) {
      return axiosClient.post(`/like/${id}`);
    },
    likeCount({ commit }, id) {
      return axiosClient.get(`/like/${id}`);
    },
    deletePost({ commit }, id) {
      return axiosClient.delete(`/delete/${id}`).then((res) => {
        return res;
      });
    },
    editPost({ commit }, post) {
      return axiosClient.put(`/edit/${post.id}`, post).then(({ data }) => {
        commit("setCurrentPost", data.data);
        return data;
      });
    },
  },
  mutations: {
    setUser: (state, userData) => {
      state.user.data = userData.user;
      state.user.token = userData.token;
      sessionStorage.setItem("TOKEN", userData.token);
    },
    logout: (state) => {
      (state.user.data = {}),
        (state.user.admin = false),
        (state.user.token = null);
      sessionStorage.removeItem("TOKEN");
      sessionStorage.removeItem("ADMIN");
    },
    setAdmin: (state, adminData) => {
      state.user.data = adminData.user;
      state.user.token = adminData.token;
      state.user.admin = adminData.admin;
      sessionStorage.setItem("TOKEN", adminData.token);
      sessionStorage.setItem("ADMIN", adminData.admin);
    },
    setCurrentPost: (state, post) => {
      state.currentPost.data = post.data;
    },
    setPosts: (state, posts) => {
      state.posts.data = posts.data;
    },
    setComments: (state, comment) => {
      state.currentComments.data = comment.data;
    },
  },
});

export default store;
