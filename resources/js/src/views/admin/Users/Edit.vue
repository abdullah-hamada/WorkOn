<template>
  <v-container fluid>
    <v-row>
      <v-col cols="12" md="12" sm="12">
        <v-card>

          <v-toolbar class="header_title" color="#0007a5" dark>
            <v-row>
              <h3 class="mt-2" style="padding-right:13px">
                تعديل بيانات المستخدم </h3>
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
                  <v-card-title> بيانات المستخدم</v-card-title>
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
                            placeholder="············"
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
                            label="الأدوار"
                            outlined
                            prepend-inner-icon="mdi-account-question-outline"
                          ></v-select>
                        </v-col>
                        <v-col cols="12">
                          <v-btn :loading="form.processing"
                                 class=" mx-2 v-btn v-btn--is-elevated v-btn--has-bg theme--dark v-size--default  "
                                 color="#0007a5"
                                 type="submit">
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
  name: "Create",
  props: {
    user: Object,
    roles: Array,
    categories: Array,
    countries: Array

  },
  data() {
    return {
      form: this.$inertia.form({
        username: this.user.name,
        email: this.user.email,
        password: null,
        whatsapp_number: this.user.whatsapp_number,
        role_id: this.user.roles[0]['id'],
        id: this.user.id,
        category_id: this.user.category_id,
        country_id: this.user.country_id,

      }),
      isPasswordVisible: null,
    }
  },
  methods: {
    submit() {
      this.form.put('/admin/users/' + this.form.id)
    }, reset() {
      this.form.reset()
    }
  }
}
</script>

<style scoped>
.v-select-menu.v-menu__content {
  overflow-y: auto;
  overflow-x: hidden;
  contain: content;
}

</style>
