<template>
  <v-container fluid>
    <v-row>
      <v-col cols="12" md="12" sm="12">
        <v-card>

          <v-toolbar class="header_title" color="#0007a5" dark>
            <v-row>
              <h3 class="mt-2" style="padding-right:13px">
                تعديل بيانات المدرب </h3>
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
                  <v-card-title> بيانات المدرب</v-card-title>
                  <v-card-text>
                    <v-form class="multi-col-validation" @submit.prevent="submit">

                      <div class="text-center  mb-5">
                        <div class="image-input">
                          <div
                            :style="
                                  form.preview_image != undefined
                                    ? { 'background-image': `url(${ form.preview_image})` }
                                    : { 'background-image': `url(${ form.preview_image})` }
                                "
                            class="image-input-wrapper"
                          ></div>

                          <label class="btn-icon btn-add" data-original-title="Change avatar">
                            <svg
                              height="12"
                              viewBox="0 0 512 512"
                              width="12"
                              xmlns="http://www.w3.org/2000/svg"
                            >
                              <path
                                d="M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1v32c0 8.8 7.2 16 16 16h32zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z"
                                fill="#6e6d6d"/>
                            </svg>
                            <input
                              accept=".png, .jpg, .jpeg"
                              name="profile_avatar"
                              type="file"
                              @change="previewImage($event)"
                            />

                            <input name="profile_avatar_remove" type="hidden"/>
                          </label>
                        </div>
                        <div v-if="$page.props.errors['image']"
                             class="error--text">{{ $page.props.errors['image'] }}
                        </div>
                      </div>


                      <v-row>
                        <v-col
                          cols="12"
                          md="6"
                        >
                          <v-text-field
                            v-model="form.name"
                            :error-messages="$page.props.errors.name"
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
                            v-model="form.job_title"
                            :error-messages="$page.props.errors.job_title"
                            dense
                            label="المسمى "
                            outlined
                            placeholder="المسمى"
                            prepend-inner-icon="mdi-playlist-edit"
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
                          <v-text-field
                            v-model="form.mobile"
                            :error-messages="$page.props.errors.mobile"
                            dense
                            label="رقم   الجوال"
                            outlined
                            placeholder="رقم الجوال  "
                            prepend-inner-icon="mdi-phone"

                          ></v-text-field>
                        </v-col>

                        <v-col
                          cols="12"
                          md="6"
                        >
                          <v-text-field
                            v-model="form.facebook_url"
                            :error-messages="$page.props.errors.facebook_url"
                            dense
                            label="رابط الفيس بوك"
                            outlined
                            placeholder="رابط الفيس بوك"
                            prepend-inner-icon="mdi-facebook"

                          ></v-text-field>
                        </v-col>
                        <v-col
                          cols="12"
                          md="6"
                        >
                          <v-text-field
                            v-model="form.instagram_url"
                            :error-messages="$page.props.errors.instagram_url"
                            dense
                            label="رابط الانستقرام"
                            outlined
                            placeholder="رابط الانستقرام"
                            prepend-inner-icon="mdi-instagram"

                          ></v-text-field>
                        </v-col>
                        <v-col
                          cols="12"
                          md="6"
                        >
                          <v-text-field
                            v-model="form.twitter_url"
                            :error-messages="$page.props.errors.twitter_url"
                            dense
                            label="رابط التويتر"
                            outlined
                            placeholder="رابط التويتر"
                            prepend-inner-icon="mdi-twitter"

                          ></v-text-field>
                        </v-col>
                        <v-col
                          cols="12"
                          md="6"
                        >
                          <v-text-field
                            v-model="form.linked_in_url"
                            :error-messages="$page.props.errors.linked_in_url"
                            dense
                            label="رابط اللينكد ان"
                            outlined
                            placeholder="رابط اللينكد ان"
                            prepend-inner-icon="mdi-linkedin"

                          ></v-text-field>
                        </v-col>
                        <v-col
                          cols="12"
                          md="6"
                        >
                          <v-text-field
                            v-model="form.website_url"
                            :error-messages="$page.props.errors.website_url"
                            dense
                            label="رابط الموقع الالكتروني"
                            outlined
                            placeholder="رابط الموقع الالكتروني  "
                            prepend-inner-icon="mdi-web"

                          ></v-text-field>
                        </v-col>
                        <v-col
                          cols="12"
                        >
                          <v-textarea
                            v-model="form.description"
                            :error-messages="$page.props.errors.description"
                            label="نبذة عن المدرب"
                            outlined
                            prepend-inner-icon="mdi-comment"
                            rows="5"
                          ></v-textarea>
                        </v-col>

                        <v-col cols="12">
                          <v-btn :loading="form.processing"
                                 class=" mx-2 v-btn v-btn--is-elevated v-btn--has-bg theme--dark v-size--default  "
                                 color="#0007a5"
                                 type="submit">
                            تحديث
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
  name: "Edit",
  props: {
    trainer: Object,
  },
  data() {
    return {
      form: this.$inertia.form({
        name: this.trainer.name,
        email: this.trainer.email,
        job_title: this.trainer.job_title,
        mobile: this.trainer.mobile,
        description: this.trainer.description,
        id: this.trainer.id,
        preview_image: this.trainer.preview_image,
        image: null,
        linked_in_url: this.trainer.linked_in_url,
        facebook_url: this.trainer.facebook_url,
        twitter_url: this.trainer.twitter_url,
        instagram_url: this.trainer.instagram_url,
        website_url: this.trainer.website_url
      }),
    }
  },
  methods: {
    submit() {
      this.form.post('/admin/trainers/' + this.form.id + '/update')
    },
    reset() {
      this.form.reset()
    },
    previewImage(event) {
      var input = event.target;
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = (e) => {
          this.form.preview_image = e.target.result;
          this.form.image = input.files[0];
        };
        reader.readAsDataURL(input.files[0]);
      }
    },

  }
}
</script>

<style lang="scss">
.image-input {
  //margin: 60px 100px;
  position: relative;
  display: inline-block;
  border-radius: 0.42rem;
  background-repeat: no-repeat;
  background-size: cover;

  .image-input-wrapper {
    width: 120px;
    height: 120px;
    border-radius: 0.42rem;
    background-repeat: no-repeat;
    background-size: cover;
    border: 3px solid #ffffff;
    -webkit-box-shadow: 0 0.5rem 1.5rem 0.5rem rgba(0, 0, 0, 0.075);
    box-shadow: 0 0.5rem 1.5rem 0.5rem rgba(0, 0, 0, 0.075);
    color: #3f4254;
    background-color: #ffffff;
    border-color: #ffffff;
    display: -webkit-inline-box;
    display: -ms-inline-flexbox;
    display: inline-flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    justify-content: center;
    padding: 0;
    font-size: 1rem;
    font-weight: 400;
    outline: none !important;
    vertical-align: middle;
  }

  input {
    width: 0 !important;
    height: 0 !important;
    overflow: hidden;
    opacity: 0;
  }

  .btn-icon {
    -webkit-box-shadow: 0px 9px 16px 0px rgba(24, 28, 50, 0.25) !important;
    box-shadow: 0px 9px 16px 0px rgba(24, 28, 50, 0.25) !important;
    border-radius: 50%;
    height: 24px;
    width: 24px;
    background-color: #fff;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;

    &.btn-add {
      position: absolute;
      right: -10px;
      top: -10px;
    }

    &.btn-remove {
      position: absolute;
      right: -10px;
      bottom: -5px;
    }
  }
}
</style>
