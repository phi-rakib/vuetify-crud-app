<template>
    <v-row align="center" class="list px-3 mx-auto">
      <v-col cols="12" md="8">
        <v-text-field v-model="name" label="Search by Name"></v-text-field>
      </v-col>
  
      <v-col cols="12" md="4">
        <v-btn small @click="searchName">
          Search
        </v-btn>
      </v-col>
  
      <v-col cols="12" sm="12">
        <v-card class="mx-auto" tile>
          <v-card-title>Brands</v-card-title>
  
          <v-data-table
            :headers="headers"
            :items="brands"
            disable-pagination
            :hide-default-footer="true"
          >
            <template v-slot:[`item.actions`]="{ item }">
              <v-icon small class="mr-2" @click="editBrand(item.id)">mdi-pencil</v-icon>
              <v-icon small @click="deleteBrand(item.id)">mdi-delete</v-icon>
            </template>
          </v-data-table>
  
          <v-card-actions v-if="brands.length > 0">
            <v-btn small color="error" @click="removeAllBrands">
              Remove All
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-col>
    </v-row>
  </template>
  
  <script>
  import BrandDataService from "../../services/BrandDataService";
  export default {
    name: "brands-list",
    data() {
      return {
        brands: [],
        name: "",
        headers: [
          { text: "Name", align: "start", sortable: false, value: "name" },
          { text: "Actions", value: "actions", sortable: false },
        ],
      };
    },
    methods: {
      retrieveBrands() {
        BrandDataService.getAll()
          .then((response) => {
            this.brands = response.data.map(this.getDisplayBrand);
            console.log(response.data);
          })
          .catch((e) => {
            console.log(e);
          });
      },
  
      refreshList() {
        this.retrieveBrands();
      },
  
      removeAllBrands() {
        BrandDataService.deleteAll()
          .then((response) => {
            console.log(response.data);
            this.refreshList();
          })
          .catch((e) => {
            console.log(e);
          });
      },
  
      searchName() {
        BrandDataService.findByName(this.name)
          .then((response) => {
            this.brands = response.data.map(this.getDisplayBrand);
            console.log(response.data);
          })
          .catch((e) => {
            console.log(e);
          });
      },
  
      editBrand(id) {
        this.$router.push({ name: "brand-details", params: { id: id } });
      },
  
      deleteBrand(id) {
        BrandDataService.delete(id)
          .then(() => {
            this.refreshList();
          })
          .catch((e) => {
            console.log(e);
          });
      },
  
      getDisplayBrand(brand) {
        return {
          id: brand.id,
          name: brand.name.length > 30 ? brand.name.substr(0, 30) + "..." : brand.name,
        };
      },
    },
    mounted() {
      this.retrieveBrands();
    },
  };
  </script>
  
  <style>
  .list {
    max-width: 750px;
  }
  </style>