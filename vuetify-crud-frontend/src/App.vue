<template>
  <v-app>
    <v-app-bar app dark>
      <div class="d-flex align-center mr-2">
        VUETIFY CRUD
      </div>

      <v-btn to="/brands" text>
        Brands
      </v-btn>

      <v-btn to="/add" text>
        Add
      </v-btn>
    </v-app-bar>

    <v-main>
      <router-view />
    </v-main>
  </v-app>
</template>

<script>
export default {
  name: "app",
};
</script>