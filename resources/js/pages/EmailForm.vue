<template>
    <div class="container">
        <form @submit.prevent="sendMail">
            <router-link class="nav-link" :to="{name: 'home'}">
                Go Back
            </router-link>
            
            <div class="input-wrapper">
                <label for="email" class="form-label">Email</label>
                <input
                type="email"
                id="email"
                class="input-item"
                v-model="email"
                >
            </div>
            <div class="input-wrapper">
                <label for="name" class="form-label">Name</label>
                <input 
                type="text"
                id="name"
                class="input-item"
                v-model="name"
                >
            </div>
            <div class="input-wrapper">
                <label for="surname" class="form-label">Surname</label>
                <input 
                type="text"
                id="surname"
                class="input-item"
                v-model="surname"
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
                placeholder="Send a message to the owner"
                ></textarea>
            </div>

            <button type="submit">Send Message</button>
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
				text: this.text
			})
			.then(response => {
				this.success = response.data.success;
				
				if(this.success) {
					this.errors = {};
					this.name = '';	
					this.surname = '';	
					this.email = '';
					this.text = '';
				} else {
					this.errors = response.data.errors;
				}
			}) 
		}
	}
}
</script>

<style lang="scss" scoped>
    .container {
        display: flex;
        justify-content: center;
        align-items: center;

        .input-wrapper {
            margin: 20px 0;
        }

        .form-label {
         color: white;
         margin-right: 20px;
        }
     
        .input-item {
         width: 100%;
         border-radius: .5rem;
        }
    }
</style>