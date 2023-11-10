<template>
  <div>

    <v-tabs
      v-model="tab"
      background-color="white"
      dark
      fixed-tabs
    >
      <v-tab active-class="active" style="color:blue">
        عرض الدورات الافتراضي
      </v-tab>
      <v-tab active-class="active" style="color:blue">
        عرض الدورات على شكل تقويم
      </v-tab>

      <v-tab active-class="active" style="color:blue">
        عرض الدورات على شكل جدول
      </v-tab>
      <div>
        <Link
          class="mx-2 mt-1 v-btn v-btn--is-elevated v-btn--has-bg theme--dark v-size--default "
          dark
          href="/admin/courses/create"
          style="background-color: #0007a5;  color: white;"
        >
          إضافة دورة جديدة
        </Link>
      </div>

    </v-tabs>
    <v-tabs-items v-model="tab">
      <v-tab-item
      >
        <v-card
          color="basil"
          flat
        >
          <section class="py-7 white">
            <v-container>
              <v-row class="align-center" dense>
                <v-col v-for="course in courses_data.data" :key="course.id" cols="12" lg="4">
                  <div class="popular-jobs-container fill-height d-flex flex-column">
                    <div class="popular-jobs-box mb-auto">
                      <h4 v-if="course.price_type == 1" class="flc-rate">
                        {{ course.price_after_discount }}
                        $ </h4>
                      <h4 v-if="course.price_type == 1" class="popular-jobs-status bg-warning">
                        مدفوع</h4>
                      <h4 v-else class="popular-jobs-status bg-success">مجاني</h4>
                      <div class="popular-jobs-box">
                        <div class="popular-jobs-box-detail">
                          <v-img :src="`/get_file/course_logos/${course.image}`"
                                 alt=""
                                 class="w-100"
                                 style="border-radius: 50%;height:115px;width:126px; margin:auto"></v-img>
                        </div>
                      </div>
                      <div class="popular-jobs-box">
                        <div class="popular-jobs-box-detail">
                          <h3>{{ course.title }} </h3>
                        </div>
                      </div>
                      <v-row class="mb-1" dense>
                        <v-col cols="4">
                          <div class="d-flex align-center justify-center">
                            <v-icon small>mdi-clock-time-five-outline</v-icon>
                            <h5 class="mr-1">{{ course.date_from_in_time_zone }} {{ timezone }}</h5>
                          </div>
                        </v-col>
                        <v-col cols="4">
                          <div class="d-flex align-center justify-center">
                            <v-icon small>mdi-flag-variant-outline</v-icon>
                            <h5 v-if="course.location_type == 1" class="mr-1">حضوري</h5>
                            <h5 v-else class="mr-1"> أونلاين</h5>

                          </div>
                        </v-col>
                        <v-col cols="4">
                          <div class="d-flex align-center justify-center">
                            <v-icon small>mdi-account-group</v-icon>
                            <h5 class="mr-1">{{ course.subscriber_users_count }}</h5>
                          </div>
                        </v-col>
                      </v-row>
                    </div>
                    <a :href="`/course/${course.id}`" class="btn btn-popular-jobs bt-1"
                       target="_blank">مشاهدة التفاصيل</a>
                  </div>
                </v-col>
              </v-row>
              <div class="text-center">
                <v-pagination
                  v-model="pagination.current"
                  :length="pagination.total"
                  @input="onPageChange"
                ></v-pagination>
              </div>

            </v-container>
          </section>
        </v-card>
      </v-tab-item>
      <v-tab-item
      >
        <v-card
          color="basil"
          flat
        >
          <v-row class="fill-height">
            <v-col>
              <v-sheet height="64">
                <v-toolbar
                  flat
                >
                  <v-btn
                    class="mr-4"
                    color="grey darken-2"
                    outlined
                    @click="setToday"
                  >
                    اليوم
                  </v-btn>
                  <v-btn
                    color="grey darken-2"
                    fab
                    small
                    text
                    @click="prev"
                  >
                    <v-icon small>
                      mdi-chevron-left
                    </v-icon>
                  </v-btn>
                  <v-btn
                    color="grey darken-2"
                    fab
                    small
                    text
                    @click="next"
                  >
                    <v-icon small>
                      mdi-chevron-right
                    </v-icon>
                  </v-btn>
                  <v-toolbar-title v-if="$refs.calendar">
                    {{ $refs.calendar.title }}
                  </v-toolbar-title>
                  <v-spacer></v-spacer>
                  <v-menu
                    bottom
                    right
                  >
                    <template v-slot:activator="{ on, attrs }">
                      <v-btn
                        color="grey darken-2"
                        outlined
                        v-bind="attrs"
                        v-on="on"
                      >
                        <span>{{ typeToLabel[type] }}</span>
                        <v-icon right>
                          mdi-menu-down
                        </v-icon>
                      </v-btn>
                    </template>
                    <v-list>
                      <v-list-item @click="type = 'day'">
                        <v-list-item-title>يوم</v-list-item-title>
                      </v-list-item>
                      <v-list-item @click="type = '4day'">
                        <v-list-item-title>4 أيام</v-list-item-title>
                      </v-list-item>
                      <v-list-item @click="type = 'week'">
                        <v-list-item-title>أسبوع</v-list-item-title>
                      </v-list-item>
                      <v-list-item @click="type = 'month'">
                        <v-list-item-title>شهر</v-list-item-title>
                      </v-list-item>

                    </v-list>
                  </v-menu>
                </v-toolbar>
              </v-sheet>
              <v-sheet height="600">
                <v-calendar
                  ref="calendar"
                  v-model="focus"
                  :event-color="getEventColor"
                  :events="events"
                  :type="type"
                  color="primary"
                  event-more-text="مشاهدة المزيد"
                  locale="ar"
                  @change="updateRange"
                  @click:event="showEvent"
                  @click:date="viewDay"
                  @click:more="viewDay"
                ></v-calendar>

                <v-menu
                  v-model="selectedOpen"
                  :activator="selectedElement"
                  :close-on-content-click="false"
                  offset-x
                >
                  <v-card
                    color="grey lighten-4"
                    flat
                    min-width="350px"
                  >
                    <v-toolbar
                      :color="selectedEvent.color"
                      dark
                    >
                      <!--              <v-btn icon>-->
                      <!--                <v-icon>mdi-pencil</v-icon>-->
                      <!--              </v-btn>-->
                      <v-toolbar-title style="color: white !important;"
                                       v-html="selectedEvent.name"></v-toolbar-title>
                      <v-spacer></v-spacer>
                      <!--              <v-btn icon>-->
                      <!--                <v-icon>mdi-heart</v-icon>-->
                      <!--              </v-btn>-->
                      <v-btn icon>
                        <v-icon>mdi-dots-vertical</v-icon>
                      </v-btn>
                    </v-toolbar>
                    <v-card-text>
                      <span v-html="selectedEvent.details"></span>
                    </v-card-text>
                    <v-card-actions>

                      <v-btn
                        color="success"
                        text
                        @click="showItem(selectedEvent)"
                      >
                        مشاهدة التفاصيل
                      </v-btn>

                      <v-btn
                        color="red"
                        text
                        @click="selectedOpen = false"
                      >
                        إغلاق
                      </v-btn>
                    </v-card-actions>
                  </v-card>
                </v-menu>
              </v-sheet>
            </v-col>
          </v-row>

        </v-card>
      </v-tab-item>
      <v-tab-item
      >
        <v-card
          color="basil"
          flat
        >
          <v-row>
            <v-col cols="12">
              <v-card>
                <v-data-table
                  :headers="headers"
                  :items="courses"
                  :search="search"
                  class="elevation-1"
                  sort-by="calories"
                >
                  <template v-slot:top>
                    <v-toolbar
                      flat
                    >
                      <v-toolbar-title>الدورات</v-toolbar-title>
                      <v-divider
                        class="mx-4"
                        inset
                        vertical
                      ></v-divider>
                      <v-spacer></v-spacer>
                      <v-row style="margin-top:1%">
                        <v-col cols="5">
                          <v-text-field
                            v-model="search_form.title"
                            append-icon="mdi-magnify"
                            dense
                            hide-details
                            label="البحث عن دورة" outlined single-line
                          ></v-text-field>
                        </v-col>
                        <v-col cols="4">
                          <v-select v-model="search_form.sort" :items="sorts"
                                    dense item-text="name"
                                    item-value="value"
                                    label="الترتيب"
                                    outlined
                                    prepend-inner-icon="mdi-file-tree"></v-select>
                        </v-col>
                        <v-col cols="2">
                          <v-btn class="mb-2 v-btn v-btn--is-elevated   theme--dark   red"
                                 @click="reset">
                            مسح
                          </v-btn>

                        </v-col>

                      </v-row>


                      <v-dialog v-model="dialogDelete" max-width="500px">
                        <v-card>
                          <v-card-title class="text-h5">هل أنت متأكد من الحذف?
                          </v-card-title>
                          <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn color="blue darken-1" text @click="closeDelete">إالغاء</v-btn>
                            <v-btn :loading="form.processing" color="blue darken-1"
                                   text @click="deleteItemConfirm">حفظ
                            </v-btn>
                            <v-spacer></v-spacer>
                          </v-card-actions>
                        </v-card>
                      </v-dialog>
                    </v-toolbar>
                  </template>
                  <template v-slot:no-data>
                    لا يوجد بيانات
                  </template>


                  <template #[`item.title`]="{item}">
                    <Link :href="`/course/${item.id}`"
                          class="text-decoration-none black--text">{{ item.title }}
                    </Link>
                  </template>
                  <template #[`item.date_from_in_time_zone`]="{item}">
                    <Link :href="`/course/${item.id}`"
                          class="text-decoration-none black--text">{{ item.date_from_in_time_zone }}
                      {{ timezone }}
                    </Link>
                  </template>
                  <template #[`item.date_to_in_time_zone`]="{item}">
                    <Link :href="`/course/${item.id}`"
                          class="text-decoration-none black--text">{{ item.date_to_in_time_zone }}
                      {{ timezone }}
                    </Link>
                  </template>


                  <template #[`item.actions`]="{item}">
                    <v-tooltip v-if="item.status==0" bottom color="green">
                      <template v-slot:activator="{ on, attrs }">
                        <v-icon
                          class="mr-2" color="green" v-bind="attrs"
                          @click="change_status(item)"
                          v-on="on"
                        >
                          mdi-call-made
                        </v-icon>
                      </template>
                      <span>  تفعيل </span>
                    </v-tooltip>
                    <v-tooltip v-if="item.status==1" bottom color="red">
                      <template v-slot:activator="{ on, attrs }">
                        <v-icon
                          class="mr-2"
                          color="red"
                          v-bind="attrs"
                          @click="change_status(item)" v-on="on"
                        >
                          mdi-close-outline
                        </v-icon>
                      </template>
                      <span>  تجميد </span>
                    </v-tooltip>
                    <v-tooltip bottom color="#ff3bea">
                      <template v-slot:activator="{ on, attrs }">
                         <span v-bind="attrs" v-on="on">
                          <v-icon
                            class="mr-2"
                            color="#ff3bea"
                            @click="showItem(item)"
                          >
                           mdi-eye
                          </v-icon>
                        </span>
                      </template>
                      <span>  عرض بيانات الدورة </span>
                    </v-tooltip>
                    <v-tooltip bottom color="blue">
                      <template v-slot:activator="{ on, attrs }">
                 <span v-bind="attrs" v-on="on">
                  <v-icon
                    class="mr-2"
                    color="blue"
                    @click="editItem(item)"
                  >
                  mdi-account-edit
                  </v-icon>
                      </span>
                      </template>
                      <span>  تعديل </span>
                    </v-tooltip>
                    <v-tooltip bottom color="red">
                      <template v-slot:activator="{ on, attrs }">
                     <span v-bind="attrs" v-on="on">
                         <v-icon
                           color="red"
                           @click="ShowItemInfo(item)"
                         >
                           mdi-format-list-bulleted
                  </v-icon>
                      </span>
                      </template>
                      <span>  عرض  مشتركي الدورة </span>
                    </v-tooltip>
                  </template>

                  <template #[`item.status`]="{item}">
                    <v-chip v-if="item.status == 0"
                            class="font-weight-medium"
                            color="red"
                            small
                    >
                      مجمد
                    </v-chip>

                    <v-chip v-if="item.status == 1"
                            class="font-weight-medium"
                            color="green"
                            small
                    >
                      مفعل
                    </v-chip>
                  </template>
                  <template #[`item.price_type`]="{item}">
                    <v-chip v-if="item.price_type ==1"
                            class="font-weight-medium"
                            color="red"
                            small
                    >
                      مدفوع
                    </v-chip>

                    <v-chip v-if="item.price_type == 2"
                            class="font-weight-medium"
                            color="blue"
                            small
                    >
                      مجاني
                    </v-chip>
                  </template>
                </v-data-table>
              </v-card>
            </v-col>
          </v-row>
        </v-card>
      </v-tab-item>
    </v-tabs-items>

  </div>
