<template>
  <div class="row">
    <div col-md-12>
      <h1>Categorias</h1>
      </div>
  </div>
  <div class="row">
    <div col-md-12>
      <table class="table table-success table-striped">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nome da Categoria</th>
            <th scope="col">Opções</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="category in categories" :key="category.id">
            <th scope="row">{{ category.id }}</th>
            <td>{{ category.name }}</td>
            <td>
              <router-link :to="`/categorias/editar/${category.id}`" class="btn btn-primary btn-sm">Editar</router-link>&nbsp;
              <button @click="deleteCategory(category.id)" class="btn btn-danger btn-sm">Excluir</button>
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
      categories: [],
    };
  },
  async created() {
    await this.fetchCategories();
  },
  methods: {
    async fetchCategories() {
      try {
        const response = await axios.get('http://localhost:8000/api/categories');
        this.categories = response.data;
      } catch (error) {
        console.error(error);
      }
    },
    async deleteCategory(id) {
      try {
        await axios.delete(`http://localhost:8000/api/categories/${id}`);
        await this.fetchCategories();
      } catch (error) {
        console.error(error);
      }
    },
  },
};
</script>
