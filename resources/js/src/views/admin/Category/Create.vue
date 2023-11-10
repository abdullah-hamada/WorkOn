<template>
  <v-container fluid>
    <v-row>
      <v-col cols="12" md="12" sm="12">
        <v-card>

          <v-toolbar class="header_title" color="#0007a5" dark>
            <v-row>
              <h3 class="mt-2" style="padding-right:13px">
                إضافة تخصص جديد
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
                  <v-card-title> بيانات التخصصات</v-card-title>
                  <v-card-text>
                    <v-form class="multi-col-validation" @submit.prevent="submit">
                      <v-row>
                        <v-col
                          cols="12"
                          md="6"
                        >
                          <v-text-field
                            v-model="form.name_ar"
                            :error-messages="$page.props.errors.name_ar"
                            dense
                            label="إسم التخصص"
                            outlined
                            placeholder="إسم التخصص"
                            prepend-inner-icon="mdi-account-details-outline"
                          ></v-text-field>
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

  data() {
    return {
      form: this.$inertia.form({
        name_ar: null,
      }),
    }
  },
  methods: {
    submit() {
      this.form.post('/admin/categories')
    }, reset() {
      this.form.reset()
    }
  }
}
</script>

<style scoped>

</style>
