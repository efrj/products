<template>
    <div class="row">
      <div class="d-md-flex flex-md-row-reverse align-items-center justify-content-between">
        <div class="mb-3 mb-md-0 d-flex text-nowrap">
          <router-link class="btn btn-success" to="/produtos">Listar Produtos</router-link>
        </div>
        <h1>Editar Produto</h1>
      </div>
    </div>
    <div class="row">
      <div class="col-md-5">
        <form @submit.prevent="submitForm">
          <div class="col">
            <label class="form-label" for="name"><b>Nome do Produto:</b></label>
            <input type="text" class="form-control" id="name" v-model="product.name" required>
          </div>
          <div class="col mt-5">
            <label class="form-label" for="category_id"><b>Categoria:</b></label>
            <select v-model="product.category_id" required class="form-control">
              <option disabled value="">Selecione uma categoria</option>
              <option v-for="category in categories" :key="category.id" :value="category.id">
                {{ category.name }}
              </option>
            </select>
          </div>
          <div class="mt-2">
            <button type="submit" class="btn btn-primary mb-3">Editar</button>
          </div>
        </form>
      </div>
    </div>
  </template>

<script>
import axios from 'axios';

export default {
    data() {
    return {
      product: {
        name: '',
        category_id: ''
      },
      categories: [],
    };
  },
  async created() {
    try {
      const response = await axios.get(`http://localhost:8000/api/products/${this.$route.params.id}`);
      this.product = response.data;
      const response_categories = await axios.get('http://localhost:8000/api/categories');
      this.categories = response_categories.data;
    } catch (error) {
      console.error(error);
    }
  },
  methods: {
    async submitForm() {
      try {
        await axios.put(`http://localhost:8000/api/products/${this.$route.params.id}`, this.product);
        this.$router.push('/produtos');
        this.$notify({
          type: "success",
          title: "Sucesso",
          text: `A categoria <b>${this.product.name}</b> foi alterada com sucesso!`
        });
      } catch (error) {
        console.error(error);
        this.$notify({
          type: "error",
          title: "Erro",
          text: error
        });
      }
    },
  },
};
</script>
