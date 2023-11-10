<template>
  <v-container fluid>
    <v-row>
      <v-col cols="12" md="12" sm="12">
        <v-card>

          <v-toolbar class="header_title" color="#0007a5" dark>
            <v-row>
              <h3 class="mt-2" style="padding-right:13px">
                اعدادت اللوجو
              </h3>
              <v-col style="padding-left:20px">
              </v-col>

            </v-row>


          </v-toolbar>
          <v-card-text class="grey lighten-5 mt-3">
            <v-row class="match-height">
              <!-- horizontal -->
              <v-col
                cols="12"
                md="12"
              >
                <v-card>
                  <v-card-title> بيانات اللوجو</v-card-title>
                  <v-card-text>
                    <v-form class="multi-col-validation" @submit.prevent="submit">
                      <v-row>
                        <v-col
                          cols="12"
                          md="6"
                        >
                          <v-text-field
                            v-model="form.text"
                            :error-messages="$page.props.errors.text"
                            dense
                            label="العنوان"
                            outlined
                            placeholder="العنوان"
                            prepend-inner-icon="mdi-account-details-outline"
                          ></v-text-field>
                        </v-col>

                        <v-col
                          cols="12"
                          md="6"
                        >
                          <v-file-input v-model="form.logo"
                                        :error-messages="$page.props.errors.logo" dense
                                        label="اللوجو  "
                                        outlined prepend-icon=""
                                        prepend-inner-icon="mdi-image-plus"
                                        type="file"/>
                        </v-col>


                        <v-col cols="12">
                          <v-btn :loading="form.processing"
                                 class=" mx-2 v-btn v-btn--is-elevated v-btn--has-bg theme--dark v-size--default  "
                                 color="#0007a5"
                                 type="submit"
                          >
                            حفظ
                          </v-btn>
                          <v-btn class="mx-2"
                                 color="red"
                                 outlined
                                 type="reset"
                                 @click="reset"
                          >
                            مسح الحقول
                          </v-btn>
                        </v-col>
                      </v-row>
                    </v-form>
                  </v-card-text>
                </v-card>
              </v-col>
            </v-row>


          </v-card-text>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>

export default {
  name: "Create",
  props: {
    logo_settings: Object
  },

  data() {
    return {
      form: this.$inertia.form({
        text: this.logo_settings.text,
        logo: null,

      }),

    }
  },
  methods: {
    submit() {
      this.form.post('/admin/logo_setting')
    }, reset() {
      this.form = this.$inertia.form({
        title: null,
      })
    }
  }
}
</script>

<style scoped>

</style>
