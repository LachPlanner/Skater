<script setup>
import { useForm } from '@inertiajs/vue3';

let form = useForm({
    status: '',
})

function resendVerification() {
  form.post('/email/resend', {
    onSuccess: () => {
        form.status = 'verification-link-sent'
    }
  });
}
</script>

<template>
  <Layout>
    <div class="flex flex-col items-center justify-center min-h-screen bg-white">
      <div class="bg-white shadow-md rounded-lg p-8 max-w-md w-full">
        <h1 class="text-2xl font-bold text-center text-gray-900 mb-6">Verify Your Email Address</h1>
  
        <p v-if="form.status === 'verification-link-sent'" class="text-green-500 text-center mb-4">
          A new verification link has been sent to your email address.
        </p>
  
        <p class="text-gray-700 text-center mb-2">Before proceeding, please check your email for a verification link.</p>
        <p class="text-gray-700 text-center mb-6">If you did not receive the email, click below to request another one.</p>
  
        <form method="POST" @submit.prevent="resendVerification" class="text-center">
            <button 
            type="submit" 
            class="bg-indigo-600 text-white font-semibold py-2 px-4 rounded-md hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2"
            :disabled="form.processing"
            >
                    <!-- Vis en spinner, når formularen behandles -->
                <svg v-if="form.processing" class="animate-spin h-5 w-5 text-white inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                </svg>
                <span v-else>Resend Verification Email</span>
            </button>
        </form>
      </div>
    </div>
  </Layout>
</template>