</template>

<script>
import throttle from "lodash/throttle";
import pickBy from "lodash/pickBy";

export default {
  props: {
    courses: Array,
    filters: Object,
    timezone: String
  },
  created() {
    this.axios.get('/get_courses')
      .then(res => {
        this.courses_data = res.data
        this.pagination.current = this.courses_data.current_page;
        this.pagination.total = this.courses_data.last_page;
      })
  },
  data() {
    return {
      courses_data: [],
      page: 1,
      pagination: {
        current: 1,
        total: 0,
      },
      tab: 0,
      search: '',
      dialog: false,
      dialogDelete: false,
      form: this.$inertia.form({
        id: null
      }),
      headers: [
        {text: 'العنوان', value: 'title', width: '250px'},
        {text: 'تاريخ الإنعقاد من ', value: 'date_from_in_time_zone'},
        {text: 'تاريخ الإنعقاد الى', value: 'date_to_in_time_zone'},
        {text: 'نمط الدفع', value: 'price_type'},
        {text: 'الخدمة التابعة لها', value: 'service.name'},
        {text: '  الحالة', value: 'status'},
        {text: 'إجراءات', value: 'actions'},
      ],
      sorts: [
        {
          name: 'الأقدم',
          value: "asc"
        },
        {
          name: 'الأحدث',
          value: "desc"
        }
      ],
      search_form: {
        title: this.filters.title,
        sort: this.filters.sort,
      },
      calender: false,
      table: true,
      focus: '',
      type: 'month',
      typeToLabel: {
        month: 'شهر',
        week: 'أسبوع',
        day: 'يوم',
        '4day': '4 أيام',
      },
      selectedEvent: {},
      selectedElement: null,
      selectedOpen: false,
      events: [],
      colors: ['#3788d8', '#df4759', '#9155FD', '#ffb400', 'rgb(145, 85, 253)'],
      names: ['Meeting', 'Holiday', 'PTO', 'Travel', 'Event', 'Birthday', 'Conference', 'Party'],
    }
  },
  methods: {
    onPageChange() {
      this.axios.get('/get_courses' + '?page=' + this.pagination.current,)
        .then(res => {
          this.courses_data = res.data
          this.pagination.current = this.courses_data.current_page;
        })
    },
    closeDelete() {
      this.dialogDelete = false
    },
    deleteItem(item) {
      this.form.id = item.id
      this.dialogDelete = true
    },

    deleteItemConfirm() {
      this.form.delete('/admin/courses/' + this.form.id, {
        onSuccess: page => {
          this.dialogDelete = false
        },
      })
    },
    editItem(item) {
      this.$inertia.get('/admin/courses/' + item.id + '/edit')
    },
    get_color(role) {
      return role == 'user' ? 'green' : 'blue';
    },
    showItem(item) {
      this.$inertia.get('/course/' + item.id)
    },
    change_status(item) {
      this.$inertia.post('/admin/courses/change_status/' + item.id)
    },
    show_calender() {
      this.calender = true
      this.table = false
    },
    show_table() {
      this.calender = false
      this.table = true
    },
    viewDay({date}) {
      this.focus = date
      this.type = 'day'
    },
    getEventColor(event) {
      return event.color
    },
    setToday() {
      this.focus = ''
    },
    prev() {
      this.$refs.calendar.prev()
    },
    next() {
      this.$refs.calendar.next()
    },
    showEvent({nativeEvent, event}) {
      const open = () => {
        this.selectedEvent = event
        this.selectedElement = nativeEvent.target
        requestAnimationFrame(() => requestAnimationFrame(() => this.selectedOpen = true))
      }

      if (this.selectedOpen) {
        this.selectedOpen = false
        requestAnimationFrame(() => requestAnimationFrame(() => open()))
      } else {
        open()
      }

      nativeEvent.stopPropagation()
    },
    updateRange({start, end}) {
      const events = []

      const min = new Date(`${start.date}T00:00:00`)
      const max = new Date(`${end.date}T23:59:59`)
      const days = (max.getTime() - min.getTime()) / 86400000
      const eventCount = this.rnd(days, days + 20)

      for (let i = 0; i < this.courses.length; i++) {
        const allDay = this.rnd(0, 3) === 0
        const firstTimestamp = this.rnd(min.getTime(), max.getTime())
        const first = new Date(firstTimestamp - (firstTimestamp % 900000))
        const secondTimestamp = this.rnd(2, allDay ? 288 : 8) * 900000
        const second = new Date(first.getTime() + secondTimestamp)
        events.push({
          id: this.courses[i]['id'],
          name: this.courses[i]['title'],
          start: this.courses[i]['date_from_in_time_zone'],
          end: this.courses[i]['date_to_in_time_zone'],
          color: this.colors[this.rnd(0, this.colors.length - 1)],
          timed: true,
        })
      }
      this.events = events
    },
    rnd(a, b) {
      return Math.floor((b - a + 1) * Math.random()) + a
    },

    reset() {
      this.search_form.title = null
      this.search_form.sort = null
      this.$inertia.get('/admin/courses')
    },
    rowClick(item, row) {
      this.$inertia.get('/admin/courses/' + item.id)
    },
    ShowItemInfo(item) {
      this.$inertia.get('/admin/courses/' + item.id)
    },
  },
  mounted() {
    this.$refs.calendar.checkChange()
  }, watch: {
    search_form: {
      deep: true,
      handler: throttle(function () {
        this.$inertia.get('/admin/courses', pickBy(this.search_form), {
          preserveState: true,
          replace: true
        })

      }, 150),
    },
  },

}
</script>
<style lang="scss">

