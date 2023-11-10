<template>
  <v-container fluid>
    <v-row>
      <v-col cols="12" md="12" sm="12">
        <v-card>

          <v-toolbar class="header_title" color="#0007a5" dark>
            <v-row>
              <h3 class="mt-2" style="padding-right:13px">
                تعديل بيانات الشريك </h3>
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
                  <v-card-title> بيانات الشريك</v-card-title>
                  <v-card-text>
                    <div class="content-form">
                      <v-row>
                        <v-col cols="12" lg="3" md="4" sm="6">
                          <v-text-field v-model="form.company_name"
                                        :error-messages="$page.props.errors.company_name"
                                        label="اسم المؤسسة"
                                        outlined
                                        prepend-icon="mdi-rename"
                          ></v-text-field>
                        </v-col>
                        <v-col cols="12" lg="3" md="4" sm="6">
                          <v-text-field v-model="form.employment_filed"
                                        :error-messages="$page.props.errors.employment_filed"
                                        label="مجال العمل"
                                        outlined prepend-icon="mdi-format-list-bulleted"
                          ></v-text-field>
                        </v-col>
                        <v-col cols="12" lg="3" md="4" sm="6">
                          <v-select v-model="form.partner_category_id"
                                    :error-messages="$page.props.errors.partner_category_id"
                                    :items="partner_categories"
                                    item-text="name"
                                    item-value="id"
                                    label="التصنيف"
                                    outlined
                                    prepend-icon="mdi-format-list-numbered-rtl"
                          ></v-select>
                        </v-col>

                        <v-col cols="12" lg="3" md="4" sm="6">
                          <v-text-field v-model="form.website_url"
                                        :error-messages="$page.props.errors.website_url"
                                        label="الموقع الإلكتروني"
                                        outlined prepend-icon="mdi-web"
                          ></v-text-field>
                        </v-col>
                        <v-col cols="12" lg="3" md="4" sm="6">
                          <v-text-field v-model="form.facebook_url"
                                        :error-messages="$page.props.errors.facebook_url"

                                        label="حساب الفيسبوك"
                                        outlined prepend-icon="mdi-facebook"
                          ></v-text-field>
                        </v-col>
                        <v-col cols="12" lg="3" md="4" sm="6">
                          <v-text-field v-model="form.twitter_url"
                                        :error-messages="$page.props.errors.twitter_url"
                                        label="حساب تويتر"
                                        outlined prepend-icon="mdi-twitter"
                          ></v-text-field>
                        </v-col>
                        <v-col cols="12" lg="3" md="4" sm="6">
                          <v-text-field v-model="form.linked_in_url"
                                        :error-messages="$page.props.errors.linked_in_url"
                                        label="حساب لينكدان"
                                        outlined prepend-icon="mdi-twitter"
                          ></v-text-field>
                        </v-col>
                        <v-col cols="12" lg="3" md="4" sm="6">
                          <v-text-field v-model="form.instagram_url"
                                        :error-messages="$page.props.errors.instagram_url"
                                        label="حساب انستجرام"
                                        outlined prepend-icon="mdi-instagram"
                          ></v-text-field>
                        </v-col>
                        <v-col cols="12" lg="3" md="4" sm="6">
                          <v-file-input v-model="form.logo"
                                        :error-messages="$page.props.errors.logo"
                                        label="الشعار" outlined
                                        prepend-icon="mdi-image-size-select-actual"></v-file-input>
                        </v-col>
                        <v-col cols="12" lg="3" md="4" sm="6">
                          <v-text-field v-model="form.slugn"
                                        :error-messages="$page.props.errors.slugn"
                                        label="السلوجن" outlined
                                        prepend-icon="mdi-tag-text"></v-text-field>
                        </v-col>
                        <v-col cols="12" lg="3" md="4" sm="6">
                          <v-text-field v-model="form.communication_officer"
                                        :error-messages="$page.props.errors.communication_officer"
                                        label="مسؤول التواصل"
                                        outlined
                                        prepend-icon="mdi-account"
                          ></v-text-field>
                        </v-col>
                        <v-col cols="12" lg="3" md="4" sm="6">
                          <v-text-field v-model="form.whatsapp_number"
                                        :error-messages="$page.props.errors.whatsapp_number"
                                        label="رقم الواتس اب"
                                        outlined
                                        prepend-icon="mdi-whatsapp"
                          ></v-text-field>
                        </v-col>
                        <v-col cols="12" lg="3" md="4" sm="6">
                          <v-text-field v-model="form.email"
                                        :error-messages="$page.props.errors.email"
                                        label="البريد الإلكتروني"
                                        outlined
                                        prepend-icon="mdi-email"
                          ></v-text-field>
                        </v-col>
                        <v-col cols="12" lg="3" md="4" sm="6">
                          <v-select v-model="form.country_id"
                                    :error-messages="$page.props.errors.country_id"
                                    :items="countries"
                                    item-text="name_ar" item-value="id"
                                    label="الدولة"
                                    outlined
                                    prepend-icon="mdi-home"
                          ></v-select>
                        </v-col>
                        <v-col cols="12" lg="3" md="4" sm="6">
                          <v-text-field v-model="form.city"
                                        :error-messages="$page.props.errors.city"
                                        label="المدينة"
                                        outlined
                                        prepend-icon="mdi-home-city"
                          ></v-text-field>
                        </v-col>
                        <v-col cols="12" lg="3" md="4" sm="6">
                          <v-text-field v-model="form.address"
                                        :error-messages="$page.props.errors.address"
                                        label="العنوان"
                                        outlined
                                        prepend-icon="mdi-office-building-marker"
                          ></v-text-field>
                        </v-col>
                        <v-col cols="12">
                          <v-textarea v-model="form.company_info"
                                      :error-messages="$page.props.errors.company_info"
                                      label="تعريف عن المؤسسة"
                                      outlined prepend-icon="mdi-text"></v-textarea>
                        </v-col>
                        <v-col class="my-4" cols="12">
                          <v-divider/>
                        </v-col>
                        <v-col cols="12">
                          <div class="d-flex align-center">
                            <h4>الفروع</h4>
                            <button class="btn btn-primary mx-5 btn-small"
                                    @click="add_new_branch_row()">
                              <v-icon color="white">mdi-plus</v-icon>
                              أضف
                            </button>
                          </div>
                        </v-col>
                        <v-row v-for="(item , index) in form.branches"
                               :key="item" class="px-3 row-repeat position-relative">
                          <v-col cols="12" lg="3" md="4" sm="6">
                            <v-text-field v-model="item.name"
                                          :error-messages="$page.props.errors['branches.' + index + '.title']"
                                          label="الفرع"

                                          outlined
                                          prepend-icon="mdi-alpha-b-box"
                            ></v-text-field>
                          </v-col>

                          <v-col cols="12" lg="3" md="4" sm="6">
                            <v-text-field
                              v-model="item.address"
                              :error-messages="$page.props.errors['branches.' + index + '.address']"
                              label="العنوان"
                              outlined

                              prepend-icon="mdi-office-building-marker"
                            ></v-text-field>
                          </v-col>
                          <v-col cols="12" lg="3" md="4" sm="6">
                            <v-text-field
                              v-model="item.location"
                              :error-messages="$page.props.errors['branches.' + index + '.location']"
                              label="اللوكيشن"
                              outlined

                              prepend-icon="mdi-map-marker-outline"
                            ></v-text-field>
                            <div class="row-repeat-delete" @click="delete_branch_item(index)">
                              <v-icon color="white">mdi-close</v-icon>
                            </div>

                          </v-col>
                        </v-row>
                        <v-col class="my-4" cols="12">
                          <v-divider/>
                        </v-col>
                        <v-col cols="12">
                          <div class="d-flex align-center">
                            <h4>الخدمات</h4>
                            <button class="btn btn-primary mx-5 btn-small"
                                    @click="add_new_service_row()">
                              <v-icon color="white">mdi-plus</v-icon>
                              أضف
                            </button>
                          </div>
                        </v-col>
                        <v-row v-for="(item , index) in form.services"
                               :key="item" class="px-3 row-repeat position-relative">
                          <v-col cols="12" lg="3" md="4" sm="6">
                            <v-text-field v-model="item.name"
                                          :error-messages="$page.props.errors['services.' + index + '.name']"
                                          label="اسم الخدمة"

                                          outlined
                                          prepend-icon="mdi-rename-outline"
                            ></v-text-field>
                          </v-col>
                          <v-col cols="12" lg="3" md="4" sm="6">
                            <v-text-field v-model="item.price"
                                          :error-messages="$page.props.errors['services.' + index + '.price']"
                                          label="سعر الخدمة بالدولار"
                                          outlined
                                          prepend-icon="mdi-account-credit-card"
                                          type="number"
                            ></v-text-field>
                          </v-col>
                          <v-col cols="12" lg="3" md="4" sm="6">
                            <v-text-field v-model="item.discount"
                                          :error-messages="$page.props.errors['services.' + index + '.discount']"
                                          label="نسبة الخصم  مثال 10%"
                                          outlined
                                          prepend-icon="mdi-percent-outline"
                                          type="number"
                                          @change="get_final_price(item)"
                            ></v-text-field>
                          </v-col>
                          <v-col cols="12" lg="3" md="4" sm="6">
                            <v-text-field v-model="item.final_price"
                                          :error-messages="$page.props.errors['services.' + index + '.final_price']"
                                          label="السعر النهائي"
                                          outlined
                                          prepend-icon="mdi-account-credit-card"
                                          type="number"
                            ></v-text-field>
                          </v-col>
                          <div class="row-repeat-delete" @click="delete_service_item(index)">
                            <v-icon color="white">mdi-close</v-icon>
                          </div>
                        </v-row>


                        <v-col class="text-center" cols="12">
                          <button :disabled="form.processing" class="btn btn-primary "
                                  @click="submit">تعديل
                          </button>
                        </v-col>
                      </v-row>
                    </div>

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
  name: "Partner",
  props: {
    countries: Array, partner_categories: Array, partner_order: Object

  },
  data() {
    return {
      form: this.$inertia.form({
        email: this.partner_order.email,
        whatsapp_number: this.partner_order.whatsapp_number,
        country_id: this.partner_order.country_id,
        city: this.partner_order.city,
        partner_category_id: this.partner_order.partner_category_id,
        company_name: this.partner_order.company_name,
        employment_filed: this.partner_order.employment_filed,
        company_info: this.partner_order.company_info,
        website_url: this.partner_order.website_url,
        facebook_url: this.partner_order.twitter_url,
        twitter_url: this.partner_order.twitter_url,
        instagram_url: this.partner_order.instagram_url,
        linked_in_url: this.partner_order.linked_in_url,
        logo: null,
        slugn: this.partner_order.slugn,
        communication_officer: this.partner_order.communication_officer,
        address: this.partner_order.address,
        branches: this.partner_order.branches,
        services: this.partner_order.services,
      })
    }
  },
  methods: {
    add_new_branch_row() {
      this.form.branches.push({
        name: null,
        address: null,
        location: null,
        type: 'new'

      })
    },
    delete_branch_item(index) {
      this.form.branches.splice(index, 1)
    },
    add_new_service_row() {
      this.form.services.push({
        name: null,
        price: null,
        discount: null,
        final_price: null,
        type: 'new'
      })
    },
    delete_service_item(index) {
      this.form.services.splice(index, 1)
    },

    submit() {
      this.form.post('/dashboard/partner/update_order_info')
    },
    get_final_price(item) {
      item.final_price = item.price - (item.price * (item.discount / 100))
    }
  }

}
</script>

