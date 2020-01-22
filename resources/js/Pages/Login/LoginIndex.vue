<template>
    <div class="bg-gray-100 p-4">
        <form class="flex flex-col" method="POST" @submit.prevent="login">
            <label for="email">Email</label>
            <input v-model="form.email" type="text" id="email">
            <div class="text-red-600" v-if="$page.errors.email">{{ $page.errors.email[0] }}</div>

            <label for="password">Password</label>
            <input v-model="form.password" type="text" id="password">
            <div class="text-red-600" v-if="$page.errors.password">{{ $page.errors.password[0] }}</div>

            <button type="submit" >Submit</button>
        </form>
    </div>
</template>

<script>
    export default {
        props: [],
        data() {
            return {
                form: {
                  email: '',
                  password: '',  
                }
            }
        },
        methods: {
            login() {
                this.$inertia.post('/login', this.form)
            }
        }
    }
</script>
