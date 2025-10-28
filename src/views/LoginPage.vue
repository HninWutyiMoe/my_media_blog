<template>
  <div class="">
    <div class="d-flex justify-content-center py-3">
      <p class="btn btn-sm bg-secondary mr-4 text-white fw-bold" 
      @click="home()" v-if="!tokenStatus">
        Home
      </p>
      <p class="btn btn-sm bg-warning text-dark fw-bold" 
      @click="login()" v-if="!tokenStatus">
      Login
      </p>
      <p class="btn btn-sm bg-warning text-dark fw-bold" 
      @click="logout()" v-if="tokenStatus">
      Logout
      </p>
    </div>

    <!-- admin@gmail.com -->
    <div class="container col-5 shadow-sm my-5 p-5">
      <span class="alert alert-danger d-flex justify-content-center" role="alert" v-if="userStatus">The Credential Do Not Match!</span>
      <div class="">
        
        <label>Email</label>
        <input
          type="email"
          class="form-control"
          aria-describedby="emailHelp"
          placeholder="Enter email"
          v-model="userData.email"
        />
      </div>
      <div class="form-group">
        <label>Password</label>
        <input
          type="password"
          class="form-control"
          placeholder="Enter password"
          v-model="userData.password"
        />
      </div>
      <button @click="accountLogin()" type="button" class="btn btn-primary">
        Login
      </button>
      <!-- <button @click="check()" class="btn btn-sm ml-3">Check Token</button> -->
    </div>
  </div>
</template>

<script src="../js/Login.js"></script>
