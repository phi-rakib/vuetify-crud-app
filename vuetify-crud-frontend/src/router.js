import Vue from "vue";
import Router from "vue-router";

Vue.use(Router);

export default new Router({
  mode: "history",
  routes: [
    {
      path: "/",
      alias: "/brands",
      name: "brands",
      component: () => import("./components/brand/BrandList")
    },
    {
      path: "/brands/:id",
      name: "brand-details",
      component: () => import("./components/brand/EditBrand")
    },
    {
      path: "/add",
      name: "add",
      component: () => import("./components/brand/AddBrand")
    }
  ]
});