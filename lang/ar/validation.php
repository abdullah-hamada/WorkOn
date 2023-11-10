<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'يجب قبول الحقل :attribute',
    'accepted_if' => 'الحقل :attribute مقبول في حال ما إذا كان :other يساوي :value.',
    'active_url' => 'الحقل :attribute لا يُمثّل رابطًا صحيحًا',
    'after' => 'يجب على الحقل :attribute أن يكون تاريخًا لاحقًا للتاريخ :date.',
    'after_or_equal' => 'الحقل :attribute يجب أن يكون تاريخاً لاحقاً أو مطابقاً للتاريخ :date.',
    'alpha' => 'يجب أن لا يحتوي الحقل :attribute سوى على حروف',
    'alpha_dash' => 'يجب أن لا يحتوي الحقل :attribute على حروف، أرقام ومطّات.',
    'alpha_num' => 'يجب أن يحتوي :attribute على حروفٍ وأرقامٍ فقط',
    'array' => 'يجب أن يكون الحقل :attribute ًمصفوفة',
    'before' => 'يجب على الحقل :attribute أن يكون تاريخًا سابقًا للتاريخ :date.',
    'before_or_equal' => 'الحقل :attribute يجب أن يكون تاريخا سابقا أو مطابقا للتاريخ :date',
    'between' => [
        'array' => 'يجب أن يحتوي :attribute على عدد من العناصر بين :min و :max',
        'file' => 'يجب أن يكون حجم الملف :attribute بين :min و :max كيلوبايت.',
        'numeric' => 'يجب أن تكون قيمة :attribute بين :min و :max.',
        'string' => 'يجب أن يكون عدد حروف النّص :attribute بين :min و :max',
    ],
    'boolean' => 'يجب أن تكون قيمة الحقل :attribute إما true أو false ',
    'confirmed' => 'حقل التأكيد غير مُطابق للحقل :attribute',
    'current_password' => 'كلمة المرور غير صحيحة',
    'date' => 'الحقل :attribute ليس تاريخًا صحيحًا',
    'date_equals' => 'لا يساوي الحقل :attribute مع :date.',
    'date_format' => 'لا يتوافق الحقل :attribute مع الشكل :format.',
    'declined' => 'يجب رفض الحقل :attribute',
    'declined_if' => 'الحقل :attribute مرفوض في حال ما إذا كان :other يساوي :value.',
    'different' => 'يجب أن يكون الحقلان :attribute و :other مُختلفان',
    'digits' => 'يجب أن يحتوي الحقل :attribute على :digits رقمًا/أرقام',
    'digits_between' => 'يجب أن يحتوي الحقل :attribute بين :min و :max رقمًا/أرقام',
    'dimensions' => 'الـ :attribute يحتوي على أبعاد صورة غير صالحة.',
    'distinct' => 'للحقل :attribute قيمة مُكرّرة.',
    'email' => 'يجب أن يكون :attribute عنوان بريد إلكتروني صحيح البُنية',
    'ends_with' => 'الـ :attribute يجب ان ينتهي بأحد القيم التالية :value.',
    'enum' => 'الحقل :attribute غير صحيح',
    'exists' => 'الحقل :attribute لاغٍ',
    'file' => 'الـ :attribute يجب أن يكون من ملفا.',
    'filled' => 'الحقل :attribute إجباري',
    'gt' => [
        'array' => 'الـ :attribute يجب ان يحتوي علي اكثر من :value عناصر/عنصر.',
        'file' => 'الـ :attribute يجب ان يكون اكبر من :value كيلو بايت.',
        'numeric' => 'الـ :attribute يجب ان يكون اكبر من :value.',
        'string' => 'الـ :attribute يجب ان يكون اكبر من :value حروفٍ/حرفًا.',
    ],
    'gte' => [
        'array' => 'الـ :attribute يجب ان يحتوي علي :value عناصر/عنصر او اكثر.',
        'file' => 'الـ :attribute يجب ان يكون اكبر من او يساوي :value كيلو بايت.',
        'numeric' => 'الـ :attribute يجب ان يكون اكبر من او يساوي :value.',
        'string' => 'الـ :attribute يجب ان يكون اكبر من او يساوي :value حروفٍ/حرفًا.',
    ],
    'image' => 'يجب أن يكون الحقل :attribute صورةً',
    'in' => 'الحقل :attribute لاغٍ',
    'in_array' => 'الحقل :attribute غير موجود في :other.',
    'integer' => 'يجب أن يكون الحقل :attribute عددًا صحيحًا',
    'ip' => 'يجب أن يكون الحقل :attribute عنوان IP ذا بُنية صحيحة',
    'ipv4' => 'يجب أن يكون الحقل :attribute عنوان IPv4 ذا بنية صحيحة.',
    'ipv6' => 'يجب أن يكون الحقل :attribute عنوان IPv6 ذا بنية صحيحة.',
    'json' => 'يجب أن يكون الحقل :attribute نصا من نوع JSON.',
    'lt' => [
        'array' => 'الـ :attribute يجب ان يحتوي علي اقل من :value عناصر/عنصر.',
        'file' => 'الـ :attribute يجب ان يكون اقل من :value كيلو بايت.',
        'numeric' => 'الـ :attribute يجب ان يكون اقل من :value.',
        'string' => 'الـ :attribute يجب ان يكون اقل من :value حروفٍ/حرفًا.',
    ],
    'lte' => [
        'array' => 'الـ :attribute يجب ان يحتوي علي اكثر من :value عناصر/عنصر.',
        'file' => 'الـ :attribute يجب ان يكون اقل من او يساوي :value كيلو بايت.',
        'numeric' => 'الـ :attribute يجب ان يكون اقل من او يساوي :value.',
        'string' => 'الـ :attribute يجب ان يكون اقل من او يساوي :value حروفٍ/حرفًا.',
    ],
    'mac_address' => 'يجب أن يكون الحقل :attribute عنوان MAC ذا بنية صحيحة.',
    'max' => [
        'array' => 'يجب أن لا يحتوي الحقل :attribute على أكثر من :max عناصر/عنصر.',
        'file' => 'يجب أن لا يتجاوز حجم الملف :attribute :max كيلوبايت',
        'numeric' => 'يجب أن تكون قيمة الحقل :attribute مساوية أو أصغر لـ :max.',
        'string' => 'يجب أن لا يتجاوز طول نص :attribute :max حروفٍ/حرفًا',
    ],
    'mimes' => 'يجب أن يكون الحقل ملفًا من نوع : :values.',
    'mimetypes' => 'يجب أن يكون الحقل ملفًا من نوع : :values.',
    'min' => [
        'array' => 'يجب أن يحتوي الحقل :attribute على الأقل على :min عُنصرًا/عناصر',
        'file' => 'يجب أن يكون حجم الملف :attribute على الأقل :min كيلوبايت',
        'numeric' => 'يجب أن تكون قيمة الحقل :attribute مساوية أو أكبر لـ :min.',
        'string' => 'يجب أن يكون طول نص :attribute على الأقل :min حروفٍ/حرفًا',
    ],
    'multiple_of' => 'The :attribute must be a multiple of :value.',
    'not_in' => 'الحقل :attribute لاغٍ',
    'not_regex' => 'الحقل :attribute نوعه لاغٍ',
    'numeric' => 'يجب على الحقل :attribute أن يكون رقمًا',
    'password' => 'كلمة المرور غير صحيحة.',
    'present' => 'يجب تقديم الحقل :attribute',
    'prohibited' => 'الحقل :attribute محظور',
    'prohibited_if' => 'الحقل :attribute محظور في حال ما إذا كان :other يساوي :value.',
    'prohibited_unless' => 'الحقل :attribute محظور في حال ما لم يكون :other يساوي :value.',
    'prohibits' => 'الحقل :attribute يحظر :other من اي يكون موجود',
    'regex' => 'صيغة الحقل :attribute .غير صحيحة',
    'required' => 'الحقل :attribute مطلوب.',
    'required_array_keys' => 'الحقل :attribute يجب ان يحتوي علي مدخلات للقيم التالية :values.',
    'required_if' => 'الحقل :attribute مطلوب في حال ما إذا كان :other يساوي :value.',
    'required_unless' => 'الحقل :attribute مطلوب في حال ما لم يكن :other يساوي :values.',
    'required_with' => 'الحقل :attribute إذا توفّر :values.',
    'required_with_all' => 'الحقل :attribute إذا توفّر :values.',
    'required_without' => 'الحقل :attribute إذا لم يتوفّر :values.',
    'required_without_all' => 'الحقل :attribute إذا لم يتوفّر :values.',
    'same' => 'يجب أن يتطابق الحقل :attribute مع :other',
    'size' => [
        'array' => 'يجب أن يحتوي الحقل :attribute على :size عنصرٍ/عناصر بالظبط',
        'file' => 'يجب أن يكون حجم الملف :attribute :size كيلوبايت',
        'numeric' => 'يجب أن تكون قيمة الحقل :attribute مساوية لـ :size',
        'string' => 'يجب أن يحتوي النص :attribute على :size حروفٍ/حرفًا بالظبط',
    ],
    'starts_with' => 'الحقل :attribute يجب ان يبدأ بأحد القيم التالية: :values.',
    'string' => 'يجب أن يكون الحقل :attribute نصآ.',
    'timezone' => 'يجب أن يكون :attribute نطاقًا زمنيًا صحيحًا',
    'unique' => 'قيمة الحقل :attribute مُستخدمة من قبل',
    'uploaded' => 'فشل في تحميل الـ :attribute',
    'url' => 'صيغة الرابط :attribute غير صحيحة',
    'uuid' => 'الحقل :attribute يجب ان ايكون رقم UUID صحيح.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        //Hire Group Employee
        "manager" => "مسؤول التواصل",
        "company_email" => "البريد الالكتروني للشركة",
        "employee_number" => "عدد الموظفين",
        "note" => "الملاحظات",


        'task_name' => 'اسم المهمة',
        'task_description' => 'وصف المهمة',
        'task_date' => 'تاريخ المهمة',
        'task_time' => 'وقت المهمة',
        'report_text' => 'نص التقرير',
        'report_file' => 'ملف التقرير',

        'name' => 'الاسم',
        'username' => 'اسم المُستخدم',
        'email' => 'البريد الالكتروني',
        'first_name' => 'الاسم',
        'last_name' => 'اسم العائلة',
        'password' => 'كلمة المرور',
        'password_confirmation' => 'تأكيد كلمة المرور',
        'city' => 'المدينة',
        'country' => 'الدولة',
        'address' => 'العنوان',
        'phone' => 'الهاتف',
        'mobile' => 'الجوال',
        'age' => 'العمر',
        'sex' => 'الجنس',
        'gender' => 'النوع',
        'day' => 'اليوم',
        'month' => 'الشهر',
        'year' => 'السنة',
        'hour' => 'ساعة',
        'minute' => 'دقيقة',
        'second' => 'ثانية',
        'content' => 'المُحتوى',
        'description' => 'الوصف',
        'excerpt' => 'المُلخص',
        'date' => 'التاريخ',
        'time' => 'الوقت',
        'available' => 'مُتاح',
        'size' => 'الحجم',
        'price' => 'السعر',
        'desc' => 'نبذه',
        'title' => 'العنوان',
        'q' => 'البحث',
        'link' => ' ',
        'slug' => ' ',
        "website_url" => " الموقع",
        "facebook_url" => " الفيس بوك",
        "instagram_url" => " الانستقرام",
        "linkedIn_url" => " الينكدان",
        "twitter_url" => " التويتر",

        "work_filed" => "مجال العمل",
        "company_name" => "اسم الشركة",
        "company_person_authorized"=>"الممثل عنها",
        "company_manager" => "مدير الشركة",
        "logo" => "اللوقو",
        "responsibilities" => "المسؤوليات",
        "job_title" => "المسمى الوظيفي",
        "job_description" => "الوصف الوظيفي",
        'type'=>'النوع',

        "skills" => "المهارات",
        "education" => "التعليم",
        "filed" => "التخصص",
        "job_type" => "نوع العمل",
        "work_hour" => "ساعات العمل",
        "salary" => "الراتب",
        "currency_type" => "العملة",
        "employee_work_location" => "موقع عمل الموظف",
        "work_location"=>"مكان العمل",
        "country_id" => "الدولة",
        "category_id" => "التخصص الرئيسي",
        "sub_category_id" => "التخصص الفرعي",
        "job_letter" => "خطاب الوظيفة",
        "cv" => "السيرة الذاتية",
        "certificate_name" => "صورة الشهادة",
        "course_name" => "اسم الدورة",
        "company_location" => "موقع الشركة",
        "work_starting_date" => "تاريخ بداية العمل",
        "work_end_date" => "تاريخ نهاية العمل",
        "work_nature" => "طبيعة العمل",
        "lang_name" => "اللغة",
        "reading_evaluation" => "تقييم القراءة",
        "writing_evaluation" => "تقييم الكتابة",
        "listen_evaluation" => "تقييم المحادثة",
        "nationality" => "الجنسية",
        "image" => "الصورة",
        "cv_file" => "السيرة الذاتية",
        "governorate" => "المحافظة",
        "date_of_birth" => "تاريخ الميلاد",
        "degree" => "الدرجة العلمية",
        "university" => "الجامعة",
        "field" => "التخصص",
        "year_of_completion_or_graduation" => "تاريخ الانتهاء او التخرج",
        "average" => "التقدير",
        'certificate_image' => 'صورة الشهادة',
        "skill_name" => "المهارة",
        "skill_rating" => "تقييم المهارة",
        'role_type' => 'نوع الحساب',
        'last_date_for_apply' => 'اخر موعد للتقديم',


        "begin_task_date" => "تاريخ بداية المهمة",
        "end_task_date" => "تاريخ نهاية المهمة",
        "end_task_time" => "وقت نهاية المهمة",
        'lang_id' => 'اللغة',
        'Certificate_image' => 'الصورة',
        'contract_note' => 'الملاحظة',
        'file' => 'الملف',
        'country_phone_prefix_id' => 'المقدمة',
        'user_id' => 'المستخدم',
        'company_id' => 'الشركة',
        'meet_starting_date_time' => 'تاريخ البداية',
        'meet_topic' => 'عنوان الاجتماع',
        'employee_ids' => 'الموظفين',
        'zoom_client_id' => "zoom_client_id",
        'zoom_client_secret' => "zoom_client_secret",
        "meet_date" => "تاريخ   الاجتماع",
        "meet_time" => "  وقت الاجتماع",
        "timezone" => "المنطقة الزمنية",
        "duration_hour" => "ساعات",
        "duration_min" => "دقائق",
        "passcode" => "passcode",
        'show_salary' => 'حالة الراتب',
        'currency_id' => 'العملة',
        'sub_category' => 'الفئة الفرعية',
        'user_email' => 'البريد الالكتروني',
        "company_size" => "حجم الشركة",
        "course_train_country" => "الدولة",
        'brief_explanation' => 'وصف مختصر',
        'date_from' => 'تاريخ الانعقاد من',
        'date_to' => 'تاريخ الانعقاد الى',
        'location_type' => 'مكان الحدث',
        'price_type' => 'تصنيف الدفع',
        'price_amount' => 'السعر',
        'organizer' => 'المنظم',
        'event_type' => 'نوع الفعالية',
        "whatsapp_number"=>"رقم الواتس اب",
        "role_id"=>"الدور",
        'user_type'=>'اسم الجهة',
        'employment_area'=>'مجال العمل',
        "guest_named_id"=>"المسمى",
        "organizer_name"=>"الاسم",
        "organizer_info"=>"نبذة عن المسمى",
        "guest_name"=>"الضيف",
        "guest_info"=>"نبذة عن الضيف",
        "multaka_id"=>"الملتقى",
        "organizer_named_id"=>'المسمى',
        "multaka_type"=>"النوع",
        "info"=>'النبذة',
        'time_from'=>'المدة من ',
        'time_to'=>'المدة الى'


    ],

];
