<template>
  <section class="white">

    <v-container>
      <h1 class="mb-5 mt-5" style="text-align:center;color:#2196f3">بيانات المستخدم
        {{ user.name }}
      </h1>
      <v-row class="justify-center" dense>
        <v-col lg="9">
          <div class="card">
            <v-row dense>
              <v-col cols="12" sm="4">
                <div class="card-right text-center">
                  <img v-if="user.image" :src="`/get_file/user_images/${user.image}`"
                       alt="" class="avatar mb-1">
                  <img v-else :src="require('@/assets/images/avatars/1.png').default"
                       alt="" class="avatar mb-1">

                  <h2 class="white--text mb-1">{{ user.name }}</h2>
                  <h4 class="white--text">{{ user.job_title }}</h4>
                </div>
              </v-col>
              <v-col cols="12" sm="8">
                <div class="card-left px-2 py-3">
                  <v-row dense>
                    <v-col cols="4">
                      <h4 class="title mb-3">البريد الإلكتروني</h4>
                      <h5 class="sub_title"> {{ user.email ? user.email : 'غير مدخل' }}</h5>
                    </v-col>
                    <v-col class="ps-lg-5" cols="4">
                      <h4 class="title mb-3">رقم الواتس اب</h4>
                      <h5 class="sub_title">
                        {{ user.whatsapp_number ? user.whatsapp_number : 'غير مدخل' }}</h5>
                    </v-col>
                    <v-col class="ps-lg-5" cols="4">
                      <h4 class="title mb-3">الدولة</h4>
                      <h5 class="sub_title">{{ user.country ? user.country.name_ar : 'غير مدخل' }}
                        -
                        {{ user.city ? user.city : 'غير مدخل' }}</h5>
                    </v-col>
                  </v-row>
                  <v-divider class="my-2"/>
                  <v-row dense>
                    <v-col cols="4">
                      <h4 class="title mb-3">التخصص </h4>
                      <h5 class="sub_title"> {{ user.category.name_ar }}</h5>
                    </v-col>
                    <v-col class="ps-lg-5" cols="4">
                      <h4 class="title mb-3">الحالة </h4>
                      <h5 class="sub_title">
                        {{ user.status == 1 ? 'مجمد' : 'مفعل ' }}</h5>
                    </v-col>
                    <v-col class="ps-lg-5" cols="4">
                      <h4 class="title mb-3">تاريخ الانشاء</h4>
                      <h5 class="sub_title">{{ user.created_at }} {{ timezone }}
                      </h5>
                    </v-col>
                  </v-row>

                </div>
              </v-col>
            </v-row>
          </div>
        </v-col>
      </v-row>

    </v-container>
  </section>
</template>
<script>
import swal from "sweetalert";

export default {
  props: {
    user: Object,
    timezone: String
  },
  data: () => ({
    loading: false,
    selection: 1,
  }),

  methods: {
    reserve() {
      this.loading = true

      setTimeout(() => (this.loading = false), 2000)
    },
    go(url) {
      if (url == null) {
        swal({
          title: 'حدث خطا ما',
          text: 'غير مدخل',
          icon: 'error',
          buttons: false,
          timer: 3000,
        });
      } else {
        window.open(url)

      }
    }
  },
}
</script>
<style lang="scss">

.title {
  color: #1668B7;

}

.sub_title {
  color: black;
}

.card {
  border: 1px solid #e1e1e1;
  border-radius: 4px;
}

.card-right {
  background: linear-gradient(262.28deg, #1668B7 0%, #07A1E0 98.24%);
  border-radius: 0 5px 5px 0;
  padding: 30px 10px 80px;
  height: 100%;

  .avatar {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    object-fit: cover;
  }
}

.social-media {
  list-style: none;
  padding: 0;
  margin: 0;
  display: flex;
  align-items: ceil($number: 0);

  li {
    &:not(:last-of-type) {
      margin-inline-end: 10px;
    }

    a {
      text-decoration: none;
      display: flex;
      align-items: center;
      justify-content: center;
      width: 34px;
      border-radius: 50%;
      height: 34px;
      border: 1px solid #EEE;

      i {
        color: #858585 !important;
        font-size: 21px !important;
      }

      &:hover {
        background-color: #1275c0;

        i {
          color: #FFF !important;
        }
      }
    }
  }
}

.price {
  h2 {
    font-size: 34px;
  }

  h5 {
    font-size: 18px;
    color: rgb(41, 41, 41);
  }
}
</style>
