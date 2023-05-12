<template>
  <div class="row">
    <div class="d-md-flex flex-md-row-reverse align-items-center justify-content-between">
      <div class="mb-3 mb-md-0 d-flex text-nowrap">
        <router-link class="btn btn-success" to="/produtos/criar">Novo Produto</router-link>
      </div>
      <h1>Produtos</h1>
    </div>
  </div>
  <div class="row">
    <div col-md-12>
      <table class="table table-success table-striped">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nome do Produto</th>
            <th scope="col">Categoria</th>
            <th scope="col">Opções</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="product in products" :key="product.id">
            <th scope="row">{{ product.id }}</th>
            <td>{{ product.name }}</td>
            <td>{{ product.category.name }}</td>
            <td>
              <router-link :to="`/produtos/editar/${product.id}`" class="btn btn-primary btn-sm">Editar</router-link>&nbsp;
              <button @click="deleteProduct(product.id)" class="btn btn-danger btn-sm">Excluir</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      products: [],
    };
  },
  async created() {
    await this.fetchProducts();
  },
  methods: {
    async fetchProducts() {
      try {
        const response = await axios.get('http://localhost:8000/api/products');
        this.products = response.data;
      } catch (error) {
        console.error(error);
      }
    },
    async deleteProduct(id) {
      try {
        const response = await axios.get(`http://localhost:8000/api/products/${id}`);
        this.product = response.data;
        await axios.delete(`http://localhost:8000/api/products/${id}`);
        await this.fetchProducts();
        this.$notify({
          type: "success",
          title: "Sucesso",
          text: `O produto <b>${this.product.name}</b> foi excluído com sucesso!`
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
