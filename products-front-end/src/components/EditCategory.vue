<template>
  <div>
    <h1>Editar Categoria</h1>
    <form @submit.prevent="submitForm">
      <label for="name">Nome da Categoria:</label>
      <input type="text" id="name" v-model="category.name" required>
      <button type="submit">Salvar</button>
    </form>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      category: {
        name: '',
      },
    };
  },
  async created() {
    try {
      const response = await axios.get(`http://localhost:8000/api/categories/${this.$route.params.id}`);
      this.category = response.data;
    } catch (error) {
      console.error(error);
    }
  },
  methods: {
    async submitForm() {
      try {
        await axios.put(`http://localhost:8000/api/categories/${this.$route.params.id}`, this.category);
        this.$router.push('/categorias');
      } catch (error) {
        console.error(error);
      }
    },
  },
};
</script>
