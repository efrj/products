<template>
  <div class="row">
    <div class="d-md-flex flex-md-row-reverse align-items-center justify-content-between">
      <div class="mb-3 mb-md-0 d-flex text-nowrap">
        <router-link class="btn btn-success" to="/categorias">Listar Categorias</router-link>
      </div>
      <h1>Criar Nova Categoria</h1>
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
      category: {
        name: '',
      },
    };
  },
  methods: {
    async submitForm() {
      try {
        await axios.post('http://localhost:8000/api/categories', this.category);
        this.$router.push('/categorias');
        this.$notify({
          type: "success",
          title: "Sucesso",
          text: `A categoria <b>${this.category.name}</b> foi cadastrada com sucesso!`
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
