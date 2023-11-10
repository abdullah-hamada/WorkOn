<template>
  <v-app>
    <section class=" pt-5">
      <v-row class="match-height">
        <!-- horizontal -->
        <v-col
          cols="12"
          md="12"
        >
          <v-card>
            <v-card-title class="mb-2" style="color:black !important">تعديل بيانات الملف الشخصي :
              {{ user.name }}
            </v-card-title>
            <v-form class="multi-col-validation" @submit.prevent="submit">

              <v-card-text>
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
                      prepend-inner-icon="mdi-account"
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
                      prepend-inner-icon="mdi-email"
                    ></v-text-field>
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

                    <v-select
                      v-model="form.country_id" :error-messages="$page.props.errors.country_id"
                      :items="countries"
                      dense
                      item-text="name_ar"
                      item-value="id"
                      label="الدولة  "
                      outlined
                      prepend-inner-icon="mdi-toy-brick-marker-outline"
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
                              item-value="id"
                              label="التخصص" outlined
                              prepend-inner-icon="mdi-account-school"
                    ></v-select>

                  </v-col>

                  <v-col cols="6">
                    <v-file-input v-model="form.image" :error-messages="$page.props.errors.image"
                                  dense label="الصورة الشخصية"
                                  outlined prepend-icon=""
                                  prepend-inner-icon="mdi-image-plus"
                                  type="file"

                                  @change="onFileChange"/>
                  </v-col>
                  <v-col
                    cols="12"
                    md="6"
                  >
                    <v-text-field
                      v-model="form.password" :error-messages="$page.props.errors.password"
                      dense
                      label="كلمة المرور"
                      outlined
                      placeholder="كلمة المرور"
                      prepend-inner-icon="mdi-lock"
                      type="password"
                    ></v-text-field>
                  </v-col>


                </v-row>
                <v-row>
                  <v-col cols="6">
                    <v-btn :loading="form.processing"
                           class=" mx-2 v-btn v-btn--is-elevated v-btn--has-bg theme--dark v-size--default  "
                           color="#0007a5"
                           type="submit">
                      <v-icon>
                        mdi-account-edit-outline
                      </v-icon>
                      تحديث
                    </v-btn>

                  </v-col>
                </v-row>
              </v-card-text>
            </v-form>

          </v-card>
        </v-col>


      </v-row>


    </section>


  </v-app>
</template>

<script>

export default {
  name: "Create",
  props: {
    user: Object,
    countries: Array,
    categories: Array,
    last_subscribe_info: Object
  },
  data() {
    return {
      form: this.$inertia.form({
        username: this.user.name,
        email: this.user.email,
        whatsapp_number: this.user.whatsapp_number,
        image: null,
        category_id: parseInt(this.user.category_id),
        country_id: parseInt(this.user.country_id),
        user_type: this.user.user_type,
        imageUrl: '',
        password: null
      }),
      isPasswordVisible: null,

    }
  },
  methods: {
    submit() {
      this.form.post('/profile', {
        onSuccess: () => [
          this.$root.$emit('ChangeImage')
        ]
      })
    },
    createImage(file) {
      const reader = new FileReader();

      reader.onload = (e) => {
        this.form.imageUrl = e.target.result;
      };
      reader.readAsDataURL(file);
    },
    onFileChange(file) {
      if (!file) {
        return;
      }
      this.createImage(file);
    }
  }
}
</script>

<style>
.v-list-item--dense .v-list-item__title,
.v-list-item--dense .v-list-item__subtitle,
.v-list--dense .v-list-item .v-list-item__title,
.v-list--dense .v-list-item .v-list-item__subtitle {
  font-size: 0.8125rem;
  font-weight: 500;
  line-height: 2rem;
}
</style>