.v-event-start {
  margin-right: 5px !important;
  padding-right: 7px !important;
}

v-event-start {
  margin-right: 5px !important;
  padding-right: 7px !important;
}

.active {
  background-color: blue !important;
  color: white !important;
  opacity: 0.7 !important;
}

.v-tab:hover {
}

.popular-jobs-status {
  position: absolute;
  inset-inline-end: 32px;
  top: 25px;
  color: #fff;
  text-transform: capitalize;
  padding: 4px 18px;
  border-radius: 50px;
  font-weight: 500;
  color: white !important;

}

.theme--light.v-sheet h6 {
  color: white !important;
}

.bg-success {
  background: #11b719 !important;
}

.bg-warning {
  background: #ff9800 !important;
}

.bg-info {
  background: #01b2ac !important;
}

.text-primary {
  color: #1B56AA !important;
}

.popular-jobs-container {
  background: #fff;
  border-radius: 6px;
  overflow: hidden;
  text-align: center;
  margin-bottom: 30px;
  position: relative;
  transition: .4s;
  border: 1px solid #eaeff5;

  .popular-jobs-box {
    text-align: center;
    padding: 40px 20px 25px;
  }

  .flc-rate {
    position: absolute;
    right: 32px;
    top: 20px;
    font-size: 18px;
    font-weight: 500;
    color: #07a0e0;
  }

  .popular-jobs-box-extra ul {
    margin: 15px 0;
    padding: 0;

    li {
      display: inline-block;
      list-style: none;
      padding: 3px 15px;
      border: 1px solid #b9c5ce;
      border-radius: 50px;
      margin: 5px;
      font-weight: 500;
      color: #657180;
    }
  }

  .btn-popular-jobs {
    padding: 14px 17px;
    display: inline-block;
    width: 100%;
    font-size: 16px;
    font-weight: 500;
    border-radius: 0;
    text-shadow: none;
    box-shadow: 0 2px 8px rgb(102 103 107 / 15%);
    background: #f2f3f5;
    text-decoration: none;
    color: #fff;
    background: linear-gradient(262.28deg, #1668B7 0%, #07A1E0 98.24%);
  }

  .popular-jobs-box-detail h3 {
    margin-bottom: 4px;
    font-size: 20px;
    text-transform: capitalize;
    color: #1B56AA;
  }
}


</style>
