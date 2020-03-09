<template>
    <div class="bg-gray-100 p-4">
        AppsIndex
    </div>
</template>

<script>
    export default {
        props: ['apps'],
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
