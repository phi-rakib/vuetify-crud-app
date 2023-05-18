<template>
    <div v-if="currentBrand" class="edit-form py-3">
      <p class="headline">Edit Brand</p>
  
      <v-form ref="form" lazy-validation>
        <v-text-field
          v-model="currentBrand.name"
          :rules="[(v) => !!v || 'Name is required']"
          label="Name"
          required
        ></v-text-field>
  
        <v-divider class="my-5"></v-divider>
  
        <v-btn color="error" small class="mr-2" @click="deleteBrand">
          Delete
        </v-btn>
  
        <v-btn color="success" small @click="updateBrand">
          Update
        </v-btn>
      </v-form>
  
      <p class="mt-3">{{ message }}</p>
    </div>
  
    <div v-else>
      <p>Please click on a Brand...</p>
    </div>
  </template>
  
  <script>
  import BrandDataService from "../../services/BrandDataService";
  
  export default {
    name: "brand-component",
    data() {
      return {
        currentBrand: null,
        message: "",
      };
    },
    methods: {
      getBrand(id) {
        BrandDataService.get(id)
          .then((response) => {
            this.currentBrand = response.data;
            console.log(response.data);
          })
          .catch((e) => {
            console.log(e);
          });
      },
  
      updateBrand() {
        BrandDataService.update(this.currentBrand.id, this.currentBrand)
          .then((response) => {
            console.log(response.data);
            this.message = "The brand was updated successfully!";
          })
          .catch((e) => {
            console.log(e);
          });
      },
  
      deleteBrand() {
        BrandDataService.delete(this.currentBrand.id)
          .then((response) => {
            console.log(response.data);
            this.$router.push({ name: "brands" });
          })
          .catch((e) => {
            console.log(e);
          });
      },
    },
    mounted() {
      this.message = "";
      this.getBrand(this.$route.params.id);
    },
  };
  </script>
  
  <style>
  .edit-form {
    max-width: 300px;
    margin: auto;
  }
  </style>