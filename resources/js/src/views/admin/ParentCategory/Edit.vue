<template>
  <v-container fluid>
    <v-row>
      <v-col cols="12" md="12" sm="12">
        <v-card>

          <v-toolbar class="header_title" color="#0007a5" dark>
            <v-row>
              <h3 class="mt-2" style="padding-right:13px">
                تعديل بيانات تخصص الشركاء </h3>
              <v-col style="padding-left:20px">
              </v-col>
            </v-row>
          </v-toolbar>
          <v-card-text class="grey lighten-5 mt-3">
            <v-row class="match-height">
              <v-col
                cols="12"
                md="12"
              >
                <v-card>
                  <v-card-title> بيانات التخصص</v-card-title>
                  <v-card-text>
                    <v-form class="multi-col-validation" @submit.prevent="submit">
                      <v-row>
                        <v-col
                          cols="12"
                          md="6"
                        >
                          <v-text-field
                            v-model="form.name"
                            :error-messages="$page.props.errors.name"
                            dense
                            label="إسم تخصص الشركاء"
                            outlined
                            placeholder="إسم تخصص الشركاء"
                          ></v-text-field>
                        </v-col>
                        <v-col cols="12">
                          <v-btn :loading="form.processing"
                                 class=" mx-2 v-btn v-btn--is-elevated v-btn--has-bg theme--dark v-size--default  "
                                 color="#0007a5" type="submit"
                          >
                            تحديث
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
  name: "Edit",
  props: {
    category: Object,
  },
  data() {
    return {
      form: this.$inertia.form({
        name: this.category.name,
        id: this.category.id,

      }),
      isPasswordVisible: null,
    }
  },
  methods: {
    submit() {
      this.form.put('/admin/parent_categories/' + this.form.id)
    }, reset() {
      this.form.reset()
    }
  }
}
</script>

<style scoped>

</style>
