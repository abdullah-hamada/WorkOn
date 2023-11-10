<template>
  <v-container fluid>
    <v-row>
      <v-col cols="12" md="12" sm="12">
        <v-card>

          <v-toolbar class="header_title" color="#0007a5" dark>
            <v-row>
              <h3 class="mt-2" style="padding-right:13px">
                إضافة مشترك جديد
              </h3>
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
                  <v-card-title> بيانات المشترك</v-card-title>
                  <v-card-text>
                    <v-form class="multi-col-validation" @submit.prevent="submit">
                      <v-row>
                        <v-col
                          cols="12"
                          md="6"
                        >
                          <v-text-field
                            v-model="form.username"
                            :error-messages="$page.props.errors.username"
                            dense
                            label="الإسم"
                            outlined
                            placeholder="الإسم"
                            prepend-inner-icon="mdi-account-details-outline"
                          ></v-text-field>
                        </v-col>
                        <v-col
                          cols="12"
                          md="6"
                        >
                          <v-text-field
                            v-model="form.email"
                            :error-messages="$page.props.errors.email"
                            dense
                            label="البريد الإلكتروني"
                            outlined
                            placeholder="البريد الإلكتروني"
                            prepend-inner-icon="mdi-email-multiple-outline"
                          ></v-text-field>
                        </v-col>
                        <v-col
                          cols="12"
                          md="6"
                        >
                          <v-select v-model="form.country_id"
                                    :error-messages="$page.props.errors.country_id"
                                    :items="countries"
                                    :menu-props="{ contentClass: 'v-select-menu' }" dense
                                    item-text="name_ar"
                                    item-value="id" label="الدولة"
                                    outlined

                                    prepend-inner-icon="mdi-home-city"
                          ></v-select>
                        </v-col>
                        <v-col
                          cols="12"
                          md="6"
                        >
                          <v-select v-model="form.category_id"
                                    :error-messages="$page.props.errors.category_id"
                                    :items="categories"
                                    :menu-props="{ contentClass: 'v-select-menu' }" dense
                                    item-text="name_ar"
                                    item-value="id" label="التخصص"
                                    outlined
                                    prepend-inner-icon="mdi-account-school"
                          ></v-select>
                        </v-col>
                        <v-col
                          cols="12"
                          md="6"
                        >
                          <v-text-field
                            v-model="form.whatsapp_number"
                            :error-messages="$page.props.errors.whatsapp_number"
                            dense
                            label="رقم الواتس اب"
                            outlined
                            placeholder="رقم الواتس اب"
                            prepend-inner-icon="mdi-whatsapp"
                          ></v-text-field>
                        </v-col>
                        <v-col
                          cols="12"
                          md="6"
                        >
                          <v-text-field
                            v-model="form.password"
                            :append-icon="isPasswordVisible ? 'mdi-eye-off-outline' : 'mdi-eye'"
                            :error-messages="$page.props.errors.password"
                            :type="isPasswordVisible ? 'text' : 'password'"
                            dense
                            label="كلمة المرور"
                            outlined
                            placeholder="كلمة المرور"
                            prepend-inner-icon="mdi-lock-outline"
                            @click:append="isPasswordVisible = !isPasswordVisible"
                          ></v-text-field>
                        </v-col>
                        <v-col
                          cols="12"
                          md="6"
                        >
                          <v-select
                            v-model="form.role_id" :error-messages="$page.props.errors.role_id"
                            :items="roles"
                            dense
                            item-text="name"
                            item-value="id"
                            label="الدور"
                            outlined
                            prepend-inner-icon="mdi-account-question-outline"
                          ></v-select>
                        </v-col>
                        <v-col cols="12">
                          <v-btn :loading="form.processing"
                                 class=" mx-2 v-btn v-btn--is-elevated v-btn--has-bg theme--dark v-size--default  "
                                 color="#0007a5"
                                 type="submit">
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
    roles: Array,
    categories: Array,
    countries: Array
  },
  data() {
    return {
      form: this.$inertia.form({
        username: null,
        email: null,
        password: null,
        whatsapp_number: null,
        role_id: null,
        category_id: null,
        country_id: null
      }),
      isPasswordVisible: null,

    }
  },
  methods: {
    submit() {
      this.form.post('/admin/users')
    }, reset() {
      this.form.reset()
    }
  }
}
</script>


