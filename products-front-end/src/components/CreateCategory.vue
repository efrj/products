<template>
  <div>
    <h1>Criar Categoria</h1>
    <form @submit.prevent="submitForm">
      <label for="name">Nome da Categoria:</label>
      <input type="text" id="name" v-model="category.name" required>
      <button type="submit">Criar</button>
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
  methods: {
    async submitForm() {
      try {
        await axios.post('http://localhost:8000/api/categories', this.category);
        this.category.name = '';
        this.$router.push('/categorias');
      } catch (error) {
        console.error(error);
      }
    },
  },
};
</script>
