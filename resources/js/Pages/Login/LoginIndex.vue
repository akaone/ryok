<template>
    <div class="bg-gray-ef h-screen flex flex-col sm:items-center">
        <div class="flex flex-row mx-auto mb-4 mt-8">
          <h3 class="font-ryok text-pblue text-2xl self-center">Ryok</h3>
          <span  class="text-pblue text-lg italic self-center ml-1">- Connexion</span>
        </div>

        <div class="sm:rounded flex flex-col bg-white sm:shadow-md sm:mx-auto sm:w-10/12 md:w-6/12 lg:w-5/12 pt-4">
            <form class="flex flex-col" method="POST" @submit.prevent="login">
                <div class="flex flex-col px-6 mt-2">
                    <label class="font-thin text-gray-33 text-md" for="email">Email</label>
                    <input
                      :class="{ 'bg-red-400': $v.form.email.$error }"
                      class="border h-8 px-2 rounded border-gray-8e focus:outline-none focus:border-pblue"
                      v-model="form.email" type="text" id="email">
                    <div class="text-red-600 text-md font-light" v-if="$page.errors.email">{{ $page.errors.email[0] }}</div>
                </div>
                
                <div class="flex flex-col px-6 mt-2">
                    <label class="font-thin text-gray-33 text-md" for="password">Password</label>
                    <input
                      :class="{ 'bg-red-400': $v.form.password.$error }"
                      class="border h-8 px-2 rounded border-gray-8e focus:outline-none focus:border-pblue"
                      v-model="form.password" type="password" id="password">
                    <div class="text-red-600 text-md font-light" v-if="$page.errors.password">{{ $page.errors.password[0] }}</div>
                </div>

            <div class="border border-gray-400 relative mt-6" />

            <button class="p-4 bg-pblue text-white font-light text-sm italic" type="submit">CONNEXION</button>
            </form>
        </div>

        <div class="flex flex-row mx-auto my-4">
          <inertia-link :href="route('sign-up.create')" class="text-pblue text-md italic self-center ml-1 underline cursor-pointer">
            Je veux m'inscrire
          </inertia-link>
        </div>
    </div>
</template>

<script>
  import { required, minLength, email } from 'vuelidate/lib/validators';

  export default {
    props: [],
    data() {
      return {
        form: {
          email: '',
          password: '',  
        },
        loading: false,
      }
    },
    validations: {
      form :{
        email: {
          required,
          email,
        },
        password: {
          required,
          minLength: minLength(6)
        }
      }
    },
    methods: {
      login() {
        this.$v.form.$touch();
        if (!this.$v.form.$invalid && !this.loading) {
          this.loading = true
          this.$inertia.post(this.route("login"), this.form)
            .then(() => {this.loading = false; this.form.password = ''; this.$v.form.$reset()})
            .catch(() => {this.loading = false; this.form.password = ''; this.$v.form.$reset()});
        }
      }
    }
  }
</script>
