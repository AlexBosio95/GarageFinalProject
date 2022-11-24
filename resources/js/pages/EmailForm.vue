<template>
    <div class="container">
        <form @submit.prevent="sendMail" id="message-form">
            <router-link class="btn my-router-link" :to="{name: 'home'}">
                Go Back
            </router-link>

            <h1 class="title">Send a message to the owner</h1>
            
            <div class="input-wrapper">
                <label for="email" class="form-label">Email</label>
                <input
                type="email"
                id="email"
                class="input-item"
                v-model="email"
                placeholder="Your email"
                >
            </div>
            <div class="input-wrapper">
                <label for="name" class="form-label">Name</label>
                <input 
                type="text"
                id="name"
                class="input-item"
                v-model="name"
                placeholder="Your name"
                >
            </div>
            <div class="input-wrapper">
                <label for="surname" class="form-label">Surname</label>
                <input 
                type="text"
                id="surname"
                class="input-item"
                v-model="surname"
                placeholder="Your surname"
                >
            </div>
            <div class="input-wrapper">
                <label for="text" class="form-label">Message</label>
                <textarea 
                id="text" 
                class="input-item"
                cols="30"
                rows="10"
                v-model="text"
                ></textarea>
            </div>

            <button 
            type="submit"
            :disabled="isSending"
            >
                Send Message
            </button>
        </form>
    </div>

</template>

<script>
export default {
    name: 'EmailForm',
    data() {
		return {
			name: '',
            surname: '',
			email: '',
			text: '',
			errors: {},
			success: false,
			isSending: false
		}
	},
    methods: {
		sendMail() {
			this.isSending = true;
            

			axios.post('/api/messages', {
				name: this.name,
				surname: this.surname,
				email: this.email,
				text: this.text,
                garage_id: this.$route.params.id 
			})
			.then(response => {
				this.success = response.data.success;
				
				if(this.success) {
					this.errors = {};
					this.name = '';	
					this.surname = '';	
					this.email = '';
					this.text = '';
                    this.isSending = false;
				} else {
					this.errors = response.data.errors;
				}
			}) 
		}
	}
}
</script>

<style lang="scss" scoped>
@import '../../sass/variables.scss';

    .container {
        display: flex;
        justify-content: center;
        align-items: center;

        .title{
            color: $my-yellow;
            margin-top: 1rem;
        }

        .my-router-link, button {
            background-color: black;
            color: white;
            margin-top: 1rem;
            transition: .5s linear;

            &:hover {
                background-color: $my-yellow;
                color: black;
            }
        }

        .input-wrapper {
            margin: 20px 0;
        }

        .form-label {
            color: $my-yellow;
            margin-right: 20px;
        }
     
        .input-item {
            width: 100%;
            border-radius: .5rem;
            padding: .5rem 3rem;

            &:focus {
                outline: solid 2px $my-yellow;
                background-color: black;
                color: white;
            }
        }

        button {
            padding: .3rem 1rem;
            border-radius: .5rem;
        }
    }
</style>