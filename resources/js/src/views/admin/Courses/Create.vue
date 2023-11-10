<template>
  <v-container fluid>
    <v-row>
      <v-col cols="12" md="12" sm="12">
        <v-card>
          <v-toolbar class="header_title" color="#0007a5" dark>
            <v-row>
              <h3 class="mt-2" style="padding-right:13px">
                إضافة دورة جديد
              </h3>
              <v-col style="padding-left:20px">
              </v-col>
            </v-row>
          </v-toolbar>
          <v-card-text class="grey lighten-5 mt-3">
            <v-form @submit.prevent="submit">
              <v-row class="match-height">
                <v-col
                  cols="12"
                  md="12"
                >
                  <v-card>
                    <v-card-title>بيانات الدورة</v-card-title>
                    <v-card-text>
                      <v-form class="multi-col-validation" @submit.prevent="submit">
                        <div class="text-center  mb-5">
                          <div class="image-input">
                            <div
                              :style="{ 'background-image': `url(${form.preview_image})` } "
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
                                @change="previewCourseImage($event)"
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
                              v-model="form.title"
                              :error-messages="$page.props.errors.title"
                              dense
                              label="العنوان"
                              outlined
                              placeholder="العنوان"
                              prepend-inner-icon="mdi-format-title"
                            ></v-text-field>
                          </v-col>
                          <v-col cols="12"
                                 md="6">
                            <v-datetime-picker
                              v-model="form.date_from"
                              :date-picker-props="dateProps"
                              :error-messages="$page.props.errors.date_from"
                              :text-field-props="textFieldDateFromProps"
                              :time-picker-props="timeProps"
                              clearText="Cancel"
                              date-format="yyyy-MM-dd" dense label=" تاريخ الانعقاد من "
                              okText="Ok"
                              outlined
                              time-format="HH:mm:ss"
                            >
                              <template slot="dateIcon">
                                <v-icon>mdi-calendar</v-icon>
                              </template>
                              <template slot="timeIcon">
                                <v-icon>mdi-clock-outline</v-icon>
                              </template>
                            </v-datetime-picker>
                          </v-col>
                          <v-col cols="12"
                                 md="6">
                            <v-datetime-picker
                              v-model="form.date_to"
                              :date-picker-props="dateProps"
                              :error-messages="$page.props.errors.date_to"
                              :text-field-props="textFieldDateToProps"
                              :time-picker-props="timeProps"
                              clearText="Cancel"
                              date-format="yyyy-MM-dd" dense label="  تاريخ الانعقاد إلى "
                              okText="Ok"
                              outlined
                              time-format="HH:mm:ss"
                            >
                              <template slot="dateIcon">
                                <v-icon>mdi-calendar</v-icon>
                              </template>
                              <template slot="timeIcon">
                                <v-icon>mdi-clock-outline</v-icon>
                              </template>
                            </v-datetime-picker>
                          </v-col>
                          <v-col
                            cols="12"
                            md="6"
                          >
                            <v-select
                              v-model="form.price_type"
                              :error-messages="$page.props.errors.price_type"
                              :items="price_course_types"
                              dense
                              item-text="name"
                              item-value="id"
                              label="نمط الدفع"
                              outlined
                              prepend-inner-icon="mdi-account-credit-card-outline"
                            ></v-select>
                          </v-col>
                          <v-col v-show="form.price_type == 1"
                                 cols="12"
                                 md="6"
                          >
                            <v-text-field
                              v-model="form.price_before_discount"
                              :error-messages="$page.props.errors.price_before_discount"
                              dense
                              label="السعر  قبل الخصم بالدولار الأمريكي"
                              outlined
                              placeholder="السعر بالدولار الأمريكي"
                              prepend-inner-icon="mdi-cash-sync"
                            ></v-text-field>
                          </v-col>
                          <v-col v-show="form.price_type == 1"
                                 cols="12"
                                 md="6"
                          >
                            <v-text-field
                              v-model="form.price_after_discount"
                              :error-messages="$page.props.errors.price_after_discount"
                              dense
                              label="السعر بعد الخصم  بالدولار الأمريكي"
                              outlined
                              placeholder="السعر بالدولار الأمريكي"
                              prepend-inner-icon="mdi-cash-sync"
                            ></v-text-field>
                          </v-col>
                          <v-col
                            cols="12"
                            md="6"
                          >
                            <v-select
                              v-model="form.trainer_id"
                              :error-messages="$page.props.errors.trainer_id"
                              :items="trainers"
                              dense
                              item-text="name"
                              item-value="id"
                              label="المدرب  "
                              outlined
                              prepend-inner-icon="mdi-format-list-bulleted-type"
                            ></v-select>

                          </v-col>
                          <v-col
                            cols="12"
                            md="6"
                          >
                            <v-select
                              v-model="form.service_id"
                              :error-messages="$page.props.errors.service_id"
                              :items="services"
                              dense
                              item-text="name"
                              item-value="id"
                              label="الخدمة  "
                              outlined
                              prepend-inner-icon="mdi-format-list-bulleted-type"
                            ></v-select>

                          </v-col>
                        </v-row>
                        <v-row>
                          <v-col
                            cols="12"
                            md="12"
                          >
                            <v-text-field
                              v-model="form.lectures_link"
                              :error-messages="$page.props.errors.lectures_link"
                              dense
                              label="رابط المحاضرات"
                              outlined
                              placeholder="رابط المحاضرات"
                              prepend-inner-icon="mdi-link-variant"
                            ></v-text-field>
                          </v-col>
                        </v-row>
                        <v-row>

                          <v-col
                            cols="12"
                            md="12"
                          >
                            <v-textarea
                              v-model="form.brief_explanation"
                              :error-messages="$page.props.errors.brief_explanation"
                              label="وصف مختصر للدورة"
                              name="input-7-4"
                              outlined
                            ></v-textarea>
                          </v-col>
                        </v-row>
                      </v-form>
                    </v-card-text>
                  </v-card>
                </v-col>
              </v-row>
              <v-row class="match-height">
                <v-col
                  cols="12"
                  md="12"
                >
                  <v-card>
                    <div class="d-flex justify-space-between align-center">
                      <v-card-title>الفيديو الترويجي للدورة
                      </v-card-title>
                    </div>
                    <v-card-text>
                      <v-row>
                        <v-col
                          cols="2"
                        >
                          <div class="image-input">
                            <div
                              :style="{ 'background-image': `url(${form.course_promotional_video.preview_image})` }"
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
                                @change="previewPromotionalVideoImage($event , index)"
                              />
                              <input name="profile_avatar_remove" type="hidden"/>
                            </label>
                          </div>
                          <div v-if="$page.props.errors['course_promotional_video.image']"
                               class="error--text">
                            {{ $page.props.errors['course_promotional_video.image'] }}
                          </div>
                        </v-col>
                        <v-col
                          cols="5"
                        >
                          <v-text-field
                            v-model="form.course_promotional_video.title"
                            :error-messages="$page.props.errors['course_promotional_video.title']"
                            dense
                            label="العنوان"
                            outlined
                            placeholder="العنوان  "
                            prepend-inner-icon="mdi-format-title"
                          ></v-text-field>
                        </v-col>
                        <v-col
                          cols="5"
                        >
                          <v-text-field
                            v-model="form.course_promotional_video.video_url"
                            :error-messages="$page.props.errors['course_promotional_video.video_url']"
                            dense
                            label="رابط الفيديو"
                            outlined
                            placeholder="رابط الفيديو"
                            prepend-inner-icon="mdi-link-variant"
                          ></v-text-field>
                        </v-col>
                      </v-row>
                    </v-card-text>
                  </v-card>
                </v-col>
              </v-row>
              <v-row class="match-height">
                <v-col
                  cols="12"
                  md="12"
                >
                  <v-card>
                    <div class="d-flex justify-space-between align-center">
                      <v-card-title>مقالات الدورة</v-card-title>
                      <v-btn
                        class="ml-3 v-btn v-btn--is-elevated v-btn--has-bg theme--dark v-size--default primary"
                        color="primary"
                        dark
                        @click="add_new_article_row"
                      >
                        <v-icon>
                          mdi-plus
                        </v-icon>
                        إضافة مقال جديد
                      </v-btn>
                    </div>
                    <v-card-text>
                      <div id="rows">
                        <v-row v-for="(article,index) in form.articles" :key="index">
                          <v-col
                            cols="2"
                          >
                            <div class="image-input">
                              <div
                                :style="{ 'background-image': `url(${article.preview_image})` } "
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
                                  @change="previewArticleImage($event , index)"
                                />

                                <input name="profile_avatar_remove" type="hidden"/>
                              </label>
                            </div>
                            <div v-if="$page.props.errors['articles.' + index + '.image']"
                                 class="error--text">
                              {{ $page.props.errors['articles.' + index + '.image'] }}
                            </div>
                          </v-col>
                          <v-col
                            cols="4"
                          >
                            <v-text-field
                              v-model="article.title"
                              :error-messages="$page.props.errors['articles.' + index + '.title']"
                              dense
                              label="العنوان"
                              outlined
                              placeholder="العنوان"
                              prepend-inner-icon="mdi-format-title"
                            ></v-text-field>
                          </v-col>
                          <v-col
                            cols="5"
                          >
                            <v-textarea
                              v-model="article.paragraph"
                              :error-messages="$page.props.errors['articles.' + index + '.paragraph']"
                              label="الفقرة"
                              outlined
                              prepend-inner-icon="mdi-comment"
                              rows="3"
                            ></v-textarea>
                          </v-col>
                          <v-col
                            cols="1"
                          >
                            <v-btn
                              class="mb-2 v-btn v-btn--is-elevated v-btn--has-bg theme--dark v-size--default danger"
                              color="red"
                              dark
                              @click="deleteArticleItem(index)"
                            >حذف
                            </v-btn>
                          </v-col>
                        </v-row>
                      </div>
                    </v-card-text>
                  </v-card>
                </v-col>
              </v-row>
              <v-row class="match-height">
                <v-col
                  cols="12"
                  md="12"
                >
                  <v-card>
                    <div class="d-flex justify-space-between align-center">
                      <v-card-title>لماذا عليك أن تشترك في الدورة الآن؟
                      </v-card-title>
                      <v-btn
                        class="ml-3 v-btn v-btn--is-elevated v-btn--has-bg theme--dark v-size--default primary"
                        color="primary"
                        dark
                        @click="add_new_reason_row"
                      >
                        <v-icon>
                          mdi-plus
                        </v-icon>
                        إضافة سبب جديد
                      </v-btn>
                    </div>
                    <v-card-text>
                      <div id="rows">
                        <v-row v-for="(item,index) in form.reasons_for_participating_in_course"
                               :key="index">
                          <v-col
                            cols="2"
                          >
                            <div class="image-input">
                              <div
                                :style="{ 'background-image': `url(${item.preview_image})` }"
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
                                  @change="previewReasonImage($event , index)"
                                />

                                <input name="profile_avatar_remove" type="hidden"/>
                              </label>
                            </div>
                            <div
                              v-if="$page.props.errors['reasons_for_participating_in_course.' + index + '.image']"
                              class="error--text">
                              {{ $page.props.errors['reasons_for_participating_in_course.' + index + '.image'] }}
                            </div>
                          </v-col>
                          <v-col
                            cols="8"
                          >
                            <v-text-field
                              v-model="item.title"
                              :error-messages="$page.props.errors['reasons_for_participating_in_course.' + index + '.title']"
                              dense
                              label="السبب"
                              outlined
                              placeholder="السبب"
                              prepend-inner-icon="mdi-format-title"
                            ></v-text-field>
                          </v-col>
                          <v-col
                            cols="1">
                            <v-btn
                              class="mb-2 v-btn v-btn--is-elevated v-btn--has-bg theme--dark v-size--default danger"
                              color="red"
                              dark
                              @click="deleteReasonItem(index)"
                            >حذف
                            </v-btn>
                          </v-col>
                        </v-row>
                      </div>
                    </v-card-text>
                  </v-card>
                </v-col>
              </v-row>
              <v-row class="match-height">
                <v-col
                  cols="12"
                  md="12">
                  <v-card>
                    <div class="d-flex justify-space-between align-center">
                      <v-card-title>أقسام الدورة
                      </v-card-title>
                      <v-btn
                        class="ml-3 v-btn v-btn--is-elevated v-btn--has-bg theme--dark v-size--default primary"
                        color="primary"
                        dark
                        @click="add_new_section_row"
                      >
                        <v-icon>
                          mdi-plus
                        </v-icon>
                        إضافة قسم جديد
                      </v-btn>
                    </div>
                    <v-card-text>
                      <div id="rows">
                        <v-row v-for="(item,index) in form.course_sections" :key="index">
                          <v-col
                            cols="5">
                            <v-text-field
                              v-model="item.title"
                              :error-messages="$page.props.errors['course_sections.' + index + '.title']"
                              dense
                              label="القسم"
                              outlined
                              placeholder="القسم"
                              prepend-inner-icon="mdi-format-title"
                            ></v-text-field>
                          </v-col>
                          <v-col
                            cols="6">
                            <v-textarea
                              v-model="item.paragraph"
                              :error-messages="$page.props.errors['course_sections.' + index + '.paragraph']"
                              label="الوصف"
                              outlined
                              prepend-inner-icon="mdi-comment"
                              rows="3"
                            ></v-textarea>
                          </v-col>
                          <v-col
                            cols="1"
                          >
                            <v-btn
                              class="mb-2 v-btn v-btn--is-elevated v-btn--has-bg theme--dark v-size--default danger"
                              color="red"
                              dark
                              @click="deleteSectionItem(index)"
                            >حذف
                            </v-btn>
                          </v-col>
                        </v-row>
                      </div>
                    </v-card-text>
                  </v-card>
                </v-col>
              </v-row>
              <v-row class="match-height">
                <v-col
                  cols="12"
                  md="12"
                >
                  <v-card>
                    <div class="d-flex justify-space-between align-center">
                      <v-card-title> من يستطيع الاستفادة من هذه الدورة؟
                      </v-card-title>
                      <v-btn
                        class="ml-3 v-btn v-btn--is-elevated v-btn--has-bg theme--dark v-size--default primary"
                        color="primary"
                        dark
                        @click="add_new_benefit_row"
                      >
                        <v-icon>
                          mdi-plus
                        </v-icon>
                        إضافة مستفيد جديد
                      </v-btn>
                    </div>
                    <v-card-text>
                      <div id="rows">
                        <v-row v-for="(item,index) in form.users_benefit_course" :key="index">
                          <v-col
                            cols="2"
                          >
                            <div class="image-input">
                              <div
                                :style="{ 'background-image': `url(${item.preview_image})` }"
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
                                  @change="previewBenefitImage($event , index)"
                                />
                                <input name="profile_avatar_remove" type="hidden"/>
                              </label>
                            </div>
                            <div
                              v-if="$page.props.errors['users_benefit_course.' + index + '.image']"
                              class="error--text">
                              {{ $page.props.errors['users_benefit_course.' + index + '.image'] }}
                            </div>
                          </v-col>
                          <v-col
                            cols="8"
                          >
                            <v-text-field
                              v-model="item.title"
                              :error-messages="$page.props.errors['users_benefit_course.' + index + '.title']"
                              dense
                              label="المستفيد"
                              outlined
                              placeholder="المستفيد"
                              prepend-inner-icon="mdi-format-title"
                            ></v-text-field>
                          </v-col>
                          <v-col
                            cols="1"
                          >
                            <v-btn
                              class="mb-2 v-btn v-btn--is-elevated v-btn--has-bg theme--dark v-size--default danger"
                              color="red"
                              dark
                              @click="deleteBenefitItem(index)"
                            >حذف
                            </v-btn>
                          </v-col>
                        </v-row>
                      </div>
                    </v-card-text>
                  </v-card>
                </v-col>
              </v-row>
              <v-row class="match-height">
                <v-col
                  cols="12"
                  md="12"
                >
                  <v-card>
                    <div class="d-flex justify-space-between align-center">
                      <v-card-title>أسئلة وأجوبة عن الدورة
                      </v-card-title>
                      <v-btn
                        class="ml-3 v-btn v-btn--is-elevated v-btn--has-bg theme--dark v-size--default primary"
                        color="primary"
                        dark
                        @click="add_new_question_row"
                      >
                        <v-icon>
                          mdi-plus
                        </v-icon>
                        إضافة سؤال جديد
                      </v-btn>
                    </div>
                    <v-card-text>
                      <div id="rows">
                        <v-row v-for="(item,index) in form.course_questions" :key="index">
                          <v-col
                            cols="5"
                          >
                            <v-text-field
                              v-model="item.question"
                              :error-messages="$page.props.errors['course_questions.' + index + '.question']"
                              dense
                              label="السؤال"
                              outlined
                              placeholder="السؤال"
                              prepend-inner-icon="mdi-format-title"
                            ></v-text-field>
                          </v-col>
                          <v-col
                            cols="6"
                          >
                            <v-textarea
                              v-model="item.answer"
                              :error-messages="$page.props.errors['course_questions.' + index + '.answer']"
                              label="الجواب"
                              outlined
                              prepend-inner-icon="mdi-comment"
                              rows="3"
                            ></v-textarea>
                          </v-col>
                          <v-col
                            cols="1"
                          >
                            <v-btn
                              class="mb-2 v-btn v-btn--is-elevated v-btn--has-bg theme--dark v-size--default danger"
                              color="red"
                              dark
                              @click="deleteQuestionItem(index)"
                            >حذف
                            </v-btn>
                          </v-col>
                        </v-row>
                      </div>
                    </v-card-text>
                  </v-card>
                </v-col>
              </v-row>
              <v-row class="match-height">
                <v-col
                  cols="12"
                  md="12"
                >
                  <v-card>
                    <div class="d-flex justify-space-between align-center">
                      <v-card-title>رأي المشاركين في الدورات التدريبية

                      </v-card-title>
                      <v-btn
                        class="ml-3 v-btn v-btn--is-elevated v-btn--has-bg theme--dark v-size--default primary"
                        color="primary"
                        dark
                        @click="add_new_opinion_row"
                      >
                        <v-icon>
                          mdi-plus
                        </v-icon>
                        إضافة رأي جديد
                      </v-btn>
                    </div>
                    <v-card-text>
                      <div id="rows">
                        <v-row v-for="(item,index) in form.course_opinion_participants"
                               :key="index">
                          <v-col
                            cols="2">
                            <div class="image-input">
                              <div
                                :style="{ 'background-image': `url(${item.preview_image})` } "
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
                                  @change="previewOpinionImage($event , index)"
                                />

                                <input name="profile_avatar_remove" type="hidden"/>
                              </label>
                            </div>
                            <div
                              v-if="$page.props.errors['course_opinion_participants.' + index + '.image']"
                              class="error--text">
                              {{ $page.props.errors['course_opinion_participants.' + index + '.image']
                              }}
                            </div>
                          </v-col>
                          <v-col
                            cols="5"
                          >
                            <v-text-field
                              v-model="item.video_url"
                              :error-messages="$page.props.errors['course_opinion_participants.' + index + '.video_url']"
                              dense
                              label="رابط الفيديو"
                              outlined
                              placeholder="رابط الفيديو"
                              prepend-inner-icon="mdi-link-variant"
                            ></v-text-field>
                          </v-col>
                          <v-col
                            cols="1"
                          >
                            <v-btn
                              class="mb-2 v-btn v-btn--is-elevated v-btn--has-bg theme--dark v-size--default danger"
                              color="red"
                              dark
                              @click="deleteOpinionItem(index)"
                            >حذف
                            </v-btn>
                          </v-col>
                        </v-row>
                      </div>
                    </v-card-text>
                  </v-card>
                </v-col>
              </v-row>
              <v-row class="match-height">
                <v-col
                  cols="12"
                  md="12"
                >
                  <v-card>
                    <div class="d-flex justify-space-between align-center">
                      <v-card-title>سلايدر الصور

                      </v-card-title>
                      <v-btn
                        class="ml-3 v-btn v-btn--is-elevated v-btn--has-bg theme--dark v-size--default primary"
                        color="primary"
                        dark
                        @click="add_new_slider_image_row"
                      >
                        <v-icon>
                          mdi-plus
                        </v-icon>
                        إضافة سلايدر جديد
                      </v-btn>
                    </div>
                    <v-card-text>
                      <div id="rows">
                        <v-row v-for="(item,index) in form.course_slider_images" :key="index">
                          <v-col
                            cols="2"
                          >
                            <div class="image-input">
                              <div
                                :style="{ 'background-image': `url(${item.preview_image})` }  "
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
                                  @change="previewSliderImage($event , index)"
                                />

                                <input name="profile_avatar_remove" type="hidden"/>
                              </label>
                            </div>
                            <div
                              v-if="$page.props.errors['course_slider_images.' + index + '.image']"
                              class="error--text">
                              {{ $page.props.errors['course_slider_images.' + index + '.image'] }}
                            </div>
                          </v-col>
                          <v-col
                            cols="8"
                          >
                            <v-text-field
                              v-model="item.title"
                              :error-messages="$page.props.errors['course_slider_images.' + index + '.title']"
                              dense
                              label="النص"
                              outlined
                              placeholder="النص"
                              prepend-inner-icon="mdi-format-title"
                            ></v-text-field>
                          </v-col>
                          <v-col
                            cols="1"
                          >
                            <v-btn
                              class="mb-2 v-btn v-btn--is-elevated v-btn--has-bg theme--dark v-size--default danger"
                              color="red"
                              dark
                              @click="deleteSliderImageItem(index)"
                            >حذف
                            </v-btn>
                          </v-col>
                        </v-row>
                      </div>
                    </v-card-text>
                  </v-card>
                </v-col>
              </v-row>
              <v-row>
                <v-col cols="12">
                  <v-btn :loading="form.processing"
                         class=" mx-2 v-btn v-btn--is-elevated v-btn--has-bg theme--dark v-size--default  "
                         color="#0007a5"
                         type="submit">
                    <v-icon>
                      mdi-plus
                    </v-icon>
                    حفظ
                  </v-btn>
                </v-col>
              </v-row>
            </v-form>
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
    categories: Array,
    countries: Array,
    course_types: Array,
    trainer_labels: Array,
    services: Array,
    trainers: Array
  },
  data() {
    return {
      form: this.$inertia.form({
        title: null,
        brief_explanation: null,
        date_from: null,
        date_to: null,
        time_from: null,
        time_to: null,
        price_type: null,
        price_before_discount: null,
        price_after_discount: null,
        course_type_id: null,
        trainer_id: null,
        service_id: null,
        image: null,
        lectures_link: null,
        articles: [],
        course_sections: [],
        reasons_for_participating_in_course: [],
        users_benefit_course: [],
        course_questions: [],
        course_opinion_participants: [],
        course_slider_images: [],
        course_promotional_video: {
          image: null,
          video_url: null,
          title: null,
          preview_image: null
        },
        preview_image: null
      }),
      price_course_types: [{
        id: 1,
        name: 'مدفوع'
      },
        {
          id: 2,
          name: 'مجاني'
        }],
      textFieldDateFromProps: {
        errorMessages: '',
        prependInnerIcon: "mdi-clipboard-text-clock",
        dense: true,
        outlined: true,
      },
      textFieldDateToProps: {
        errorMessages: '',
        prependInnerIcon: "mdi-clipboard-text-clock",
        dense: true,
        outlined: true,
      },
    }
  },
  methods: {
    previewArticleImage(event, index) {
      var input = event.target;
      console.log(event)
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = (e) => {
          this.form.articles[index].preview_image = e.target.result;
          this.form.articles[index].image = input.files[0];
        };
        reader.readAsDataURL(input.files[0]);
      }
    },
    previewReasonImage(event, index) {
      var input = event.target;
      console.log(event)
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = (e) => {
          this.form.reasons_for_participating_in_course[index].preview_image = e.target.result;
          this.form.reasons_for_participating_in_course[index].image = input.files[0];
        };
        reader.readAsDataURL(input.files[0]);
      }
    },

    previewSectionImage(event, index) {
      var input = event.target;
      console.log(event)
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = (e) => {
          this.form.course_sections[index].preview_image = e.target.result;
          this.form.course_sections[index].image = input.files[0];
        };
        reader.readAsDataURL(input.files[0]);
      }
    },
    previewBenefitImage(event, index) {
      var input = event.target;
      console.log(event)
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = (e) => {
          this.form.users_benefit_course[index].preview_image = e.target.result;
          this.form.users_benefit_course[index].image = input.files[0];
        };
        reader.readAsDataURL(input.files[0]);
      }
    },

    previewOpinionImage(event, index) {
      var input = event.target;
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = (e) => {
          this.form.course_opinion_participants[index].preview_image = e.target.result;
          this.form.course_opinion_participants[index].image = input.files[0];
        };
        reader.readAsDataURL(input.files[0]);
      }
    },

    previewPromotionalVideoImage(event) {
      var input = event.target;
      console.log(event)
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = (e) => {
          this.form.course_promotional_video.preview_image = e.target.result;
          this.form.course_promotional_video.image = input.files[0];
        };
        reader.readAsDataURL(input.files[0]);
      }
    },
    previewSliderImage(event, index) {
      var input = event.target;
      console.log(event)
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = (e) => {
          this.form.course_slider_images[index].preview_image = e.target.result;
          this.form.course_slider_images[index].image = input.files[0];
        };
        reader.readAsDataURL(input.files[0]);
      }
    },

    previewCourseImage(event) {
      var input = event.target;
      console.log(event)
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = (e) => {
          this.form.preview_image = e.target.result;
          this.form.image = input.files[0];
        };
        reader.readAsDataURL(input.files[0]);
      }
    },

    removeImage: function () {
      this.imageData = null;
    },
    submit() {
      this.form.post('/admin/courses',
        {
          onError: (errors) => {
            this.textFieldDateFromProps.errorMessages = this.form.errors && this.form.errors.date_from ? this.form.errors.date_from : ''
            this.textFieldDateToProps.errorMessages = this.form.errors && this.form.errors.date_to ? this.form.errors.date_to : ''
          }
        })
    },
    add_new_article_row() {
      this.form.articles.push({
        title: null,
        paragraph: null,
        image: null,
        preview_image: null
      })
    },
    add_new_reason_row() {
      this.form.reasons_for_participating_in_course.push({
        title: null,
        image: null,
        preview_image: null
      })
    },
    add_new_section_row() {
      this.form.course_sections.push({
        title: null,
        paragraph: null,
      })
    },

    add_new_benefit_row() {
      this.form.users_benefit_course.push({
        title: null,
        image: null,
        preview_image: null
      })
    },

    add_new_question_row() {
      this.form.course_questions.push({
        question: null,
        answer: null,
      })
    },
    add_new_opinion_row() {
      this.form.course_opinion_participants.push({
        image: null,
        preview_image: null,
        video_url: null,
      })
    },
    add_new_slider_image_row() {
      this.form.course_slider_images.push({
        image: null,
        preview_image: null,
        title: null,
      })
    },

    deleteItem(index) {
      this.form.times.splice(index, 1)
    },
    deleteArticleItem(index) {
      this.form.articles.splice(index, 1)

    },
    deleteReasonItem(index) {
      this.form.reasons_for_participating_in_course.splice(index, 1)
    },
    deleteSectionItem(index) {
      this.form.course_sections.splice(index, 1)
    },
    deleteBenefitItem(index) {
      this.form.users_benefit_course.splice(index, 1)
    },
    deleteQuestionItem(index) {
      this.form.course_questions.splice(index, 1)
    },
    deleteOopinionItem(index) {
      this.form.course_opinion_participants.splice(index, 1)
    },
    deleteSliderImageItem(index) {
      this.form.course_slider_images.splice(index, 1)
    }, deleteOpinionItem(index) {
      this.form.course_opinion_participants.splice(index, 1)
    },
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

.col-4 {
  flex: 1 !important;
}
</style>
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
