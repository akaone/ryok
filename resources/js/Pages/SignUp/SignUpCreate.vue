<template>
    <div class="bg-gray-ef min-h-screen flex flex-col sm:items-center">
        

        <div class="flex flex-row mx-auto mb-4 mt-8">
          <h3 class="font-ryok text-pblue text-2xl self-center">Ryok</h3>
          <span  class="text-pblue text-lg italic self-center ml-1">- Inscription</span>
        </div>
        
        <div class="sm:rounded flex flex-col bg-white sm:shadow-md sm:mx-auto sm:w-10/12 md:w-6/12 lg:w-5/12">

          <global-errors />
          <form class="flex flex-col" method="POST" @submit.prevent="signUp">

            <div class="border border-gray-400 relative my-6">
              <span class="absolute bg-white ml-4 px-2 text-gray-600" style="bottom: -10px;">
                Info
              </span>
            </div>

            <div class="flex flex-col px-6">
              <label for="" class="font-thin text-gray-33 text-md">Votre adresse email:</label>
              <input
                :class="{ 'bg-red-400': $v.form.email.$error }"
                v-model="form.email" type="text"
                class="border h-8 px-2 rounded border-gray-8e focus:outline-none focus:border-pblue mb-2">
              
              <div class="flex flex-col md:flex-row">
                <div class="flex flex-col md:w-8/12">
                  <label for="" class="font-thin text-gray-33 text-md">Votre nom et prénom:</label>
                  <input
                    :class="{ 'bg-red-400': $v.form.name.$error }"
                    v-model="form.name" type="text"
                    class="border h-8 px-2 rounded border-gray-8e focus:outline-none focus:border-pblue mb-2">
                </div>
                <div class="flex flex-col md:ml-2 flex-1">
                  <label for="" class="font-thin text-gray-33 text-md">Genre:</label>
                  <select  @change="onChange($event)"  class="h-8 border border-gray-8e bg-white" name="" id="">
                      <option value="M">Masculin</option>
                      <option value="F">Féminin</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="border border-gray-400 relative my-6">
              <span class="absolute bg-white ml-4 px-2 text-gray-600" style="bottom: -10px;">
                Mot de passe
              </span>
            </div>

            <div class="flex flex-col px-6">
              <label for="" class="font-thin text-gray-33 text-md">Votre mot de passe:</label>
              <input
                :class="{ 'bg-red-400': $v.form.password.$error }"
                v-model="form.password"
                type="password" class="border h-8 px-2 rounded border-gray-8e focus:outline-none focus:border-pblue mb-2">

              <label for="" class="font-thin text-gray-33 text-md">Confirmer votre mot de passe:</label>
              <input
              :class="{ 'bg-red-400': $v.form.confirm_password.$error }"
                v-model="form.confirm_password" type="password"
                class="border h-8 px-2 rounded border-gray-8e focus:outline-none focus:border-pblue mb-2">
            </div>

            <div class="border border-gray-400 relative mt-6" />

            <button class="p-4 bg-pblue text-white font-light text-sm italic" type="submit">INSCRIPTION</button>
          </form>
        </div>

        <div class="flex flex-row mx-auto my-4">
          <inertia-link :href="route('login')" class="text-pblue text-md italic self-center ml-1 underline cursor-pointer">
            J'ai déja un compte
          </inertia-link>
        </div>
        
    </div>
</template>

<script>
  import GlobalErrors from '@/Components/GlobalErrors';
  import { required, minLength, email, sameAs } from 'vuelidate/lib/validators';

  export default {
    components: {GlobalErrors },
    props: [],
    data() {
      return {
        form: {
          email: '',
          name: '',
          password: '',
          confirm_password: '',
          gender: 'M',
        },
        loading: false,
      }
    },
    validations: {
      form :{
        email: {required, email},
        name: {required, minLength: minLength(3)},
        password: {required, minLength: minLength(6)},
        confirm_password: {required, minLength: minLength(6), sameAsPassword: sameAs('password')},
      }
    },
    methods: {
      signUp() {
        this.$v.form.$touch();
        if (!this.$v.form.$invalid && !this.loading) {
          this.loading = true
          this.$inertia.post(this.route("sign-up.store"), this.form)
            .then(() => {this.loading = false; this.form.password = ''; this.$v.form.$reset()})
            .catch(() => {this.loading = false; this.form.password = ''; this.$v.form.$reset()});
        }
      },
      onChange(event) {
        this.form.gender = event.target.value;
      }
    }
  }
</script>
