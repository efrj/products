<template>
  <div class="row">
    <div class="d-md-flex flex-md-row-reverse align-items-center justify-content-between">
      <div class="mb-3 mb-md-0 d-flex text-nowrap">
        <router-link class="btn btn-success" to="/categorias/criar">Nova Categoria</router-link>
      </div>
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
      categories: []
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
        const response = await axios.get(`http://localhost:8000/api/categories/${id}`);
        this.category = response.data;
        await axios.delete(`http://localhost:8000/api/categories/${id}`);
        await this.fetchCategories();
        this.$notify({
          type: "success",
          title: "Sucesso",
          text: `A categoria <b>${this.category.name}</b> foi excluída com sucesso!`
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
