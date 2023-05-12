<template>
  <div class="row">
    <div class="d-md-flex flex-md-row-reverse align-items-center justify-content-between">
      <div class="mb-3 mb-md-0 d-flex text-nowrap">
        <router-link class="btn btn-success" to="/produtos">Listar Produtos</router-link>
      </div>
      <h1>Cadastrar Novo Produto</h1>
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
          <button type="submit" class="btn btn-primary mb-3">Cadastrar</button>
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
      const response = await axios.get('http://localhost:8000/api/categories');
      this.categories = response.data;
    } catch (error) {
      console.error(error);
    }
  },
  methods: {
    async submitForm() {
      try {
        await axios.post('http://localhost:8000/api/products', this.product);
        this.$router.push('/produtos');
        this.$notify({
          type: "success",
          title: "Sucesso",
          text: `O produto <b>${this.product.name}</b> foi cadastrado com sucesso!`
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
