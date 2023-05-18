<template>
    <div class="submit-form mt-3 mx-auto">
      <p class="headline">Add Brand</p>
  
      <div v-if="!submitted">
        <v-form ref="form" lazy-validation>
          <v-text-field
            v-model="brand.name"
            :rules="[(v) => !!v || 'Name is required']"
            label="Name"
            required
          ></v-text-field>
        </v-form>
  
        <v-btn color="primary" class="mt-3" @click="saveBrand">Submit</v-btn>
      </div>
  
      <div v-else>
        <v-card class="mx-auto">
          <v-card-title>
            Submitted successfully!
          </v-card-title>
  
          <v-card-subtitle>
            Click the button to add new Brand.
          </v-card-subtitle>
  
          <v-card-actions>
            <v-btn color="success" @click="newBrand">Add</v-btn>
          </v-card-actions>
        </v-card>
      </div>
    </div>
  </template>
  
  <script>
  import BrandDataService from "../../services/BrandDataService";
  
  export default {
    name: "add-brand",
    data() {
      return {
        brand: {
          id: null,
          name: "",
        },
        submitted: false,
      };
    },
    methods: {
      saveBrand() {
        var data = {
          name: this.brand.name,
        };
  
        BrandDataService.create(data)
          .then((response) => {
            this.brand.id = response.data.id;
            console.log(response.data);
            this.submitted = true;
          })
          .catch((e) => {
            console.log(e);
          });
      },
  
      newBrand() {
        this.submitted = false;
        this.brand = {};
      },
    },
  };
  </script>
  
  <style>
  .submit-form {
    max-width: 300px;
  }
  </style>