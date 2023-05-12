<template>
  <nav class="navbar navbar-expand-lg navbar-primary bg-primary">
    <div class="container px-5">
      <a class="navbar-brand link-light" href="index.html">ABC Produtos</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item"><a class="link-light" href="#">Home</a><span class="text-white mx-1">&middot;</span></li>
          <li class="nav-item"><router-link class="link-light" to="/produtos">Produtos</router-link><span class="text-white mx-1">&middot;</span></li>
          <li class="nav-item"><router-link class="link-light" to="/categorias">Categorias</router-link></li>
        </ul>
      </div>
    </div>
  </nav>
</template>

