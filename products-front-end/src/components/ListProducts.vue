<template>
  <div class="row">
    <div col-md-12>
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
            <th scope="col">categoria</th>
            <th scope="col">Opções</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="product in products" :key="product.id">
            <th scope="row">{{ product.id }}</th>
            <td>{{ product.name }}</td>
            <td>{{ product.category_id }}</td>
            <td>
              <router-link :to="`/produtos/editar/${product.id}`" class="btn btn-primary btn-sm">Editar</router-link>&nbsp;
              <button @click="deleteproduct(product.id)" class="btn btn-danger btn-sm">Excluir</button>
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
    await this.fetchproducts();
  },
  methods: {
    async fetchproducts() {
      try {
        const response = await axios.get('http://localhost:8000/api/products');
        this.products = response.data;
      } catch (error) {
        console.error(error);
      }
    },
    async deleteproduct(id) {
      try {
        await axios.delete(`http://localhost:8000/api/products/${id}`);
        await this.fetchproducts();
      } catch (error) {
        console.error(error);
      }
    },
  },
};
</script>
