<template>
  <v-card class="my-1">

    <div class="text-center py-10 pt-lg-15">
      <img alt="" class="mb-4" style="max-width:300px">
      <div class="col-6" style="margin-left:auto;margin-right:auto">

        <v-alert
          border="top"
          color="success"
          dark
        >
          {{ status }}
        </v-alert>
      </div>
      <div class="col-3" style="margin-left:auto;margin-right:auto">
        <v-btn :disabled="disabled" class=" mb-2 w-full w-sm-auto" color="warning"
               outlined
               @click="resend_verify_email">
          <v-icon>
            mdi-refresh
          </v-icon>
          اعادة الإرسال
        </v-btn>

      </div>

    </div>
  </v-card>

</template>

<script>

export default {
  name: "VerifyEmail",
  props: {
    status: String
  },
  data() {
    return {
      disabled: false,
      dialog: false,
      form: this.$inertia.form({
        email: null
      })

    }
  },
  methods: {
    resend_verify_email() {
      this.disabled = true
      this.$inertia.post('/email/verification-notification', '', {
        onFinish: page => {
          this.disabled = false
        }
      })
    },
    update_email() {
      this.form.post('/change_email_and_resend_verify_email', {
        onSuccess: page => {
          this.dialog = false
        }

      })

    }
  }
}
</script>

<style scoped>

</style>