<style lang="scss">

.content-form {
  background: #a213000a;
  padding: 35px 35px;
  border-radius: 20px;
  @media(max-width: 991px) {
    padding: 20px;
  }

  .btn-primary {
    background-color: #190ad5;
    color: #FFF;
    padding: 12px 30px;
    border-radius: 4px;

    &.btn-small {
      padding: 3px 7px;
    }
  }

  .v-text-field.v-text-field--enclosed .v-text-field__details {
    //  display: none;
  }

  .v-input {
    fieldset {
      border: 0;
      background-color: #FFF;
    }

    .v-input__prepend-outer {
      position: absolute;
      z-index: 1;
      inset-inline-start: 8px;
    }

    .v-input__slot {
      .v-text-field__slot {
        padding-inline-start: 25px !important;
      }

      .v-label {
        padding-inline-start: 25px !important;
      }
    }
  }

  .btn-small {
    padding: 3px 7px;
  }

  .row-repeat-delete {
    background: #ef0f0f;
    cursor: pointer;
    position: absolute;
    top: 26px;
    inset-inline-end: -5px;
    @media(max-width: 991px) {
      top: -30px;
      inset-inline-end: 25px;
    }
  }
}

html.dark {
  .content-form {
    background: #ffffff0f;

    .v-input--checkbox .theme--light.v-label {
      color: rgb(255 255 255 / 60%);
    }
  }
}

.section .text-h4 {
  font-family: "Tajawal", sans-serif !important;
}

</style>
