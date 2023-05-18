import axios from "axios";

export default axios.create({
  baseURL: "http://vuetify-crud-api/api",
  headers: {
    "Content-type": "application/json"
  }
});