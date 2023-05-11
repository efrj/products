<template>
  <div class="row">
    <div class="d-md-flex flex-md-row-reverse align-items-center justify-content-between">
      <div class="mb-3 mb-md-0 d-flex text-nowrap">
        <router-link class="btn btn-success" to="/categorias">Listar Categorias</router-link>
      </div>
      <h1>Editar Categoria</h1>
    </div>
  </div>
  <div class="row">
    <div class="col-md-5">
      <form @submit.prevent="submitForm">
        <div class="col">
          <label class="form-label" for="name"><b>Nome da Categoria:</b></label>
        </div>
        <div class="col">
          <input type="text" class="form-control" id="name" v-model="category.name" required>
        </div>
        <div class="mt-2">
          <button type="submit" class="btn btn-primary mb-3">Alterar</button>
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
        this.$notify({
          type: "success",
          title: "Sucesso",
          text: `A categoria <b>${this.category.name}</b> foi alterada com sucesso!`
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
