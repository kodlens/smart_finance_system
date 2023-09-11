<template>
    <div class="login-wrapper">
        <div class="login">
            <form @submit.prevent="submit">
                <div class="box">
                    <div class="box-heading">
                        <div class="box-heading-text">
                            Smart Finance System
                        </div>
                    </div>

                    <div class="box-body">
                       <div class="img-container">
                           <img class="img" src="/img/logo_small.png" />
                       </div>
                        <b-field label="Username" label-position="on-border"
                            :type="this.errors.username ? 'is-danger':''"
                            :message="this.errors.username ? this.errors.username[0] : ''">
                            <b-input type="text" v-model="fields.username" placeholder="Username" />
                        </b-field>

                        <b-field label="Password" label-position="on-border">
                            <b-input type="password" v-model="fields.password" password-reveal placeholder="Password" />
                        </b-field>

                        <div class="buttons is-center pb-4">
                            <button :class="btnClass">LOGIN</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>

export default {
    data(){
        return {
            fields: {
                username: '',
                password: '',
            },

            btnClass: {
                'is-primary': true,
                'is-loading': false,
                'button': true,
                'is-fullwidth' : true
            },

            errors: {},

        }
    },

    methods: {
        submit: function(){
            this.btnClass['is-loading'] = true;

            axios.post('/custom-login', this.fields).then(res=>{
                this.btnClass['is-loading'] = false;
              
                window.location = '/'

            }).catch(err=>{
            this.btnClass['is-loading'] = false;
                this.errors = err.response.data.errors;

            })
        }
    }
}
</script>


<style scoped>
    .login-wrapper{
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .login{
        border-top: 5px solid #df9100;
        width: 500px;
    }

    .panel-body{
        margin: 15px;
    }

    .img-container{
        display: flex;
        justify-content: center;
    }

    .img{
        height: 150px;
    }

    .box-heading-text{
        font-weight: bold;
        font-size: 1.4em;
        text-align: center;
        padding: 15px;
    }

</style>
